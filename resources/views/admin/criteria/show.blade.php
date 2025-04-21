<x-user-layout title="{{ $criteria->major_name }}">
    <div class="container px-4 py-8 max-w-4xl mx-auto">
        {{-- Header Section --}}
        <div class="flex justify-between items-center mb-8">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">
                    {{ $criteria->major_name }}</h1>
                <span
                    class="inline-block mt-2 px-3 py-1 text-sm rounded-full {{ $criteria->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                    {{ $criteria->is_active ? 'Aktif' : 'Nonaktif' }}
                </span>
            </div>
            <div class="flex space-x-3">
                <x-link-button href="{{ route('criterias.edit', $criteria) }}"
                    class="bg-blue-500 text-white hover:bg-blue-600">
                    Edit
                </x-link-button>
                <form action="{{ route('criterias.destroy', $criteria) }}"
                    method="POST"
                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors">
                        Hapus
                    </button>
                </form>
            </div>
        </div>

        {{-- Details Section --}}
        <div
            class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 space-y-6">
            {{-- Basic Information --}}
            <div>
                <h2
                    class="text-xl font-semibold text-slate-800 border-b pb-2 mb-4">
                    Informasi Dasar</h2>
                <div class="grid md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-slate-600 font-medium">Fakultas
                        </p>
                        <p class="text-slate-800">
                            {{ $criteria->faculty ?? 'Tidak ditentukan' }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm text-slate-600 font-medium">Bidang
                            Studi</p>
                        <p class="text-slate-800">
                            {{ $criteria->field_of_study ?? 'Tidak ditentukan' }}
                        </p>
                    </div>
                </div>
            </div>

            {{-- Description Section --}}
            @if ($criteria->description)
                <div>
                    <h2
                        class="text-xl font-semibold text-slate-800 border-b pb-2 mb-4">
                        Deskripsi Kriteria</h2>
                    <p class="text-slate-600 leading-relaxed">
                        {{ $criteria->description }}
                    </p>
                </div>
            @endif

            {{-- Career Prospects Section --}}
            @if ($criteria->career_prospects)
                <div>
                    <h2
                        class="text-xl font-semibold text-slate-800 border-b pb-2 mb-4">
                        Prospek Karir</h2>
                    <p class="text-slate-600 leading-relaxed">
                        {{ $criteria->career_prospects }}
                    </p>
                </div>
            @endif

            {{-- Additional Information (Optional) --}}
            <div class="bg-slate-50 rounded-lg p-4">
                <h3 class="text-sm font-medium text-slate-600 mb-2">Informasi
                    Tambahan</h3>
                <div class="text-sm text-slate-500">
                    <p>Dibuat:
                        {{ $criteria->created_at->translatedFormat('d F Y') }}
                    </p>
                    <p>Terakhir diperbarui:
                        {{ $criteria->updated_at->translatedFormat('d F Y') }}
                    </p>
                </div>
            </div>
        </div>

        {{-- Back to List Button --}}
        <div class="mt-8 text-center">
            <x-link-button href="{{ route('criterias.index') }}"
                class="bg-slate-200 text-slate-700 hover:bg-slate-300">
                Kembali ke Daftar Kriteria
            </x-link-button>
        </div>
    </div>
</x-user-layout>
