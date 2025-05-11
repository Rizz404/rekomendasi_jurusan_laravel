<x-admin-layout title="Edit Jurusan">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Edit Jurusan</h1>
            <div class=" flex space-x-2">
                <x-ui.link-button
                    href="{{ route('admin.major-characteristics.show', $majorCharacteristic) }}">
                    Detail
                </x-ui.link-button>
                <x-ui.link-button
                    href="{{ route('admin.major-characteristics.index') }}">
                    Kembali
                </x-ui.link-button>
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
                        <x-ui.dropdown label="Jurusan Kuliah"
                            name="college_major_id">
                            <option
                                value="{{ $majorCharacteristic->collegeMajor->college_major_id }}"
                                selected disabled>
                                {{ $majorCharacteristic->collegeMajor->major_name }}
                            </option>
                        </x-ui.dropdown>

                        <x-ui.dropdown label="Karakteristik Jurusan"
                            name="criteria_id">
                            </option>
                            <option
                                value="{{ $majorCharacteristic->criteria->criteria_id }}"
                                selected disabled>
                                {{ $majorCharacteristic->criteria->name }}
                            </option>
                        </x-ui.dropdown>

                        <x-ui.input label="Berat Kompabilitas"
                            name="compatibility_weight" type="number"
                            step="0.01"
                            value="{{ old('compatibility_weight', $majorCharacteristic->compatibility_weight) }}"
                            placeholder="Masukkan berat kompabilitas"
                            required />

                        <x-ui.input label="Nilai minimum" name="minimum_score"
                            type="number" step="0.01"
                            value="{{ old('minimum_score', $majorCharacteristic->minimum_score) }}"
                            placeholder="Masukkan nilai minimum" required />
                    </div>

                    <div class="flex justify-end mt-6">
                        <x-ui.button type="submit">Simpan Data</x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
