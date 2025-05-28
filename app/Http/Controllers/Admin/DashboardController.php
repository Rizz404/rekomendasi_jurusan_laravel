<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Student;
use App\Models\CollegeMajor;
use App\Models\University;
use App\Models\Criteria;
use App\Models\SawResult;
use App\Models\StudentScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik Umum
        $totalUsers = User::count();
        $totalStudents = Student::count();
        $totalCollegeMajors = CollegeMajor::where('is_active', true)->count();
        $totalUniversities = University::where('is_active', true)->count();
        $totalCriteria = Criteria::where('is_active', true)->count();
        $totalRecommendations = SawResult::count();

        // Statistik Bulan Ini
        $currentMonth = Carbon::now()->format('Y-m');
        $newUsersThisMonth = User::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        $newStudentsThisMonth = Student::whereYear('created_at', Carbon::now()->year)
            ->whereMonth('created_at', Carbon::now()->month)
            ->count();

        $recommendationsThisMonth = SawResult::whereYear('calculation_date', Carbon::now()->year)
            ->whereMonth('calculation_date', Carbon::now()->month)
            ->count();

        // Jurusan Paling Populer (Top 5)
        $topMajors = CollegeMajor::select('college_majors.major_name', DB::raw('COUNT(saw_results.id) as total_recommendations'))
            ->leftJoin('saw_results', 'college_majors.id', '=', 'saw_results.college_major_id')
            ->where('college_majors.is_active', true)
            ->groupBy('college_majors.id', 'college_majors.major_name')
            ->orderByDesc('total_recommendations')
            ->take(5)
            ->get();

        // Universitas dengan Jurusan Terbanyak (Top 5)
        $topUniversities = University::select('universities.name', DB::raw('COUNT(college_major_university.college_major_id) as total_majors'))
            ->join('college_major_university', 'universities.id', '=', 'college_major_university.university_id')
            ->where('universities.is_active', true)
            ->groupBy('universities.id', 'universities.name')
            ->orderByDesc('total_majors')
            ->take(5)
            ->get();

        // Distribusi Siswa Berdasarkan Jenis Sekolah
        $schoolTypeDistribution = Student::select('school_type', DB::raw('COUNT(*) as count'))
            ->whereNotNull('school_type')
            ->groupBy('school_type')
            ->get();

        // Distribusi Siswa Berdasarkan Tahun Lulus
        $graduationYearDistribution = Student::select('graduation_year', DB::raw('COUNT(*) as count'))
            ->whereNotNull('graduation_year')
            ->where('graduation_year', '>=', Carbon::now()->year - 5) // 5 tahun terakhir
            ->groupBy('graduation_year')
            ->orderBy('graduation_year', 'desc')
            ->get();

        // Aktivitas Terbaru (Latest 10)
        $recentActivities = collect();

        // Recent Users
        $recentUsers = User::with('student')
            ->where('role', 'user')
            ->latest()
            ->take(5)
            ->get()
            ->map(function ($user)
            {
                return [
                    'type' => 'user_registration',
                    'description' => "Pengguna baru: {$user->username}",
                    'created_at' => $user->created_at,
                    'icon' => 'fa-user-plus',
                    'color' => 'text-green-600'
                ];
            });

        // Recent Recommendations
        $recentRecommendations = SawResult::with(['student.user', 'collegeMajor'])
            ->latest('calculation_date')
            ->take(5)
            ->get()
            ->map(function ($result)
            {
                return [
                    'type' => 'recommendation',
                    'description' => "Rekomendasi untuk {$result->student->user->username}: {$result->collegeMajor->major_name}",
                    'created_at' => $result->calculation_date,
                    'icon' => 'fa-lightbulb',
                    'color' => 'text-blue-600'
                ];
            });

        $recentActivities = $recentUsers->concat($recentRecommendations)
            ->sortByDesc('created_at')
            ->take(10);

        // Sistem Statistik
        $systemStats = [
            'avg_score_per_student' => StudentScore::avg('score'),
            'total_student_scores' => StudentScore::count(),
            'students_with_complete_scores' => Student::whereHas('studentScores', function ($query)
            {
                $activeCriteriaCount = Criteria::where('is_active', true)->count();
                $query->select('student_id')
                    ->groupBy('student_id')
                    ->havingRaw('COUNT(*) = ?', [$activeCriteriaCount]);
            })->count(),
            'average_recommendations_per_student' => SawResult::select('student_id')
                ->groupBy('student_id')
                ->get()
                ->avg(function ($group)
                {
                    return SawResult::where('student_id', $group->student_id)->count();
                })
        ];

        return view('pages.admin.dashboard.index', compact(
            'totalUsers',
            'totalStudents',
            'totalCollegeMajors',
            'totalUniversities',
            'totalCriteria',
            'totalRecommendations',
            'newUsersThisMonth',
            'newStudentsThisMonth',
            'recommendationsThisMonth',
            'topMajors',
            'topUniversities',
            'schoolTypeDistribution',
            'graduationYearDistribution',
            'recentActivities',
            'systemStats'
        ));
    }
}
