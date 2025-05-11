<x-admin-layout title="Edit Kriteria">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Edit Kriteria</h1>
            <div class=" flex space-x-2">
                <x-ui.link-button
                    href="{{ route('admin.criterias.show', $criteria) }}">
                    Detail
                </x-ui.link-button>
                <x-ui.link-button href="{{ route('admin.criterias.index') }}">
                    Kembali
                </x-ui.link-button>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.criterias.update', $criteria) }}"
                    method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-ui.input label="Nama Kriteria" name="name"
                            value="{{ old('name', $criteria->name) }}"
                            placeholder="Masukkan nama kriteria" required />

                        <x-ui.input label="Bobot" name="weight" type="number"
                            step="0.01"
                            value="{{ old('weight', $criteria->weight) }}"
                            placeholder="Masukkan bobot kriteria" required />

                        <x-ui.dropdown label="Tipe" name="type" required>
                            <option value="">Pilih Tipe</option>
                            <option value="benefit"
                                {{ old('type', $criteria->type) === 'benefit' ? 'selected' : '' }}>
                                Benefit</option>
                            <option value="cost"
                                {{ old('type', $criteria->type) === 'cost' ? 'selected' : '' }}>
                                Cost</option>
                        </x-ui.dropdown>

                        <x-ui.dropdown label="Tipe Sekolah" name="school_type"
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
                        </x-ui.dropdown>

                        <input type="hidden" name="is_active" value="0">
                        <x-ui.checkbox label="Aktif" name="is_active"
                            :checked="old('is_active', $criteria->is_active) ==
                                1" labelPosition="side" />
                    </div>

                    <x-ui.textarea label="Deskripsi" name="description"
                        value="{{ old('description', $criteria->description) }}" />

                    <div class="flex justify-end mt-6">
                        <x-ui.button type="submit">Simpan Data</x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
