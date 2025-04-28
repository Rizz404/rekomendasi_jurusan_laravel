<x-user-layout title="Rekomendasi Jurusan Kuliah">
    <div class="container px-4 py-6">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-semibold text-teto-dark-text">
                        Rekomendasi Jurusan Kuliah</h2>
                    <form
                        action="{{ route('my-recommendations.recalculate', $student) }}"
                        method="POST">
                        @csrf
                        <x-button type="submit">
                            Hitung Ulang Rekomendasi
                        </x-button>
                    </form>
                </div>

                <div class="mb-8">
                    <div class=" p-4 rounded-lg">
                        <h3
                            class="text-lg font-medium text-teto-dark-text mb-2">
                            Data Siswa</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-teto-dark-text">Nama</p>
                                <p class="font-medium">
                                    {{ $student->name ?? 'Belum diisi' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-teto-dark-text">NIS</p>
                                <p class="font-medium">
                                    {{ $student->NIS ?? 'Belum diisi' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-teto-dark-text">Asal
                                    Sekolah</p>
                                <p class="font-medium">
                                    {{ $student->school_origin ?? 'Belum diisi' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-teto-dark-text">Jenis
                                    Sekolah</p>
                                <p class="font-medium">
                                    @if ($student->school_type == 'high_school')
                                        SMA
                                    @elseif($student->school_type == 'vocational_school')
                                        SMK
                                    @else
                                        Belum diisi
                                    @endif
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-teto-dark-text">Jurusan
                                </p>
                                <p class="font-medium">
                                    {{ $student->school_major ?? 'Belum diisi' }}
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-teto-dark-text">Tahun
                                    Kelulusan</p>
                                <p class="font-medium">
                                    {{ $student->graduation_year ?? 'Belum diisi' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @if ($recommendations->isNotEmpty())
                    <h3 class="text-xl font-medium text-teto-dark-text mb-4">
                        Hasil
                        Rekomendasi Jurusan</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-teto-cream">
                            <thead class=" bg-teto-cream">
                                <tr>
                                    <th
                                        class="py-3 px-4  text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Peringkat</th>
                                    <th
                                        class="py-3 px-4  text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Nama Jurusan</th>
                                    <th
                                        class="py-3 px-4  text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Skor</th>
                                    <th
                                        class="py-3 px-4  text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Alasan</th>
                                    <th
                                        class="py-3 px-4  text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-teto-cream">
                                @foreach ($recommendations as $recommendation)
                                    <tr class="hover:">
                                        <td class="py-4 px-4 whitespace-nowrap">
                                            @if ($recommendation->rank <= 3)
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-teto-light text-white">
                                                    {{ $recommendation->rank }}
                                                </span>
                                            @else
                                                <span
                                                    class="text-gray-700">{{ $recommendation->rank }}</span>
                                            @endif
                                        </td>
                                        <td class="py-4 px-4">
                                            <div
                                                class="text-sm font-medium text-gray-900">
                                                {{ $recommendation->collegeMajor->major_name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                                {{ $recommendation->collegeMajor->faculty ?? 'Fakultas tidak tersedia' }}
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div
                                                class="text-sm font-medium 
                                                    {{ $recommendation->final_score >= 80 ? 'text-green-600' : ($recommendation->final_score >= 60 ? 'text-slate-600' : ($recommendation->final_score >= 40 ? 'text-yellow-600' : 'text-red-600')) }}">
                                                {{ number_format($recommendation->final_score * 100, 2) }}%
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <div class="text-sm text-gray-500">
                                                {{ $recommendation->recommendation_reason ? $recommendation->recommendation_reason : 'Tidak ada catatan khusus' }}
                                            </div>
                                        </td>
                                        <td class="py-4 px-4">
                                            <a href="{{ route('my-college-majors.show', $recommendation->college_major_id) }}"
                                                class="text-slate-600 hover:text-slate-900">Detail
                                                Jurusan</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 border-l-4 border-teto-accent p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-teto-accent"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-teto-accent">
                                    Rekomendasi ini berdasarkan data yang
                                    Anda masukkan. Hasilnya dapat berubah
                                    jika data diperbarui.
                                </p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class=" p-10 text-center rounded-lg">
                        <p class=text-teto-dark-text">Belum ada rekomendasi
                            jurusan. Silakan klik tombol "Hitung Ulang
                            Rekomendasi" untuk mendapatkan rekomendasi
                            jurusan kuliah.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-user-layout>
