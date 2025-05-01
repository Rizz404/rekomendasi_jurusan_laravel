<x-admin-layout title="Detail Kriteria">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Detail Kriteria</h1>
            <div class="flex space-x-2">
                <x-link-button href="{{ route('admin.criterias.index') }}">
                    Kembali
                </x-link-button>
                <x-link-button
                    href="{{ route('admin.criterias.edit', $criteria) }}">
                    Edit
                </x-link-button>
                <form action="{{ route('admin.criterias.destroy', $criteria) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus kriteria ini?')">
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
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-teto-dark-text">Nama
                                    Kriteria
                                </p>
                                <p class="font-medium">{{ $criteria->name }}</p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Bobot</p>
                                <p class="font-medium">{{ $criteria->weight }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Tipe</p>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $criteria->type === 'benefit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($criteria->type) }}
                                </span>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Tipe
                                    Sekolah
                                </p>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    {{ $criteria->school_type }}
                                </span>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Status
                                </p>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $criteria->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $criteria->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Tanggal
                                    Dibuat
                                </p>
                                <p class="font-medium">
                                    {{ $criteria->created_at->format('d F Y H:i') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Terakhir
                                    Diperbarui</p>
                                <p class="font-medium">
                                    {{ $criteria->updated_at->format('d F Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div>
                            <p class="text-sm text-teto-dark-text mb-2">
                                Deskripsi</p>
                            <div class="bg-teto-cream rounded-md p-4">
                                <p class="whitespace-pre-wrap">
                                    {{ $criteria->description ?? 'Tidak ada deskripsi' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
