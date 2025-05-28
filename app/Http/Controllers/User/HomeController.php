<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CollegeMajor; // * ? Pastikan model ini ada
use App\Models\SawResult;    // * ? Pastikan model ini ada
use App\Models\Student;     // * ? Pastikan model ini ada
use App\Models\University;  // * ? Pastikan model ini ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // * Ambil data siswa terkait user yang login
        // * ? Asumsi ada relasi 'student' di model User atau sebaliknya
        $student = $user->student; // * atau Student::where('user_id', $user->id)->first();

        // * 1. Ambil rekomendasi terakhir untuk siswa saat ini (jika ada)
        $latestRecommendations = null;
        if ($student)
        {
            $latestRecommendations = SawResult::where('student_id', $student->id)
                ->join('college_majors', 'saw_results.college_major_id', '=', 'college_majors.id')
                ->orderBy('saw_results.calculation_date', 'desc') // * Asumsi calculation_date menandakan batch terakhir
                ->orderBy('saw_results.rank', 'asc')
                ->select('college_majors.major_name', 'saw_results.final_score', 'saw_results.rank')
                ->take(3) // * Ambil 3 teratas dari rekomendasi terakhirnya
                ->get();
        }

        // * 2. Jurusan yang Paling Sering Direkomendasikan (Secara Umum)
        $topRecommendedMajors = CollegeMajor::query()
            ->select('college_majors.major_name', DB::raw('COUNT(saw_results.college_major_id) as recommendation_count'))
            ->join('saw_results', 'college_majors.id', '=', 'saw_results.college_major_id')
            // * ->where('saw_results.rank', '<=', 3) // * Opsional: Hanya hitung yang masuk top 3
            ->groupBy('college_majors.id', 'college_majors.major_name') // * Group by ID juga untuk akurasi
            ->orderByDesc('recommendation_count')
            ->orderBy('college_majors.major_name') // * Tambahan order untuk konsistensi jika count sama
            ->take(5) // * Ambil 5 teratas
            ->get();

        // * 3. Universitas yang Sering Direkomendasikan (Berdasarkan jurusan populer)
        // * Ini bisa diartikan sebagai universitas yang menawarkan jurusan-jurusan populer
        $topUniversities = University::query()
            ->select('universities.name as university_name', DB::raw('COUNT(DISTINCT college_major_university.college_major_id) as popular_major_offerings'))
            // * Menghitung berapa banyak jurusan populer yang mereka tawarkan
            ->join('college_major_university', 'universities.id', '=', 'college_major_university.university_id')
            ->whereIn('college_major_university.college_major_id', function ($query)
            {
                // * Subquery untuk mendapatkan ID jurusan yang populer (sering muncul di saw_results)
                $query->select('college_major_id')
                    ->from('saw_results')
                    ->groupBy('college_major_id')
                    ->orderByDesc(DB::raw('COUNT(college_major_id)'))
                    ->take(10); // * Ambil 10 jurusan terpopuler sebagai basis
            })
            ->groupBy('universities.id', 'universities.name') // * Group by ID juga
            ->orderByDesc('popular_major_offerings')
            ->orderBy('universities.name') // * Tambahan order
            ->take(5) // * Ambil 5 universitas teratas
            ->get();

        // * Alternatif sederhana untuk Top Universities: Universitas dengan jumlah jurusan terbanyak yang ADA di saw_results
        // * $topUniversitiesSimple = University::query()
        // *     ->select('universities.name as university_name', DB::raw('COUNT(college_major_university.university_id) as recommended_major_count'))
        // *     ->join('college_major_university', 'universities.id', '=', 'college_major_university.university_id')
        // *     ->join('saw_results', 'college_major_university.college_major_id', '=', 'saw_results.college_major_id')
        // *     ->groupBy('universities.id', 'universities.name')
        // *     ->orderByDesc('recommended_major_count')
        // *     ->take(5)
        // *     ->distinct() // * Pastikan universitas unik jika ada duplikasi dari join
        // *     ->get();


        // * Kirim data ke view
        return view('pages.user.home.index', compact(
            'user',
            'student',
            'latestRecommendations',
            'topRecommendedMajors',
            'topUniversities' // * atau 'topUniversitiesSimple'
        ));
    }
}
