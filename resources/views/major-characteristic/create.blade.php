<x-user-layout title="Input Karakteristik Jurusan">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('raw'))
        <div class="alert alert-danger">
            {{ session('raw') }}
        </div>
    @endif

    <div class="container max-w-2xl py-6">
        <div class="mb-6">
            <h1 class="text-2xl font-bold">Input Karakteristik Jurusan
                {{ $collegeMajor->name }}</h1>
            <p class="text-gray-600">Silahkan pilih kriteria dan masukkan nilai
                Anda</p>
        </div>

        <form action="{{ route('major-characteristics.store') }}" method="POST"
            class="flex flex-col gap-4">
            @csrf

            <x-input type="hidden" name="college_major_id"
                value="{{ $collegeMajor->id }}" />

            <x-dropdown name="criteria_id" label="Kriteria" required>
                <option value="">Pilih kriteria</option>
                @foreach ($criterias as $criteria)
                    <option value="{{ $criteria->id }}">
                        {{ $criteria->name }}
                        ({{ $criteria->type == 'benefit' ? 'Benefit' : 'Cost' }})
                    </option>
                @endforeach
            </x-dropdown>


            <x-input label="Nilai" name="compatibility_weight" type="number"
                step="0.01" min="0" max="100"
                placeholder="Masukkan compatibility weight nilai Anda"
                required />

            <x-input label="Nilai" name="minimum_score" type="number"
                step="0.01" min="0" max="100"
                placeholder="Masukkan minimum nilai Anda" required />

            <div class="mt-4 flex gap-2">
                <x-button type="submit">Simpan</x-button>
                <a href="{{ route('major-characteristics.index') }}"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Batal</a>
            </div>
        </form>

        <div class="mt-6">
            <a href="{{ route('major-characteristics.create-many') }}"
                class="text-indigo-600 hover:text-indigo-800">
                Ingin mengisi banyak nilai sekaligus? Klik di sini
            </a>
        </div>
    </div>
</x-user-layout>
