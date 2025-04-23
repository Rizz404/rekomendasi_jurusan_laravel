<x-user-layout title="Input Nilai Siswa">
    <div class="container max-w-2xl py-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold">Input Nilai Siswa</h1>
            <p class="text-gray-600">Silahkan pilih kriteria dan masukkan nilai
                Anda</p>
        </div>

        @if (count($criterias) === 0)
            <div class="bg-yellow-100 p-4 rounded-md mb-4">
                <p class="text-yellow-700">Semua kriteria penilaian sudah Anda
                    isi. Tidak ada kriteria yang tersisa.</p>
            </div>
        @else
            <form action="{{ route('my-grades.store') }}" method="POST"
                class="flex flex-col gap-4">
                @csrf

                <x-dropdown name="criteria_id" label="Kriteria" required>
                    <option value="">Pilih kriteria</option>
                    @foreach ($criterias as $criteria)
                        <option value="{{ $criteria->id }}">
                            {{ $criteria->name }}
                            ({{ $criteria->type == 'benefit' ? 'Benefit' : 'Cost' }})
                        </option>
                    @endforeach
                </x-dropdown>

                <x-input label="Nilai" name="score" type="number"
                    step="0.01" min="0" max="100"
                    placeholder="Masukkan nilai Anda" required />

                <div class="mt-4 flex gap-2">
                    <x-button type="submit">Simpan</x-button>
                    <a href="{{ route('my-grades.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Batal</a>
                </div>
            </form>
        @endif

        <div class="mt-6">
            <a href="{{ route('my-grades.create-many') }}"
                class="text-indigo-600 hover:text-indigo-800">
                Ingin mengisi banyak nilai sekaligus? Klik di sini
            </a>
        </div>
    </div>
</x-user-layout>
