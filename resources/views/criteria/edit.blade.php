<x-user-layout title="Edit Kriteria">
    <div class="container max-w-2xl px-4 py-6 ">
        <form action="{{ route('criterias.update', $criteria) }}" method="POST"
            class="flex flex-col gap-4 ">
            @csrf
            @method('PUT')

            <x-input label="Nama kriteria" name="name"
                value="{{ $criteria->name }}" placeholder="Masukkan nama kriteria"
                required />

            <x-textarea label="Deskripsi" name="description"
                value="{{ $criteria->description }}"
                placeholder="Masukkan deskripsi" />

            {{-- Todo: Tambahin atribut step="0.01" di component input --}}
            <x-input type="number" label="Bobot" name="weight"
                value="{{ $criteria->weight }}"
                placeholder="Masukkan bobot kriteria" required />

            <x-dropdown name="type" label="Tipe" required>
                <option value="">Pilih tipe kriteria</option>
                <option value="benefit"
                    {{ $criteria->type === 'benefit' ? 'selected' : '' }}>
                    Benefit</option>
                <option value="cost"
                    {{ $criteria->type === 'cost' ? 'selected' : '' }}>Cost
                </option>
            </x-dropdown>

            <x-dropdown name="school_type" label="Tipe Sekolah" required>
                <option value="">Pilih tipe sekolah</option>
                <option value="SMA"
                    {{ $criteria->school_type === 'SMA' ? 'selected' : '' }}>SMA
                </option>
                <option value="SMK"
                    {{ $criteria->school_type === 'SMK' ? 'selected' : '' }}>SMK
                </option>
                <option value="All"
                    {{ $criteria->school_type === 'All' ? 'selected' : '' }}>
                    Semua</option>
            </x-dropdown>

            <x-checkbox label="Aktif" name="is_active"
                {{ $criteria->is_active ? 'checked' : '' }} />

            <div class="flex gap-2 mt-4">
                <x-button type="submit">Simpan Perubahan</x-button>
                <a href="{{ route('criterias.index') }}"
                    class="px-4 py-2 text-sm font-medium transition-colors rounded-md bg-slate-100 text-slate-700 hover:bg-slate-200">
                    Batal
                </a>
            </div>
        </form>
    </div>
</x-user-layout>
