<x-admin-layout title="Buat Universitas Baru">
    <div class="container max-w-3xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Buat Universitas Baru</h1>
            <x-link-button href="{{ route('admin.universities.index') }}">
                Kembali
            </x-link-button>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form action="{{ route('admin.universities.store') }}"
                    method="POST" class="space-y-4">
                    @csrf

                    {{-- Grid untuk field universitas --}}
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

                        <x-input label="URL Logo" name="logo" type="url"
                            value="{{ old('logo') }}"
                            placeholder="https://contoh.com/logo.png" />

                        <x-input label="Rating (0-5)" name="rating"
                            type="number" step="0.01" min="0"
                            max="5" value="{{ old('rating', 0) }}"
                            placeholder="Masukkan rating" required />

                        <div class="flex items-center space-x-2 md:col-span-2">
                            <input type="checkbox" name="is_active"
                                id="is_active" value="1"
                                class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                                {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                            <label for="is_active"
                                class="block text-sm font-medium text-gray-700">
                                Aktif
                            </label>
                        </div>
                    </div>

                    <x-textarea label="Deskripsi" name="description"
                        value="{{ old('description') }}"
                        placeholder="Masukkan deskripsi singkat universitas (opsional)" />

                    {{-- Input untuk Jurusan Kuliah (Many-to-Many) --}}
                    <div class="mt-4">
                        <label for="college_majors"
                            class="block text-sm font-medium text-gray-700 mb-1">
                            Jurusan Kuliah yang Tersedia
                        </label>
                        {{-- !! PENTING: Tambahkan class atau ID untuk inisialisasi JS Library (misal Select2, TomSelect) --}}
                        {{-- Contoh: class="select2-multiple" --}}
                        <select name="college_majors[]" id="college_majors"
                            multiple
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm h-48">
                            {{-- h-48 untuk memberikan tinggi default pada select multiple standar --}}
                            @foreach ($collegeMajors as $major)
                                <option value="{{ $major->id }}"
                                    {{-- Cek apakah ID jurusan ini ada di input lama (jika validasi gagal) --}}
                                    {{ in_array($major->id, old('college_majors', [])) ? 'selected' : '' }}>
                                    {{ $major->major_name }}
                                    {{ $major->faculty ? "({$major->faculty})" : '' }}
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-1 text-xs text-gray-500">Tahan Ctrl (atau
                            Cmd di Mac) dan klik untuk memilih lebih dari satu.
                        </p>
                        {{-- Tampilkan error validasi untuk college_majors --}}
                        @error('college_majors')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}</p>
                        @enderror
                        @error('college_majors.*')
                            <p class="text-sm text-red-600 mt-1">
                                {{ $message }}</p>
                        @enderror
                    </div>
                    {{-- Akhir Input Jurusan Kuliah --}}


                    <div class="flex justify-end mt-6">
                        <x-button type="submit">Simpan Data</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
