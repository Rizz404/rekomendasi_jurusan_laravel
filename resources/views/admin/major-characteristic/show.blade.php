<x-admin-layout title="Detail Karakteristik Jurusan">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Detail Karakteristik Jurusan</h1>
            <div class="flex space-x-2">
                <x-link-button
                    href="{{ route('admin.major-characteristics.index') }}">
                    Kembali
                </x-link-button>
                <x-link-button
                    href="{{ route('admin.major-characteristics.edit', $majorCharacteristic) }}">
                    Edit
                </x-link-button>
                <form
                    action="{{ route('admin.major-characteristics.destroy', $majorCharacteristic) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus karakteristik ini?')">
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
                        <h2 class="text-xl font-semibold mb-4">Informasi Jurusan
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-teto-dark-text">Nama
                                    Jurusan
                                </p>
                                <p class="font-medium">
                                    {{ $majorCharacteristic->collegeMajor->major_name }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Fakultas
                                </p>
                                <p class="font-medium">
                                    {{ $majorCharacteristic->collegeMajor->faculty ?? 'Tidak ada' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Bidang
                                    Studi
                                </p>
                                <p class="font-medium">
                                    {{ $majorCharacteristic->collegeMajor->field_of_study ?? 'Tidak ada' }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Deskripsi
                                    Jurusan</p>
                                <div class="bg-teto-cream rounded-md p-2 mt-1">
                                    <p class="text-sm text-gray-700 ">
                                        {{ $majorCharacteristic->collegeMajor->description ?? 'Tidak ada deskripsi' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <h2 class="text-xl font-semibold mb-4 mt-6">Informasi
                            Kriteria</h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-teto-dark-text">Nama
                                    Kriteria
                                </p>
                                <p class="font-medium">
                                    {{ $majorCharacteristic->criteria->name }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Tipe
                                    Kriteria
                                </p>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $majorCharacteristic->criteria->type === 'benefit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($majorCharacteristic->criteria->type) }}
                                </span>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Bobot
                                    Kriteria
                                </p>
                                <p class="font-medium">
                                    {{ $majorCharacteristic->criteria->weight }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Tipe
                                    Sekolah
                                </p>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $majorCharacteristic->criteria->school_type }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div>
                        <h2 class="text-xl font-semibold mb-4">Kompatibilitas
                        </h2>
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-teto-dark-text">Bobot
                                    Kompatibilitas</p>
                                <div class="mt-1">
                                    <div
                                        class="bg-gray-200 rounded-full h-2 overflow-hidden">
                                        <div class="bg-blue-500 h-2 rounded-full"
                                            style="width: {{ $majorCharacteristic->compatibility_weight * 100 }}%">
                                        </div>
                                    </div>
                                    <p class="mt-1 font-medium">
                                        {{ $majorCharacteristic->compatibility_weight }}
                                        ({{ $majorCharacteristic->compatibility_weight * 100 }}%)
                                    </p>
                                </div>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Nilai
                                    Minimum
                                </p>
                                <p class="font-medium">
                                    @if ($majorCharacteristic->minimum_score)
                                        {{ $majorCharacteristic->minimum_score }}
                                        / 100
                                    @else
                                        <span class="text-teto-dark-text">Tidak
                                            ada
                                            nilai minimum</span>
                                    @endif
                                </p>
                            </div>

                            <div class="mt-6">
                                <p class="text-sm text-teto-dark-text">Deskripsi
                                    Kriteria</p>
                                <div class="bg-teto-cream rounded-md p-2 mt-1">
                                    <p class="text-sm text-gray-700 ">
                                        {{ $majorCharacteristic->criteria->description ?? 'Tidak ada deskripsi' }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-6">
                                <p class="text-sm text-teto-dark-text">Prospek
                                    Karir
                                    Jurusan</p>
                                <div class="bg-teto-cream rounded-md p-2 mt-1">
                                    <p class="text-sm text-gray-700 ">
                                        {{ $majorCharacteristic->collegeMajor->career_prospects ?? 'Tidak ada informasi prospek karir' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="mt-6">
                            <p class="text-sm text-teto-dark-text">Tanggal
                                Pembuatan
                            </p>
                            <p class="font-medium">
                                {{ $majorCharacteristic->created_at->format('d F Y H:i') }}
                            </p>
                        </div>

                        <div class="mt-2">
                            <p class="text-sm text-teto-dark-text">Terakhir
                                Diperbarui
                            </p>
                            <p class="font-medium">
                                {{ $majorCharacteristic->updated_at->format('d F Y H:i') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
