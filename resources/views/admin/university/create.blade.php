<x-admin-layout title="Tambah Universitas Baru">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Tambah Universitas Baru</h1>
            <div class="flex space-x-2">
                <x-link-button href="{{ route('admin.universities.index') }}">
                    Kembali
                </x-link-button>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.universities.store') }}"
                    method="POST" class="space-y-4"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-input label="Nama Universitas" name="name"
                            value="{{ old('name') }}"
                            placeholder="Masukkan nama universitas" required />

                        <x-dropdown label="Status" name="status" required>
                            <option value="">Pilih Status</option>
                            @foreach ($status as $value)
                                <option value="{{ $value }}"
                                    {{ old('status') === $value ? 'selected' : '' }}>
                                    {{ ucfirst($value) }}
                                </option>
                            @endforeach
                        </x-dropdown>

                        <x-input label="Kota" name="city"
                            value="{{ old('city') }}"
                            placeholder="Masukkan kota universitas" required />

                        <x-input label="Provinsi" name="province"
                            value="{{ old('province') }}"
                            placeholder="Masukkan provinsi universitas"
                            required />

                        <x-input label="Website" name="website" type="url"
                            value="{{ old('website') }}"
                            placeholder="https://contoh.com" />

                        <x-input label="Rating (0-5)" name="rating"
                            type="number" step="0.01" min="0"
                            max="5" value="{{ old('rating') }}"
                            placeholder="Masukkan rating" required />

                        <input type="hidden" name="is_active" value="0">
                        <x-checkbox label="Aktif" name="is_active"
                            :checked="old('is_active') == 1" labelPosition="side" />
                    </div>

                    <x-file-input name="logo" label="Logo" accept="image/*"
                        helpText="Upload a square image for best results. Max size: 2MB" />

                    <x-textarea label="Deskripsi" name="description"
                        value="{{ old('description') }}"
                        placeholder="Masukkan deskripsi singkat universitas (opsional)" />

                    <div class="mt-4">
                        <label
                            class="block text-sm font-medium text-gray-700 mb-1">
                            Jurusan Kuliah yang Tersedia
                        </label>

                        <div
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 mt-1">
                            @forelse ($collegeMajors as $major)
                                <x-checkbox name="college_majors[]"
                                    value="{{ $major->id }}"
                                    :checked="in_array(
                                        $major->id,
                                        old('college_majors', []),
                                    )" :label="$major->major_name .
                                        ($major->faculty
                                            ? ' (' . $major->faculty . ')'
                                            : '')"
                                    labelPosition="side" />
                            @empty
                                <div
                                    class="col-span-3 py-2 px-3 bg-gray-50 rounded text-gray-500">
                                    Jurusan kuliah tidak tersedia
                                </div>
                            @endforelse
                        </div>

                        @error('college_majors')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}</p>
                        @enderror
                        @error('college_majors.*')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-6">
                        <x-button type="submit">Simpan</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
