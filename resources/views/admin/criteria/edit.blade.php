<x-admin-layout title="Edit Kriteria">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Edit Kriteria</h1>
            <div class=" flex space-x-2">
                <x-link-button
                    href="{{ route('admin.criterias.show', $criteria) }}">
                    Detail
                </x-link-button>
                <x-link-button href="{{ route('admin.criterias.index') }}">
                    Kembali
                </x-link-button>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.criterias.update', $criteria) }}"
                    method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input label="Nama Kriteria" name="name"
                            value="{{ old('name', $criteria->name) }}"
                            placeholder="Masukkan nama kriteria" required />

                        <x-input label="Bobot" name="weight" type="number"
                            step="0.01"
                            value="{{ old('weight', $criteria->weight) }}"
                            placeholder="Masukkan bobot kriteria" required />

                        <x-dropdown label="Tipe" name="type" required>
                            <option value="">Pilih Tipe</option>
                            <option value="benefit"
                                {{ old('type', $criteria->type) === 'benefit' ? 'selected' : '' }}>
                                Benefit</option>
                            <option value="cost"
                                {{ old('type', $criteria->type) === 'cost' ? 'selected' : '' }}>
                                Cost</option>
                        </x-dropdown>

                        <x-dropdown label="Tipe Sekolah" name="school_type"
                            required>
                            <option value="">Pilih Tipe Sekolah</option>
                            <option value="SMA"
                                {{ old('school_type', $criteria->school_type) === 'SMA' ? 'selected' : '' }}>
                                SMA</option>
                            <option value="SMK"
                                {{ old('school_type', $criteria->school_type) === 'SMK' ? 'selected' : '' }}>
                                SMK</option>
                            <option value="All"
                                {{ old('school_type', $criteria->school_type) === 'All' ? 'selected' : '' }}>
                                Semua</option>
                        </x-dropdown>

                        <div class="flex items-center space-x-2">
                            <input type="checkbox" name="is_active"
                                id="is_active" value="1"
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                {{ old('is_active', $criteria->is_active, '1') === '1' ? 'checked' : '' }}>
                            <label for="is_active"
                                class="block text-sm font-medium text-gray-700">
                                Aktif
                            </label>
                        </div>
                    </div>

                    <x-textarea label="Deskripsi" name="description"
                        value="{{ old('description', $criteria->description) }}" />

                    <div class="flex justify-end mt-6">
                        <x-button type="submit">Simpan Data</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
