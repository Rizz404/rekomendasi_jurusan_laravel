<x-admin-layout title="Edit Jurusan">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Edit Jurusan</h1>
            <div class=" flex space-x-2">
                <x-link-button
                    href="{{ route('admin.student-scores.show', $studentScore) }}">
                    Detail
                </x-link-button>
                <x-link-button href="{{ route('admin.student-scores.index') }}">
                    Kembali
                </x-link-button>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form
                    action="{{ route('admin.student-scores.update', $studentScore) }}"
                    method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-dropdown label="Siswa" name="student_id">
                            <option
                                value="{{ $studentScore->student->student_id }}"
                                selected disabled>
                                {{ $studentScore->student->name }}
                            </option>
                        </x-dropdown>

                        <x-dropdown label="Kriteria" name="criteria_id">
                            <option
                                value="{{ $studentScore->criteria->criteria_id }}"
                                selected disabled>
                                {{ $studentScore->criteria->name }}
                            </option>
                        </x-dropdown>

                        <x-input label="Score" name="score" type="number"
                            step="0.01"
                            value="{{ old('score', $studentScore->score) }}"
                            placeholder="Masukkan score" required />
                    </div>

                    <div class="flex justify-end mt-6">
                        <x-button type="submit">Simpan Data</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
