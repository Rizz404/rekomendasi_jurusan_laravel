<x-admin-layout title="Detail Jurusan Kuliah">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Detail Jurusan Kuliah</h1>
            <div class="flex space-x-2">
                <x-ui.link-button
                    href="{{ route('admin.college-majors.index') }}">
                    Kembali
                </x-ui.link-button>
                <x-ui.link-button
                    href="{{ route('admin.college-majors.edit', $collegeMajor) }}">
                    Edit
                </x-ui.link-button>
                <form
                    action="{{ route('admin.college-majors.destroy', $collegeMajor) }}"
                    method="POST"
                    onsubmit="return confirm('Yakin ingin menghapus kriteria ini?')">
                    @csrf
                    @method('DELETE')
                    <x-ui.button type="submit"
                        class="bg-red-500 hover:bg-red-600">
                        Hapus
                    </x-ui.button>
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
                                    Jurusan
                                    Kuliah
                                </p>
                                <p class="font-medium">
                                    {{ $collegeMajor->major_name }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Fakultas
                                </p>
                                <p class="font-medium">
                                    {{ $collegeMajor->faculty }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Studi
                                    Pendidikan</p>
                                <p class="font-medium">
                                    {{ $collegeMajor->field_of_study }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Status
                                </p>
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium 
                                    {{ $collegeMajor->is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $collegeMajor->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                </span>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Tanggal
                                    Dibuat
                                </p>
                                <p class="font-medium">
                                    {{ $collegeMajor->created_at->format('d F Y H:i') }}
                                </p>
                            </div>

                            <div>
                                <p class="text-sm text-teto-dark-text">Terakhir
                                    Diperbarui</p>
                                <p class="font-medium">
                                    {{ $collegeMajor->updated_at->format('d F Y H:i') }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div>
                        <div>
                            <p class="text-sm text-teto-dark-text mb-2">
                                Deskripsi</p>
                            <div class="bg-teto-cream rounded-md p-4">
                                <p class="">
                                    {{ $collegeMajor->description ?? 'Tidak ada deskripsi' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
