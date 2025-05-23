<x-admin-layout title="Buat Nilai Siswa">
    <div class="container max-w-4xl mx-auto py-6">
        @if (session('raw'))
            <div class="alert alert-danger">
                {{ session('raw') }}
            </div>
        @endif

        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Buat Nilai Siswa
            </h1>
            <x-ui.link-button href="{{ route('admin.student-scores.index') }}">
                Kembali
            </x-ui.link-button>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.student-scores.store') }}"
                    method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-ui.dropdown label="Siswa" name="student_id">
                            <option value="">Pilih Siswa</option>
                            @foreach ($students as $student)
                                <option value="{{ $student->id }}"
                                    {{ old('student_id') === $student->id ? 'selected' : '' }}>
                                    {{ $student->name }}
                                </option>
                            @endforeach
                        </x-ui.dropdown>

                        <x-ui.dropdown label="Kriteria" name="criteria_id">
                            <option value="">Pilih Kriteria
                            </option>
                            @foreach ($criterias as $criteria)
                                <option value="{{ $criteria->id }}"
                                    {{ old('criteria_id') === $criteria->id ? 'selected' : '' }}>
                                    {{ $criteria->name }}
                                </option>
                            @endforeach
                        </x-ui.dropdown>

                        <x-ui.input label="Score" name="score" type="number"
                            step="0.01" value="{{ old('score') }}"
                            placeholder="Masukkan score" required />
                    </div>

                    <div class="flex justify-end mt-6">
                        <x-ui.button type="submit">Simpan Data</x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
