<x-admin-layout title="Dashboard">
    <div class="container px-4 py-6">

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

            <div
                class="bg-gradient-to-r from-teto-soft-blue to-teto-secondary rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3
                            class="text-sm font-medium uppercase tracking-wide opacity-90">
                            Total Pengguna</h3>
                        <p class="text-3xl font-bold">
                            {{ number_format($totalUsers) }}</p>
                        <div class="flex items-center mt-2">
                            <i
                                class="fas fa-arrow-up text-teto-soft-teal mr-1"></i>
                            <span class="text-sm">+{{ $newUsersThisMonth }} bulan
                                ini</span>
                        </div>
                    </div>
                    <div class="p-3 bg-white/10 rounded-full">
                        <i class="fas fa-users text-2xl"></i>
                    </div>
                </div>
            </div>


            <div
                class="bg-gradient-to-r from-teto-soft-teal to-teto-pastel-purple rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3
                            class="text-sm font-medium uppercase tracking-wide opacity-90">
                            Total Siswa</h3>
                        <p class="text-3xl font-bold">
                            {{ number_format($totalStudents) }}</p>
                        <div class="flex items-center mt-2">
                            <i
                                class="fas fa-arrow-up text-teto-soft-teal mr-1"></i>
                            <span class="text-sm">+{{ $newStudentsThisMonth }}
                                bulan ini</span>
                        </div>
                    </div>
                    <div class="p-3 bg-white/10 rounded-full">
                        <i class="fas fa-graduation-cap text-2xl"></i>
                    </div>
                </div>
            </div>


            <div
                class="bg-gradient-to-r from-teto-pastel-purple to-teto-secondary rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3
                            class="text-sm font-medium uppercase tracking-wide opacity-90">
                            Jurusan Aktif</h3>
                        <p class="text-3xl font-bold">
                            {{ number_format($totalCollegeMajors) }}</p>
                        <div class="flex items-center mt-2">
                            <i
                                class="fas fa-university text-teto-cream opacity-70 mr-1"></i>
                            <span class="text-sm">{{ $totalUniversities }}
                                Universitas</span>
                        </div>
                    </div>
                    <div class="p-3 bg-white/10 rounded-full">
                        <i class="fas fa-book text-2xl"></i>
                    </div>
                </div>
            </div>


            <div
                class="bg-gradient-to-r from-teto-accent to-teto-primary rounded-lg shadow-lg p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <h3
                            class="text-sm font-medium uppercase tracking-wide opacity-90">
                            Total Rekomendasi</h3>
                        <p class="text-3xl font-bold">
                            {{ number_format($totalRecommendations) }}</p>
                        <div class="flex items-center mt-2">
                            <i
                                class="fas fa-arrow-up text-teto-soft-teal mr-1"></i>
                            <span
                                class="text-sm">+{{ $recommendationsThisMonth }}
                                bulan ini</span>
                        </div>
                    </div>
                    <div class="p-3 bg-white/10 rounded-full">
                        <i class="fas fa-lightbulb text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">

            <div class="lg:col-span-1 bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <i class="fas fa-trophy text-teto-accent mr-2"></i>
                    <h2 class="text-xl font-bold text-teto-dark-text">Jurusan
                        Terpopuler</h2>
                </div>
                <div class="space-y-4">
                    @forelse($topMajors as $index => $major)
                        <div
                            class="flex items-center justify-between p-3 bg-teto-cream rounded-lg">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-gradient-to-r 
                                    @if ($index == 0) from-teto-accent to-teto-primary
                                    @elseif($index == 1) from-teto-metallic to-teto-metallic-hover
                                    @elseif($index == 2) from-teto-light to-teto-primary-hover
                                    @else from-teto-soft-blue to-teto-secondary @endif
                                    rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <p
                                        class="font-semibold text-teto-dark-text text-sm">
                                        {{ Str::limit($major->major_name, 25) }}
                                    </p>
                                    <p class="text-xs text-teto-dark-text-soft">
                                        {{ $major->total_recommendations }}
                                        rekomendasi</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-teto-dark-text-muted text-center py-4">
                            Belum ada data
                            jurusan</p>
                    @endforelse
                </div>
            </div>


            <div class="lg:col-span-1 bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <i class="fas fa-university text-teto-soft-blue mr-2"></i>
                    <h2 class="text-xl font-bold text-teto-dark-text">
                        Universitas
                        Unggulan</h2>
                </div>
                <div class="space-y-4">
                    @forelse($topUniversities as $index => $university)
                        <div
                            class="flex items-center justify-between p-3 bg-teto-cream rounded-lg">
                            <div class="flex items-center">
                                <div
                                    class="w-8 h-8 bg-gradient-to-r 
                                    @if ($index == 0) from-teto-soft-blue to-teto-secondary
                                    @elseif($index == 1) from-teto-soft-teal to-teto-pastel-purple
                                    @elseif($index == 2) from-teto-pastel-purple to-teto-secondary-hover 
                                    @else from-teto-metallic to-teto-metallic-hover @endif
                                    rounded-full flex items-center justify-center text-white font-bold text-sm mr-3">
                                    {{ $index + 1 }}
                                </div>
                                <div>
                                    <p
                                        class="font-semibold text-teto-dark-text text-sm">
                                        {{ Str::limit($university->name, 25) }}
                                    </p>
                                    <p class="text-xs text-teto-dark-text-soft">
                                        {{ $university->total_majors }} jurusan
                                    </p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <p class="text-teto-dark-text-muted text-center py-4">
                            Belum ada data
                            universitas</p>
                    @endforelse
                </div>
            </div>


            <div class="lg:col-span-1 bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <i class="fas fa-chart-bar text-teto-soft-teal mr-2"></i>
                    <h2 class="text-xl font-bold text-teto-dark-text">Statistik
                        Sistem
                    </h2>
                </div>
                <div class="space-y-4">
                    <div class="p-3 bg-teto-cream rounded-lg">
                        <p class="text-sm text-teto-dark-text-soft">Rata-rata
                            Nilai Siswa
                        </p>
                        <p class="text-2xl font-bold text-teto-soft-teal">
                            {{ number_format($systemStats['avg_score_per_student'] ?? 0, 2) }}
                        </p>
                    </div>
                    <div class="p-3 bg-teto-cream rounded-lg">
                        <p class="text-sm text-teto-dark-text-soft">Total Input
                            Nilai</p>
                        <p class="text-2xl font-bold text-teto-soft-blue">
                            {{ number_format($systemStats['total_student_scores'] ?? 0) }}
                        </p>
                    </div>
                    <div class="p-3 bg-teto-cream rounded-lg">
                        <p class="text-sm text-teto-dark-text-soft">Siswa Nilai
                            Lengkap</p>
                        <p class="text-2xl font-bold text-teto-pastel-purple">
                            {{ number_format($systemStats['students_with_complete_scores'] ?? 0) }}
                        </p>
                    </div>
                    <div class="p-3 bg-teto-cream rounded-lg">
                        <p class="text-sm text-teto-dark-text-soft">Kriteria
                            Aktif</p>
                        <p class="text-2xl font-bold text-teto-primary">
                            {{ $totalCriteria }}</p>
                    </div>
                </div>
            </div>
        </div>


        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">

            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <i class="fas fa-school text-teto-secondary mr-2"></i>
                    <h2 class="text-xl font-bold text-teto-dark-text">Distribusi
                        Jenis
                        Sekolah</h2>
                </div>
                <div class="space-y-3">
                    @forelse($schoolTypeDistribution as $distribution)
                        @php
                            $percentage =
                                $totalStudents > 0
                                    ? ($distribution->count / $totalStudents) *
                                        100
                                    : 0;
                            $schoolTypeLabel =
                                $distribution->school_type == 'high_school'
                                    ? 'SMA'
                                    : 'SMK';
                        @endphp
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <div
                                    class="w-4 h-4 rounded-full mr-3 
                                    {{ $distribution->school_type == 'high_school' ? 'bg-teto-soft-blue' : 'bg-teto-soft-teal' }}">
                                </div>
                                <span
                                    class="font-medium text-teto-dark-text">{{ $schoolTypeLabel }}</span>
                            </div>
                            <div class="flex items-center">
                                <span
                                    class="text-sm text-teto-dark-text-soft mr-2">{{ $distribution->count }}
                                    siswa</span>
                                <span
                                    class="text-sm font-bold text-teto-dark-text">{{ number_format($percentage, 1) }}%</span>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="h-2 rounded-full {{ $distribution->school_type == 'high_school' ? 'bg-teto-soft-blue' : 'bg-teto-soft-teal' }}"
                                style="width: {{ $percentage }}%"></div>
                        </div>
                    @empty
                        <p class="text-teto-dark-text-muted text-center py-4">
                            Belum ada data
                            distribusi sekolah</p>
                    @endforelse
                </div>
            </div>


            <div class="bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center mb-4">
                    <i
                        class="fas fa-calendar-alt text-teto-pastel-pink mr-2"></i>
                    <h2 class="text-xl font-bold text-teto-dark-text">Distribusi
                        Tahun
                        Lulus</h2>
                </div>
                <div class="space-y-3">
                    @forelse($graduationYearDistribution as $distribution)
                        @php
                            $percentage =
                                $totalStudents > 0
                                    ? ($distribution->count / $totalStudents) *
                                        100
                                    : 0;
                        @endphp
                        <div class="flex items-center justify-between">
                            <span
                                class="font-medium text-teto-dark-text">{{ $distribution->graduation_year }}</span>
                            <div class="flex items-center">
                                <span
                                    class="text-sm text-teto-dark-text-soft mr-2">{{ $distribution->count }}
                                    siswa</span>
                                <span
                                    class="text-sm font-bold text-teto-dark-text">{{ number_format($percentage, 1) }}%</span>
                            </div>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-gradient-to-r from-teto-pastel-pink to-teto-primary h-2 rounded-full"
                                style="width: {{ $percentage }}%"></div>
                        </div>
                    @empty
                        <p class="text-teto-dark-text-muted text-center py-4">
                            Belum ada
                            data tahun lulus</p>
                    @endforelse
                </div>
            </div>
        </div>


        <div class="bg-white rounded-lg shadow-lg p-6">
            <div class="flex items-center mb-6">
                <i class="fas fa-history text-teto-dark-text-muted mr-2"></i>
                <h2 class="text-xl font-bold text-teto-dark-text">Aktivitas
                    Terbaru
                </h2>
            </div>
            <div class="space-y-4">
                @forelse($recentActivities as $activity)
                    <div
                        class="flex items-center p-4 bg-teto-cream rounded-lg hover:bg-teto-cream-hover transition-colors">
                        <div class="p-2 rounded-full bg-white shadow-sm mr-4">
                            <i
                                class="fas {{ $activity['icon'] }} {{ $activity['color'] }}"></i>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium text-teto-dark-text">
                                {{ $activity['description'] }}</p>
                            <p class="text-xs text-teto-dark-text-muted">
                                {{ \Carbon\Carbon::parse($activity['created_at'])->diffForHumans() }}
                            </p>
                        </div>
                        <div class="text-xs text-teto-dark-text-muted">
                            {{ \Carbon\Carbon::parse($activity['created_at'])->format('H:i') }}
                        </div>
                    </div>
                @empty
                    <div class="text-center py-8">
                        <i
                            class="fas fa-inbox text-4xl text-teto-metallic mb-4"></i>
                        <p class="text-teto-dark-text-muted">Belum ada
                            aktivitas terbaru
                        </p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
</x-admin-layout>
