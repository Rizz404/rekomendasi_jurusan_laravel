<?php

namespace App\Http\Controllers;

use App\Models\CollegeMajor;
use App\Models\Criteria;
use App\Models\MajorCharacteristic;
use App\Models\SawResult;
use App\Models\Student;
use App\Models\StudentScore;
use Illuminate\Support\Facades\Auth;

class SawResultController extends Controller
{
    /**
     * Display recommendations for the authenticated student
     */
    public function myRecommendations()
    {
        $user = Auth::user();
        // Get current authenticated student
        $student = Student::where('user_id', $user->id)->firstOrFail();

        // Check if recommendations exist
        $recommendations = SawResult::with('collegeMajor')
            ->where('student_id', $student->id)
            ->orderBy('rank')
            ->get();

        if ($recommendations->isEmpty())
        {
            // Generate recommendations if they don't exist
            $this->calculateRecommendations($student->id);

            // Fetch newly created recommendations
            $recommendations = SawResult::with('collegeMajor')
                ->where('student_id', $student->id)
                ->orderBy('rank')
                ->get();
        }

        return view('recomendation.my-recomendations', compact('recommendations', 'student'));
    }

    /**
     * Display a list of all students with their recommendations
     */
    // public function index()
    // {
    //     $students = Student::with(['user', 'sawResults' => function ($query)
    //     {
    //         $query->orderBy('rank')->with('collegeMajor');
    //     }])->paginate(10);

    //     return view('admin.saw_results.index', compact('students'));
    // }

    /**
     * Display recommendations for a specific student
     */
    // public function show($studentId)
    // {
    //     $student = Student::with('user')->findOrFail($studentId);

    //     $recommendations = SawResult::with('collegeMajor')
    //         ->where('student_id', $studentId)
    //         ->orderBy('rank')
    //         ->get();

    //     if ($recommendations->isEmpty())
    //     {
    //         // Generate recommendations if they don't exist
    //         $this->calculateRecommendations($studentId);

    //         // Fetch newly created recommendations
    //         $recommendations = SawResult::with('collegeMajor')
    //             ->where('student_id', $studentId)
    //             ->orderBy('rank')
    //             ->get();
    //     }

    //     return view('admin.saw_results.show', compact('student', 'recommendations'));
    // }

    /**
     * Calculate Saw recommendations for a student
     */
    public function calculateRecommendations($studentId)
    {
        // Get student
        $student = Student::findOrFail($studentId);

        // Clear previous results if any
        SawResult::where('student_id', $studentId)->delete();

        // Get student scores
        $studentScores = StudentScore::where('student_id', $studentId)
            ->with('criteria')
            ->get();

        // Check if student has scores
        if ($studentScores->isEmpty())
        {
            return redirect()->back()->with('error', 'Student has no scores to calculate recommendations');
        }

        // Get active criteria
        $criteria = Criteria::where('is_active', true)
            ->when($student->school_type === 'high_school', function ($query)
            {
                return $query->where(function ($q)
                {
                    $q->where('school_type', 'SMA')
                        ->orWhere('school_type', 'All');
                });
            })
            ->when($student->school_type === 'vocational_school', function ($query)
            {
                return $query->where(function ($q)
                {
                    $q->where('school_type', 'SMK')
                        ->orWhere('school_type', 'All');
                });
            })
            ->get();

        // Get all college majors
        $collegeMajors = CollegeMajor::where('is_active', true)->get();

        // Array to store normalized matrix
        $normalizedMatrix = [];

        // Normalize student scores 
        foreach ($criteria as $criterion)
        {
            // Get all scores for this criterion
            $allScores = StudentScore::where('criteria_id', $criterion->id)->pluck('score')->toArray();

            if (empty($allScores)) continue;

            // Current student score for this criterion
            $studentScore = $studentScores->where('criteria_id', $criterion->id)->first();

            if (!$studentScore) continue;

            // Calculate normalized value based on criterion type
            if ($criterion->type === 'benefit')
            {
                $max = max($allScores);
                $normalizedMatrix[$criterion->id] = $max > 0 ? ($studentScore->score / $max) : 0;
            }
            else
            { // cost
                $min = min($allScores);
                $normalizedMatrix[$criterion->id] = $studentScore->score > 0 ? ($min / $studentScore->score) : 0;
            }
        }

        // Calculate final Saw scores for each major
        $sawScores = [];

        foreach ($collegeMajors as $major)
        {
            // Get characteristics for this major
            $characteristics = MajorCharacteristic::where('college_major_id', $major->id)
                ->with('criteria')
                ->get();

            // Skip if no characteristics
            if ($characteristics->isEmpty()) continue;

            // Check minimum requirements
            $meetsMinimumRequirements = true;
            $failedCriteria = [];

            foreach ($characteristics as $characteristic)
            {
                if ($characteristic->minimum_score !== null)
                {
                    $studentScore = $studentScores->where('criteria_id', $characteristic->criteria_id)->first();

                    if (!$studentScore || $studentScore->score < $characteristic->minimum_score)
                    {
                        $meetsMinimumRequirements = false;
                        $failedCriteria[] = $characteristic->criteria->name;
                    }
                }
            }

            // Calculate weighted score
            $finalScore = 0;
            $reasonParts = [];

            if ($meetsMinimumRequirements)
            {
                foreach ($characteristics as $characteristic)
                {
                    if (isset($normalizedMatrix[$characteristic->criteria_id]))
                    {
                        $criteriaWeightedScore = $normalizedMatrix[$characteristic->criteria_id] *
                            $characteristic->criteria->weight *
                            $characteristic->compatibility_weight;
                        $finalScore += $criteriaWeightedScore;

                        // Store reason part for high compatibility
                        if ($characteristic->compatibility_weight > 0.7)
                        {
                            $reasonParts[] = "Strong match for {$characteristic->criteria->name}";
                        }
                    }
                }
            }
            else
            {
                // Set a very low score for majors that don't meet minimum requirements
                $finalScore = 0;
                $reasonParts[] = "Doesn't meet minimum requirements for: " . implode(', ', $failedCriteria);
            }

            $sawScores[$major->id] = [
                'major_id' => $major->id,
                'final_score' => $finalScore,
                'reason' => $reasonParts
            ];
        }

        // Sort by score (descending)
        uasort($sawScores, function ($a, $b)
        {
            return $b['final_score'] <=> $a['final_score'];
        });

        // Assign ranks and save to database
        $rank = 1;
        foreach ($sawScores as $majorId => $scoreData)
        {
            $recommendation = new SawResult();
            $recommendation->student_id = $studentId;
            $recommendation->college_major_id = $scoreData['major_id'];
            $recommendation->final_score = $scoreData['final_score'];
            $recommendation->rank = $rank;
            $recommendation->recommendation_reason = implode('. ', $scoreData['reason']);
            $recommendation->save();

            $rank++;
        }

        return true;
    }

    public function calculateCurrentStudentRecommendations()
    {
        $user = Auth::user();
        // Get current authenticated student
        $student = Student::where('user_id', $user->id)->firstOrFail();

        // Calculate recommendations for the current student
        $this->calculateRecommendations($student->id);

        return redirect()->back()->with('success', 'Recommendations calculated successfully');
    }

    /**
     * Recalculate recommendations for all students
     */
    public function recalculateAll()
    {
        $students = Student::all();

        $processedCount = 0;

        foreach ($students as $student)
        {
            $this->calculateRecommendations($student->id);
            $processedCount++;
        }

        return redirect()->back()->with('success', "Recalculated recommendations for {$processedCount} students");
    }

    /**
     * Delete recommendations for a student
     */
    public function destroy($studentId)
    {
        SawResult::where('student_id', $studentId)->delete();

        return redirect()->back()->with('success', 'Recommendations deleted successfully');
    }
}
