<x-user-layout title="Tambah Kriteria">
    <div class="container max-w-2xl px-4 py-6 ">
        <form action="{{ route('criterias.store') }}" method="POST"
            class="flex flex-col gap-4 ">

            @csrf

            <x-input label="Nama kriteria" name="name"
                placeholder="Masukkan nama kriteria" required />

            <x-textarea label="Deskripsi" name="description"
                placeholder="Masukkan deskripsi" />

            {{-- Todo: Tambahin atribut step="0.01" di component input --}}
            <x-input type="number" label="Bobot" name="weight"
                placeholder="Masukkan bobot kriteria" required step="0.01" />

            <x-dropdown name="type" label="Tipe" required>
                <option value="">Pilih tipe kriteria</option>
                @foreach ($types as $type)
                    <option value="{{ $type }}">
                        {{ $type }}
                    </option>
                @endforeach
            </x-dropdown>

            <x-dropdown name="school_type" label="Tipe Sekolah" required>
                <option value="">Pilih tipe sekolah</option>
                @foreach ($schoolTypes as $schoolType)
                    <option value="{{ $schoolType }}">
                        {{ $schoolType }}
                    </option>
                @endforeach
            </x-dropdown>

            <x-checkbox label="Aktif" name="is_active" />

            <x-button type="submit">Submit</x-button>
        </form>
    </div>
</x-user-layout>
