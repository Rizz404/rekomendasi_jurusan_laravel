<x-admin-layout title="Buat Kriteria Baru">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Buat Kriteria Baru</h1>
            <x-link-button href="{{ route('admin.criterias.index') }}">
                Kembali
            </x-link-button>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.criterias.store') }}" method="POST"
                    class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input label="Nama Kriteria" name="name"
                            value="{{ old('name') }}"
                            placeholder="Masukkan nama kriteria" required />

                        <x-input label="Bobot" name="weight" type="number"
                            step="0.01" value="{{ old('weight') }}"
                            placeholder="Masukkan bobot kriteria" required />

                        <x-dropdown label="Tipe" name="type" required>
                            <option value="">Pilih Tipe</option>
                            <option value="benefit"
                                {{ old('type') === 'benefit' ? 'selected' : '' }}>
                                Benefit</option>
                            <option value="cost"
                                {{ old('type') === 'cost' ? 'selected' : '' }}>
                                Cost</option>
                        </x-dropdown>

                        <x-dropdown label="Tipe Sekolah" name="school_type"
                            required>
                            <option value="">Pilih Tipe Sekolah</option>
                            <option value="SMA"
                                {{ old('school_type') === 'SMA' ? 'selected' : '' }}>
                                SMA</option>
                            <option value="SMK"
                                {{ old('school_type') === 'SMK' ? 'selected' : '' }}>
                                SMK</option>
                            <option value="All"
                                {{ old('school_type') === 'All' ? 'selected' : '' }}>
                                Semua</option>
                        </x-dropdown>

                        {{-- * Biar kalo gak chek bakal kirim 0 soalnya defaultnya checkbox kaga ngirim kalo gak check --}}
                        <input type="hidden" name="is_active" value="0">
                        <x-checkbox label="Aktif" name="is_active"
                            value="{{ old('is_active') }}" />
                    </div>

                    <x-textarea label="Deskripsi" name="description"
                        value="{{ old('description') }}" />

                    <div class="flex justify-end mt-6">
                        <x-button type="submit">Simpan Data</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
