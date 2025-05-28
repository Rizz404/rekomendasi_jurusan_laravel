<x-user-layout title="Home">
    <div class="container px-4 py-8 mx-auto">
        {{-- Sapaan Personal --}}
        <h1 class="text-3xl font-semibold text-gray-800">
            Halo, <span
                class="text-orange-500">{{ $user->username ?? 'Pengguna' }}</span>!
        </h1>
        <p class="mt-2 text-lg text-gray-600">
            Siap menjelajahi rekomendasi jurusan terbaik untuk masa depanmu?
            Jangan lupa, setiap langkah kecil adalah kemajuan!
        </p>

        {{-- CTA ke Halaman Nilai (My Grade) --}}
        <div class="mt-6 text-center md:text-left">
            <a href="{{ route('my-grades.index') }}" {{-- Ganti 'my-grades.index' dengan nama route yang sesuai --}}
                class="inline-block px-8 py-3 text-lg font-semibold text-white transition duration-150 ease-in-out transform bg-orange-500 rounded-lg shadow-md hover:bg-orange-600 hover:scale-105">
                📝 Kelola Nilai Saya (My Grade)
            </a>
        </div>

        {{-- Rekomendasi Terakhir Untuk Anda (Jika Ada) --}}
        @if ($student && $latestRecommendations && $latestRecommendations->count() > 0)
            <div class="mt-10">
                <h2 class="mb-4 text-2xl font-semibold text-gray-700">Rekomendasi
                    Terakhir Untukmu</h2>
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach ($latestRecommendations as $rec)
                        <div class="p-6 bg-white shadow-lg rounded-xl">
                            <div class="flex items-center justify-between mb-2">
                                <span
                                    class="px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded-full">
                                    Peringkat #{{ $rec->rank }}
                                </span>
                            </div>
                            <h3 class="text-xl font-bold text-gray-800">
                                {{ $rec->major_name }}</h3>
                            <p class="text-sm text-gray-600">Skor:
                                {{ number_format($rec->final_score, 4) }}</p>
                            {{-- Tambahkan link ke detail jurusan jika ada --}}
                        </div>
                    @endforeach
                </div>
                <div class="mt-4 text-right">
                    <a href="{{-- route('user.recommendations.history') --}}"
                        class="font-semibold text-orange-500 hover:text-orange-700">
                        Lihat Semua Riwayat Rekomendasi &rarr;
                    </a>
                </div>
            </div>
        @elseif ($student)
            <div class="p-6 mt-10 rounded-lg shadow bg-blue-50">
                <h2 class="text-xl font-semibold text-blue-700">Belum Ada
                    Rekomendasi Untukmu</h2>
                <p class="mt-2 text-blue-600">
                    Sepertinya kamu belum melakukan proses pencarian
                    rekomendasi. Ayo mulai sekarang untuk menemukan jurusan yang
                    paling cocok! Pastikan nilaimu sudah terisi di halaman
                    "Kelola Nilai Saya".
                </p>
                <a href="{{-- route('user.recommendations.create_form') --}}" {{-- Route untuk memulai proses rekomendasi --}}
                    class="inline-block px-6 py-2 mt-4 font-semibold text-white bg-green-500 rounded-md hover:bg-green-600">
                    Mulai Cari Rekomendasi!
                </a>
            </div>
        @endif


        <div class="grid mt-12 md:grid-cols-2 gap-x-8 gap-y-10">
            {{-- Jurusan Paling Sering Direkomendasikan --}}
            <div>
                <h2 class="mb-5 text-2xl font-semibold text-gray-700">🏆 Jurusan
                    Terpopuler</h2>
                @if ($topRecommendedMajors->count() > 0)
                    <ul class="space-y-4">
                        @foreach ($topRecommendedMajors as $index => $major)
                            <li
                                class="flex items-center p-4 transition-shadow bg-white rounded-lg shadow-md hover:shadow-lg">
                                <span
                                    class="mr-4 text-2xl font-bold text-orange-500">{{ $index + 1 }}.</span>
                                <div class="flex-1">
                                    <h3
                                        class="text-lg font-semibold text-gray-800">
                                        {{ $major->major_name }}</h3>
                                    <p class="text-sm text-gray-500">
                                        Direkomendasikan
                                        {{ $major->recommendation_count }} kali
                                    </p>
                                </div>
                                {{-- <a href="#" class="text-sm text-orange-500 hover:underline">Lihat Detail</a> --}}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600">Belum ada data jurusan yang cukup
                        untuk ditampilkan.</p>
                @endif
            </div>

            {{-- Universitas Paling Sering Direkomendasikan --}}
            <div>
                <h2 class="mb-5 text-2xl font-semibold text-gray-700">🎓
                    Universitas Unggulan</h2>
                @if ($topUniversities->count() > 0)
                    <ul class="space-y-4">
                        @foreach ($topUniversities as $index => $uni)
                            <li
                                class="flex items-center p-4 transition-shadow bg-white rounded-lg shadow-md hover:shadow-lg">
                                <span
                                    class="mr-4 text-2xl font-bold text-orange-500">{{ $index + 1 }}.</span>
                                <div class="flex-1">
                                    <h3
                                        class="text-lg font-semibold text-gray-800">
                                        {{ $uni->university_name }}</h3>
                                    <p class="text-sm text-gray-500">Menawarkan
                                        {{ $uni->popular_major_offerings }}
                                        jurusan populer</p>
                                </div>
                                {{-- <a href="#" class="text-sm text-orange-500 hover:underline">Lihat Detail</a> --}}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-gray-600">Belum ada data universitas yang
                        cukup untuk ditampilkan.</p>
                @endif
            </div>
        </div>

        {{-- Quick Links Tambahan --}}
        <div class="pt-8 mt-12 border-t">
            <h2 class="mb-3 text-xl font-semibold text-gray-700">Akses Cepat
                Lainnya</h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('profile.index') }}" {{-- Ganti dengan route edit profil siswa/user --}}
                    class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                    Edit Profil Siswa
                </a>
                <a href="{{-- route('user.majors.explore') --}}" {{-- Route untuk eksplorasi semua jurusan --}}
                    class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                    Eksplorasi Semua Jurusan
                </a>
                <a href="{{-- route('user.universities.explore') --}}" {{-- Route untuk eksplorasi semua universitas --}}
                    class="px-5 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200">
                    Eksplorasi Semua Universitas
                </a>
            </div>
        </div>

    </div>
</x-user-layout>
