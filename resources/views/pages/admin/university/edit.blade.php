<x-admin-layout title="Edit Universitas">
    <div class="container max-w-4xl mx-auto py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Edit Universitas:
                {{ $university->name }}</h1>
            <div class="flex space-x-2">
                <x-ui.link-button
                    href="{{ route('admin.universities.show', $university) }}">
                    Detail
                </x-ui.link-button>
                <x-ui.link-button href="{{ route('admin.universities.index') }}">
                    Kembali
                </x-ui.link-button>
            </div>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-6">
                <form
                    action="{{ route('admin.universities.update', $university) }}"
                    method="POST" class="space-y-4"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <x-ui.input label="Nama Universitas" name="name"
                            value="{{ old('name', $university->name) }}"
                            placeholder="Masukkan nama universitas" required />

                        <x-ui.dropdown label="Status" name="status" required>
                            <option value="">Pilih Status</option>
                            @foreach ($status as $value)
                                <option value="{{ $value }}"
                                    {{ old('status', $university->status) === $value ? 'selected' : '' }}>
                                    {{ ucfirst($value) }}
                                </option>
                            @endforeach
                        </x-ui.dropdown>

                        <x-ui.input label="Kota" name="city"
                            value="{{ old('city', $university->city) }}"
                            placeholder="Masukkan kota universitas" required />

                        <x-ui.input label="Provinsi" name="province"
                            value="{{ old('province', $university->province) }}"
                            placeholder="Masukkan provinsi universitas"
                            required />

                        <x-ui.input label="Website" name="website"
                            type="url"
                            value="{{ old('website', $university->website) }}"
                            placeholder="https://contoh.com" />

                        <x-ui.input label="Rating (0-5)" name="rating"
                            type="number" step="0.01" min="0"
                            max="5"
                            value="{{ old('rating', $university->rating) }}"
                            placeholder="Masukkan rating" required />

                        <input type="hidden" name="is_active" value="0">
                        <x-ui.checkbox label="Aktif" name="is_active"
                            :checked="old(
                                'is_active',
                                $university->is_active,
                            ) == 1" labelPosition="side" />
                    </div>

                    <x-ui.file-input name="logo" label="Logo"
                        accept="image/*"
                        helpText="Upload a square image for best results. Max size: 2MB" />

                    @if ($university->logo)
                        <div class="mt-2">
                            <p class="text-sm text-gray-600 mb-1">Logo Saat Ini:
                            </p>
                            <img src="{{ $university->logo }}"
                                alt="{{ $university->name }}"
                                class="h-20 w-auto object-contain">
                        </div>
                    @endif

                    <x-ui.textarea label="Deskripsi" name="description"
                        value="{{ old('description', $university->description) }}"
                        placeholder="Masukkan deskripsi singkat universitas (opsional)" />

                    <div class="mt-4">
                        <label
                            class="block text-sm font-medium text-gray-700 mb-1">
                            Jurusan Kuliah yang Tersedia
                        </label>

                        <div
                            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2 mt-1">
                            @forelse ($collegeMajors as $major)
                                <x-ui.checkbox name="college_majors[]"
                                    value="{{ $major->id }}"
                                    :checked="in_array(
                                        $major->id,
                                        old(
                                            'college_majors',
                                            $universityMajorIds,
                                        ),
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
                        <x-ui.button type="submit">Simpan
                            Perubahan</x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
