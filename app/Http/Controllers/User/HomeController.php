<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CollegeMajor;
use App\Models\SawResult;
use App\Models\Student;
use App\Models\University;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $student = $user->student;

        $latestRecommendations = null;
        if ($student)
        {
            $latestRecommendations = SawResult::where('student_id', $student->id)
                ->join('college_majors', 'saw_results.college_major_id', '=', 'college_majors.id')
                ->orderBy('saw_results.calculation_date', 'desc')
                ->orderBy('saw_results.rank', 'asc')
                ->select('college_majors.major_name', 'saw_results.final_score', 'saw_results.rank')
                ->take(3)
                ->get();
        }

        $topRecommendedMajors = CollegeMajor::query()
            ->select('college_majors.major_name', DB::raw('COUNT(saw_results.college_major_id) as recommendation_count'))
            ->join('saw_results', 'college_majors.id', '=', 'saw_results.college_major_id')
            ->groupBy('college_majors.id', 'college_majors.major_name')
            ->orderByDesc('recommendation_count')
            ->orderBy('college_majors.major_name')
            ->take(5)
            ->get();


        $topUniversities = University::query()
            ->select('universities.name as university_name', DB::raw('COUNT(DISTINCT college_major_university.college_major_id) as popular_major_offerings'))
            ->join('college_major_university', 'universities.id', '=', 'college_major_university.university_id')
            ->whereIn('college_major_university.college_major_id', function ($query)
            {

                $query->select('college_major_id')
                    ->from('saw_results')
                    ->groupBy('college_major_id')
                    ->orderByDesc(DB::raw('COUNT(college_major_id)'))
                    ->take(10);
            })
            ->groupBy('universities.id', 'universities.name')
            ->orderByDesc('popular_major_offerings')
            ->orderBy('universities.name')
            ->take(5)
            ->get();

        return view('pages.user.home.index', compact(
            'user',
            'student',
            'latestRecommendations',
            'topRecommendedMajors',
            'topUniversities'
        ));
    }
}
