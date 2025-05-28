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

        // Mengambil rekomendasi terbaik berdasarkan skor tertinggi
        $bestRecommendations = null;
        if ($student)
        {
            $bestRecommendations = SawResult::where('student_id', $student->id)
                ->where('final_score', '>', 0) // Hanya ambil yang skornya > 0
                ->join('college_majors', 'saw_results.college_major_id', '=', 'college_majors.id')
                ->orderByDesc('saw_results.final_score') // Urutkan berdasarkan skor tertinggi
                ->orderBy('saw_results.rank', 'asc') // Kemudian berdasarkan rank terkecil
                ->select(
                    'college_majors.major_name',
                    'saw_results.final_score',
                    'saw_results.rank',
                    'saw_results.calculation_date'
                )
                ->take(3) // Ambil 3 rekomendasi terbaik
                ->get();
        }

        // Jurusan yang paling sering direkomendasikan
        $topRecommendedMajors = CollegeMajor::query()
            ->select(
                'college_majors.major_name',
                DB::raw('COUNT(saw_results.college_major_id) as recommendation_count')
            )
            ->join('saw_results', 'college_majors.id', '=', 'saw_results.college_major_id')
            ->where('saw_results.final_score', '>', 0) // Hanya hitung yang skornya > 0
            ->groupBy('college_majors.id', 'college_majors.major_name')
            ->orderByDesc('recommendation_count')
            ->orderBy('college_majors.major_name')
            ->take(5)
            ->get();

        // Universitas unggulan berdasarkan jurusan populer
        $topUniversities = University::query()
            ->select(
                'universities.name as university_name',
                DB::raw('COUNT(DISTINCT college_major_university.college_major_id) as popular_major_offerings')
            )
            ->join('college_major_university', 'universities.id', '=', 'college_major_university.university_id')
            ->whereIn('college_major_university.college_major_id', function ($query)
            {
                // Subquery untuk mengambil 10 jurusan paling populer
                $query->select('college_major_id')
                    ->from('saw_results')
                    ->where('final_score', '>', 0) // Hanya hitung yang skornya > 0
                    ->groupBy('college_major_id')
                    ->orderByDesc(DB::raw('COUNT(college_major_id)'))
                    ->take(10);
            })
            ->where('universities.is_active', true) // Hanya universitas yang aktif
            ->groupBy('universities.id', 'universities.name')
            ->orderByDesc('popular_major_offerings')
            ->orderBy('universities.name')
            ->take(5)
            ->get();

        return view('pages.user.home.index', compact(
            'user',
            'student',
            'bestRecommendations', // Ganti dari latestRecommendations ke bestRecommendations
            'topRecommendedMajors',
            'topUniversities'
        ));
    }
}
