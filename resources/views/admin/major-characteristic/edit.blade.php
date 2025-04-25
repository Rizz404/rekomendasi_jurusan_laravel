<x-admin-layout title="Edit Jurusan">
    <div class="container max-w-3xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Edit Jurusan</h1>
            <div class=" flex space-x-2">
                <x-link-button
                    href="{{ route('admin.major-characteristics.show', $majorCharacteristic) }}">
                    Detail
                </x-link-button>
                <x-link-button
                    href="{{ route('admin.major-characteristics.index') }}">
                    Kembali
                </x-link-button>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form
                    action="{{ route('admin.major-characteristics.update', $majorCharacteristic) }}"
                    method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-dropdown label="Jurusan Kuliah"
                            name="college_major_id">
                            <option
                                value="{{ $majorCharacteristic->collegeMajor->college_major_id }}"
                                selected disabled>
                                {{ $majorCharacteristic->collegeMajor->major_name }}
                            </option>
                        </x-dropdown>

                        <x-dropdown label="Karakteristik Jurusan"
                            name="criteria_id">
                            </option>
                            <option
                                value="{{ $majorCharacteristic->criteria->criteria_id }}"
                                selected disabled>
                                {{ $majorCharacteristic->criteria->name }}
                            </option>
                        </x-dropdown>

                        <x-input label="Berat Kompabilitas"
                            name="compatibility_weight" type="number"
                            step="0.01"
                            value="{{ old('compatibility_weight', $majorCharacteristic->compatibility_weight) }}"
                            placeholder="Masukkan berat kompabilitas"
                            required />

                        <x-input label="Nilai minimum" name="minimum_score"
                            type="number" step="0.01"
                            value="{{ old('minimum_score', $majorCharacteristic->minimum_score) }}"
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
