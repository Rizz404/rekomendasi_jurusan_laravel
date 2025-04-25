<x-admin-layout title="Buat Jurusan">
    <div class="container max-w-3xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Buat Karakteristik Jurusan Baru
            </h1>
            <x-link-button
                href="{{ route('admin.major-characteristics.index') }}">
                Kembali
            </x-link-button>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.major-characteristics.store') }}"
                    method="POST" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-dropdown label="Jurusan Kuliah"
                            name="college_major_id">
                            <option value="">Pilih Jurusan</option>
                            @foreach ($collegeMajors as $collegeMajor)
                                <option value="{{ $collegeMajor->id }}"
                                    {{ old('college_major_id') === $collegeMajor->id ? 'selected' : '' }}>
                                    {{ $collegeMajor->major_name }}
                                </option>
                            @endforeach
                        </x-dropdown>

                        <x-dropdown label="Karakteristik Jurusan"
                            name="criteria_id">
                            <option value="">Pilih Karakteristik Jurusan
                            </option>
                            @foreach ($criterias as $criteria)
                                <option value="{{ $criteria->id }}"
                                    {{ old('criteria_id') === $criteria->id ? 'selected' : '' }}>
                                    {{ $criteria->name }}
                                </option>
                            @endforeach
                        </x-dropdown>

                        <x-input label="Berat Kompabilitas"
                            name="compatibility_weight" type="number"
                            step="0.01"
                            value="{{ old('compatibility_weight') }}"
                            placeholder="Masukkan berat kompabilitas"
                            required />

                        <x-input label="Nilai minimum" name="minimum_score"
                            type="number" step="0.01"
                            value="{{ old('minimum_score') }}"
                            placeholder="Masukkan nilai minimum" required />
                    </div>

                    <div class="flex justify-end mt-6">
                        <x-button type="submit">Simpan Data</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
