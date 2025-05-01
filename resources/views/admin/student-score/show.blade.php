<x-admin-layout title="Detail Nilai Siswa">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Detail Nilai Siswa</h1>
            <div class="flex space-x-2">
                <x-link-button href="{{ route('admin.student-scores.index') }}">
                    Kembali
                </x-link-button>
                <x-link-button
                    href="{{ route('admin.student-scores.edit', $studentScore) }}">
                    Edit
                </x-link-button>
                <form
                    action="{{ route('admin.student-scores.destroy', $studentScore) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus nilai ini?')">
                    @csrf
                    @method('DELETE')
                    <x-button type="submit"
                        class="bg-red-500 hover:bg-red-600">
                        Hapus
                    </x-button>
                </form>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <h2 class="text-xl font-semibold mb-4">Informasi Siswa
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-teto-dark-text">Nama
                                    Siswa
                                </p>
                                <p class="font-medium">
                                    {{ $studentScore->student->name }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">NIS</p>
                                <p class="font-medium">
                                    {{ $studentScore->student->NIS ?? 'Tidak ada' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Jenis
                                    Kelamin
                                </p>
                                <p class="font-medium">
                                    @if ($studentScore->student->gender === 'man')
                                        Laki-laki
                                    @elseif($studentScore->student->gender === 'woman')
                                        Perempuan
                                    @else
                                        Tidak diisi
                                    @endif
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Sekolah
                                    Asal
                                </p>
                                <p class="font-medium">
                                    {{ $studentScore->student->school_origin ?? 'Tidak ada' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Jenis
                                    Sekolah
                                </p>
                                <p class="font-medium">
                                    @if ($studentScore->student->school_type === 'high_school')
                                        SMA
                                    @elseif($studentScore->student->school_type === 'vocational_school')
                                        SMK
                                    @else
                                        Tidak diisi
                                    @endif
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Jurusan
                                    Sekolah
                                </p>
                                <p class="font-medium">
                                    {{ $studentScore->student->school_major ?? 'Tidak ada' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Tahun
                                    Kelulusan
                                </p>
                                <p class="font-medium">
                                    {{ $studentScore->student->graduation_year ?? 'Tidak ada' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-xl font-semibold mb-4">Informasi Nilai
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-teto-dark-text">Kriteria
                                </p>
                                <p class="font-medium">
                                    {{ $studentScore->criteria->name }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Tipe
                                    Kriteria
                                </p>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $studentScore->criteria->type === 'benefit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($studentScore->criteria->type) }}
                                </span>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Bobot
                                    Kriteria
                                </p>
                                <p class="font-medium">
                                    {{ $studentScore->criteria->weight }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Tipe
                                    Sekolah
                                </p>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $studentScore->criteria->school_type }}
                                </span>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Nilai</p>
                                <div class="mt-1">
                                    <div
                                        class="bg-gray-200 rounded-full h-2 overflow-hidden">
                                        <div class="bg-blue-500 h-2 rounded-full"
                                            style="width: {{ $studentScore->score }}%">
                                        </div>
                                    </div>
                                    <p class="mt-1 font-medium">
                                        {{ $studentScore->score }} / 100
                                    </p>
                                </div>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Tanggal
                                    Input
                                </p>
                                <p class="font-medium">
                                    {{ $studentScore->input_date->format('d F Y') }}
                                </p>
                            </div>

                            <div class="mt-6">
                                <p class="text-sm text-teto-dark-text">Deskripsi
                                    Kriteria</p>
                                <div class="bg-teto-cream rounded-md p-2 mt-1">
                                    <p
                                        class="text-sm text-gray-700 whitespace-pre-wrap">
                                        {{ $studentScore->criteria->description ?? 'Tidak ada deskripsi' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <p class="text-sm text-teto-dark-text">Tanggal
                                Pembuatan
                            </p>
                            <p class="font-medium">
                                {{ $studentScore->created_at->format('d F Y H:i') }}
                            </p>
                        </div>

                        <div class="mt-2">
                            <p class="text-sm text-teto-dark-text">Terakhir
                                Diperbarui
                            </p>
                            <p class="font-medium">
                                {{ $studentScore->updated_at->format('d F Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
