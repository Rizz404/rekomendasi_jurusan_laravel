<x-user-layout title="Edit Nilai Siswa">
    <div class="container max-w-2xl py-6">
        <x-ui.breadcrumb :items="[
            ['title' => 'Nilai saya', 'url' => route('my-grades.index')],
            ['title' => $studentScore->criteria->name, 'url' => '#'],
        ]" :show-back-button="true" :back-url="route('my-grades.index')"
            back-text="Kembali ke daftar universitas" />

        <div class="mb-6">
            <h1 class="text-2xl font-bold">Edit Nilai Siswa</h1>
        </div>


        <form action="{{ route('my-grades.update', $studentScore) }}"
            method="POST" class="flex flex-col gap-4">
            @csrf
            @method('PATCH')

            <x-ui.dropdown name="criteria_id" label="Kriteria" required>
                <option value="{{ $studentScore->criteria_id }}" selected>
                    {{ $studentScore->criteria->name }}
                    ({{ $studentScore->criteria->type == 'benefit' ? 'Benefit' : 'Cost' }})
                </option>
                @foreach ($criterias as $criteria)
                    <option value="{{ $criteria->id }}">
                        {{ $criteria->name }}
                        ({{ $criteria->type == 'benefit' ? 'Benefit' : 'Cost' }})
                    </option>
                @endforeach
            </x-ui.dropdown>

            <x-ui.input label="Nilai" name="score"
                value="{{ old('score', $studentScore->score) }}" type="number"
                step="0.01" min="0" max="100"
                placeholder="Masukkan nilai Anda" required />

            <div class="mt-4 flex gap-2">
                <x-ui.button type="submit">Simpan</x-ui.button>
                <a href="{{ route('my-grades.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Batal</a>
            </div>
        </form>

        <div class="mt-6">
            <a href="{{ route('my-grades.create-many') }}"
                class="text-indigo-600 hover:text-indigo-800">
                Ingin mengisi banyak nilai sekaligus? Klik di sini
            </a>
        </div>
    </div>
</x-user-layout>
