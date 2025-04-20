<x-user-layout title="Input Banyak Nilai Siswa">
    <div class="container max-w-2xl py-6">
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

        <div class="mb-6">
            <h1 class="text-2xl font-bold">Input Banyak Nilai Siswa</h1>
            <p class="text-gray-600">Silahkan isi nilai untuk semua kriteria yang
                tersedia</p>
        </div>

        @if (count($criterias) === 0)
            <div class="bg-yellow-100 p-4 rounded-md mb-4">
                <p class="text-yellow-700">Semua kriteria penilaian sudah Anda
                    isi. Tidak ada kriteria yang tersisa.</p>
                <div class="mt-4">
                    <a href="{{ route('student-scores.index') }}"
                        class="text-indigo-600 hover:text-indigo-800">
                        Kembali ke daftar nilai
                    </a>
                </div>
            </div>
        @else
            <form action="{{ route('student-scores.store-many') }}"
                method="POST" class="flex flex-col gap-4">
                @csrf

                @foreach ($criterias as $criteria)
                    <div
                        class="p-4 border border-gray-200 rounded-md shadow-sm">
                        <div class="mb-2">
                            <h3 class="font-semibold">{{ $criteria->name }}</h3>
                            <p class="text-sm text-gray-600">
                                {{ $criteria->description }}</p>
                            <span
                                class="inline-block px-2 py-1 text-xs rounded-full {{ $criteria->type == 'benefit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }} mt-1">
                                {{ $criteria->type == 'benefit' ? 'Benefit' : 'Cost' }}
                            </span>
                        </div>

                        <input type="hidden"
                            name="student_scores[{{ $loop->index }}][criteria_id]"
                            value="{{ $criteria->id }}">

                        <x-input type="number"
                            name="student_scores[{{ $loop->index }}][score]"
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                            step="0.01" min="0.01" max="100"
                            placeholder="Masukkan nilai {{ $criteria->name }}"
                            required />
                    </div>
                @endforeach

                <div class="mt-4 flex gap-2">
                    <x-button type="submit">Simpan Semua Nilai</x-button>
                    <a href="{{ route('student-scores.index') }}"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-600">Batal</a>
                </div>
            </form>
        @endif

        <div class="mt-6">
            <a href="{{ route('student-scores.create') }}"
                class="text-indigo-600 hover:text-indigo-800">
                Ingin mengisi satu nilai saja? Klik di sini
            </a>
        </div>
    </div>
</x-user-layout>
