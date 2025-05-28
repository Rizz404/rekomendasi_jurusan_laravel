<x-user-layout title="Home">
    <div class="container px-4 py-8 mx-auto">

        <div
            class="relative p-8 mb-10 overflow-hidden bg-gradient-to-br from-teto-pastel-pink to-teto-primary rounded-md">
            <div class="relative z-10">
                <h1 class="text-4xl font-bold text-white">
                    Halo, {{ $user->username ?? 'Pengguna' }}!
                    <i class="fas fa-star text-teto-accent ml-1"></i>
                </h1>
                <p class="mt-4 text-xl text-white/90 font-medium">
                    Siap menjelajahi rekomendasi jurusan terbaik untuk masa
                    depanmu?
                </p>
                <p class="mt-2 text-lg text-white/80">
                    Jangan lupa, setiap langkah kecil adalah kemajuan! <i
                        class="fas fa-rocket ml-1"></i>
                </p>
            </div>

            <div
                class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-16 translate-x-16">
            </div>
            <div
                class="absolute bottom-0 left-0 w-24 h-24 bg-white/10 rounded-full translate-y-12 -translate-x-12">
            </div>
        </div>

        <div class="mb-12 text-center">
            <a href="{{ route('my-grades.index') }}"
                class="inline-flex items-center px-8 py-4 text-lg font-semibold text-white transition duration-300 ease-in-out transform bg-gradient-to-r from-teto-primary to-teto-dark rounded-md shadow-lg hover:scale-105 hover:shadow-xl hover:from-teto-primary-hover hover:to-teto-dark-hover">
                <i class="fas fa-edit mr-3 text-xl"></i>
                Kelola Nilai Saya (My Grade)
            </a>
        </div>

        @if ($student && $bestRecommendations && $bestRecommendations->count() > 0)
            <div class="mb-12">
                <div class="flex items-center mb-6">
                    <div class="w-1 h-8 bg-teto-primary rounded-full mr-4">
                    </div>
                    <h2 class="text-3xl font-bold text-teto-dark">
                        <i class="fas fa-medal mr-2"></i> Rekomendasi Terbaik
                        Untukmu
                    </h2>
                </div>

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($bestRecommendations as $rec)
                        <div
                            class="relative p-6 transition-all duration-300 bg-white shadow-lg rounded-md hover:shadow-xl hover:-translate-y-2">

                            <div class="absolute -top-3 -right-3">
                                <div
                                    class="flex items-center justify-center w-12 h-12 text-white font-bold rounded-full shadow-lg bg-gradient-to-r from-teto-accent to-teto-accent-active">
                                    #{{ $rec->rank }}
                                </div>
                            </div>

                            <div class="pt-4">
                                <h3
                                    class="text-xl font-bold mb-2 text-teto-dark-text">
                                    {{ $rec->major_name }}
                                </h3>
                                <div class="flex items-center mb-4">
                                    <i
                                        class="fas fa-star mr-2 text-teto-accent"></i>
                                    <span
                                        class="text-sm font-medium text-teto-dark-text-muted">
                                        Skor:
                                        {{ number_format($rec->final_score, 4) }}
                                    </span>
                                </div>

                                <div
                                    class="w-full bg-gray-200 rounded-full h-2 mb-4">
                                    <div class="h-2 rounded-full transition-all duration-500 bg-gradient-to-r from-teto-primary to-teto-accent"
                                        style="width: {{ min($rec->final_score * 100, 100) }}%;">
                                    </div>
                                </div>

                                <div class="text-xs text-teto-dark-text-muted">
                                    <i class="fas fa-clock mr-1"></i>
                                    Dihitung:
                                    {{ \Carbon\Carbon::parse($rec->calculation_date)->format('d M Y') }}
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-6 text-right">
                    <a href="#"
                        class="inline-flex items-center font-semibold text-teto-primary hover:text-teto-primary-hover transition-colors duration-200 hover:underline">
                        Lihat Semua Riwayat Rekomendasi
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        @elseif ($student)
            <div
                class="p-8 mb-12 bg-gradient-to-br from-teto-cream to-teto-secondary rounded-md shadow-lg">
                <div class="text-center">
                    <div
                        class="w-20 h-20 mx-auto mb-4 bg-teto-secondary-hover rounded-full flex items-center justify-center">
                        <i class="fas fa-search text-3xl text-white"></i>
                    </div>
                    <h2 class="text-2xl font-bold mb-4 text-teto-dark">
                        Belum Ada Rekomendasi Untukmu
                    </h2>
                    <p class="text-lg mb-6 text-teto-dark-text-soft">
                        Sepertinya kamu belum melakukan proses pencarian
                        rekomendasi.
                        Ayo mulai sekarang untuk menemukan jurusan yang paling
                        cocok!
                        Pastikan nilaimu sudah terisi di halaman "Kelola Nilai
                        Saya".
                    </p>
                    <a href="#"
                        class="inline-flex items-center px-8 py-3 font-semibold text-white transition duration-300 bg-gradient-to-r from-teto-soft-teal to-teto-soft-blue rounded-md shadow-lg hover:shadow-xl hover:scale-105">
                        <i class="fas fa-rocket mr-3"></i>
                        Mulai Cari Rekomendasi!
                    </a>
                </div>
            </div>
        @endif

        <div class="grid gap-12 lg:grid-cols-2">
            <div>
                <div class="flex items-center mb-6">
                    <div class="w-1 h-8 bg-teto-accent rounded-full mr-4"></div>
                    <h2 class="text-2xl font-bold text-teto-dark">
                        <i class="fas fa-trophy mr-2"></i> Jurusan Terpopuler
                    </h2>
                </div>

                @if ($topRecommendedMajors->count() > 0)
                    <div class="space-y-4">
                        @foreach ($topRecommendedMajors as $index => $major)
                            <div
                                class="flex items-center p-5 transition-all duration-300 bg-white rounded-md shadow-lg hover:shadow-xl hover:-translate-y-1">
                                <div
                                    class="flex items-center justify-center w-12 h-12 mr-4 font-bold text-white rounded-full shadow-md
                                        @if ($index == 0) bg-gradient-to-r from-teto-accent to-teto-accent-active
                                        @elseif($index == 1) bg-gradient-to-r from-teto-secondary to-teto-secondary-active
                                        @else bg-gradient-to-r from-teto-light to-teto-primary @endif">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1">
                                    <h3
                                        class="text-lg font-bold mb-1 text-teto-dark-text">
                                        {{ $major->major_name }}
                                    </h3>
                                    <div class="flex items-center">
                                        <i
                                            class="fas fa-users mr-2 text-sm text-teto-dark-text-muted"></i>
                                        <span
                                            class="text-sm text-teto-dark-text-muted">
                                            Direkomendasikan
                                            {{ $major->recommendation_count }}
                                            kali
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <i
                                        class="fas fa-chevron-right text-teto-primary"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-8 text-center bg-teto-cream rounded-md">
                        <i
                            class="fas fa-chart-bar text-4xl mb-4 text-teto-metallic"></i>
                        <p class="text-teto-dark-text-muted">Belum ada data
                            jurusan yang cukup untuk ditampilkan.</p>
                    </div>
                @endif
            </div>

            <div>
                <div class="flex items-center mb-6">
                    <div class="w-1 h-8 bg-teto-soft-teal rounded-full mr-4">
                    </div>
                    <h2 class="text-2xl font-bold text-teto-dark">
                        <i class="fas fa-graduation-cap mr-2"></i> Universitas
                        Unggulan
                    </h2>
                </div>

                @if ($topUniversities->count() > 0)
                    <div class="space-y-4">
                        @foreach ($topUniversities as $index => $uni)
                            <div
                                class="flex items-center p-5 transition-all duration-300 bg-white rounded-md shadow-lg hover:shadow-xl hover:-translate-y-1">
                                <div
                                    class="flex items-center justify-center w-12 h-12 mr-4 font-bold text-white rounded-full shadow-md
                                        @if ($index == 0) bg-teto-soft-teal
                                        @elseif($index == 1) bg-teto-soft-blue
                                        @else bg-teto-secondary @endif">
                                    {{ $index + 1 }}
                                </div>
                                <div class="flex-1">
                                    <h3
                                        class="text-lg font-bold mb-1 text-teto-dark-text">
                                        {{ $uni->university_name }}
                                    </h3>
                                    <div class="flex items-center">
                                        <i
                                            class="fas fa-graduation-cap mr-2 text-sm text-teto-dark-text-muted"></i>
                                        <span
                                            class="text-sm text-teto-dark-text-muted">
                                            Menawarkan
                                            {{ $uni->popular_major_offerings }}
                                            jurusan populer
                                        </span>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <i
                                        class="fas fa-chevron-right text-teto-primary"></i>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-8 text-center bg-teto-cream rounded-md">
                        <i
                            class="fas fa-university text-4xl mb-4 text-teto-metallic"></i>
                        <p class="text-teto-dark-text-muted">Belum ada data
                            universitas yang cukup untuk ditampilkan.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="pt-12 mt-12 border-t-2 border-teto-pastel-pink">
            <div class="flex items-center mb-6">
                <div class="w-1 h-8 bg-teto-primary rounded-full mr-4"></div>
                <h2 class="text-2xl font-bold text-teto-dark">
                    <i class="fas fa-bolt mr-2"></i> Akses Cepat Lainnya
                </h2>
            </div>

            <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                <a href="{{ route('profile.index') }}"
                    class="flex items-center p-4 transition-all duration-300 bg-white rounded-md shadow-lg hover:shadow-xl hover:-translate-y-1 group">
                    <div
                        class="flex items-center justify-center w-12 h-12 mr-4 bg-teto-cream rounded-full transition-colors duration-300 group-hover:bg-teto-primary">
                        <i
                            class="fas fa-user-edit text-teto-primary transition-colors duration-300 group-hover:text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-teto-dark-text">Edit
                            Profil Siswa</h3>
                        <p class="text-sm text-teto-dark-text-muted">Kelola
                            informasi pribadi</p>
                    </div>
                </a>

                <a href="{{ route('my-college-majors.index') }}"
                    class="flex items-center p-4 transition-all duration-300 bg-white rounded-md shadow-lg hover:shadow-xl hover:-translate-y-1 group">
                    <div
                        class="flex items-center justify-center w-12 h-12 mr-4 bg-teto-cream rounded-full transition-colors duration-300 group-hover:bg-teto-accent">
                        <i
                            class="fas fa-compass text-teto-accent transition-colors duration-300 group-hover:text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-teto-dark-text">Eksplorasi
                            Jurusan</h3>
                        <p class="text-sm text-teto-dark-text-muted">Temukan
                            semua jurusan</p>
                    </div>
                </a>

                <a href="{{ route('my-universities.index') }}"
                    class="flex items-center p-4 transition-all duration-300 bg-white rounded-md shadow-lg hover:shadow-xl hover:-translate-y-1 group">
                    <div
                        class="flex items-center justify-center w-12 h-12 mr-4 bg-teto-cream rounded-full transition-colors duration-300 group-hover:bg-teto-soft-teal">
                        <i
                            class="fas fa-building text-teto-soft-teal transition-colors duration-300 group-hover:text-white"></i>
                    </div>
                    <div>
                        <h3 class="font-semibold text-teto-dark-text">
                            Eksplorasi
                            Universitas</h3>
                        <p class="text-sm text-teto-dark-text-muted">Jelajahi
                            kampus terbaik</p>
                    </div>
                </a>
            </div>
        </div>

        <div
            class="mt-12 p-8 bg-gradient-to-r bg-teto-secondary rounded-md text-center">
            <h3 class="text-2xl font-bold text-white mb-2 decorative-text">
                "Masa depan dimulai dari pilihan hari ini"
            </h3>
            <p class="text-white/90 text-lg">
                Terus semangat dalam mengejar impianmu! <i
                    class="fas fa-star text-white/90"></i><i
                    class="fas fa-sparkles text-white/90 ml-1"></i>
            </p>
        </div>
    </div>
</x-user-layout>
