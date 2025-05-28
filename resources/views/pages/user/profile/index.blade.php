<x-user-layout title="Profile">
    <div class="container max-w-2xl p-4 py-4 mx-auto md:px-0">
        <form action="{{ route('profile.upsert') }}" method="POST"
            enctype="multipart/form-data" class="flex flex-col gap-4">
            @csrf
            @method('PATCH')

            <x-ui.input label="Username" name="username"
                value="{{ old('username', $user->username) }}"
                placeholder="Input username" required />

            <x-ui.input label="Email" name="email"
                value="{{ old('email', $user->email) }}"
                placeholder="Input email" required />

            <x-ui.file-input name="profile_picture" label="Profile Image"
                accept="image/*"
                helpText="Upload a square image for best results. Max size: 2MB" />


            <x-ui.input label="Nama Lengkap" name="name"
                value="{{ old('name', $user->student?->name) }}"
                placeholder="Input name" required />

            <x-ui.input label="No Telepon" name="phone"
                value="{{ old('phone', $user->phone) }}"
                placeholder="Input phone" required />

            <x-ui.input label="NIS" name="NIS"
                value="{{ old('NIS', $user->student?->NIS) }}"
                placeholder="Input NIS" required />

            <x-ui.dropdown label="Gender" name="gender" required>
                <option value="">Pilih Gender</option>
                <option value="man"
                    {{ old('gender', $user->student?->gender) === 'man' ? 'selected' : '' }}>
                    Laki-laki
                </option>
                <option value="woman"
                    {{ old('gender', $user->student?->gender) === 'woman' ? 'selected' : '' }}>
                    Perempuan
                </option>
            </x-ui.dropdown>

            <x-ui.input label="Asal sekolah" name="school_origin"
                value="{{ old('school_origin', $user->student?->school_origin) }}"
                placeholder="Input asal sekolah" required />

            <x-ui.dropdown label="Tipe sekolah" name="school_type" required>
                <option value="">Pilih tipe sekolah</option>
                <option value="high_school"
                    {{ old('school_type', $user->student?->school_type) === 'high_school' ? 'selected' : '' }}>
                    High School
                </option>
                <option value="vocational_school"
                    {{ old('school_type', $user->student?->school_type) === 'vocational_school' ? 'selected' : '' }}>
                    Vocational School
                </option>
            </x-ui.dropdown>

            <x-ui.input label="Jurusan Sekolah" name="school_major"
                value="{{ old('school_major', $user->student?->school_major) }}"
                placeholder="Input jurusan sekolah" required />

            <x-ui.input label="Tahun Lulus" name="graduation_year"
                type="number"
                value="{{ old('graduation_year', $user->student?->graduation_year) }}"
                placeholder="Input tahun lulus" required />


            <x-ui.button type="submit">Update profile</x-ui.button>
        </form>

        <form action="{{ route('logout') }}" method="post"
            class="flex flex-col mt-4">
            @csrf
            @method('POST')
            <x-ui.button type="submit">Logout</x-ui.button>
        </form>
    </div>
</x-user-layout>
