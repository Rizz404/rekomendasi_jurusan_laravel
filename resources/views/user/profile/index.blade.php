<x-user-layout title="Profile">
    <div class="container max-w-2xl py-4 mx-auto">
        <form action="{{ route('profile.upsert') }}" method="POST"
            class="flex flex-col gap-4">
            @csrf
            @method('PATCH')

            <x-input label="Username" name="username"
                value="{{ old('username', $user->username) }}"
                placeholder="Input username" required />

            <x-input label="Email" name="email"
                value="{{ old('email', $user->email) }}"
                placeholder="Input email" required />

            <x-input label="Fullname" name="name"
                value="{{ old('name', $user->student?->name) }}"
                placeholder="Input name" required />

            <x-input label="Phone" name="phone"
                value="{{ old('phone', $user->phone) }}"
                placeholder="Input phone" required />

            <x-input label="NIS" name="NIS"
                value="{{ old('NIS', $user->student?->NIS) }}"
                placeholder="Input NIS" required />

            <x-dropdown label="Gender">
                <option value="">Pilih Gender</option>
                <option value="man"
                    {{ old('gender', $user->student?->gender) === 'man' ? 'selected' : '' }}>
                    Male
                </option>
                <option value="woman"
                    {{ old('gender', $user->student?->gender) === 'woman' ? 'selected' : '' }}>
                    Woman
                </option>
            </x-dropdown>

            <x-input label="Asal sekolah" name="school_origin"
                value="{{ old('school_origin', $user->student?->school_origin) }}"
                placeholder="Input school_origin" required />

            <x-dropdown>
                <option value="">Select School Type</option>
                <option value="high_school"
                    {{ old('school_type', $user->student?->school_type) === 'high_school' ? 'selected' : '' }}>
                    High School
                </option>
                <option value="vocational_school"
                    {{ old('school_type', $user->student?->school_type) === 'vocational_school' ? 'selected' : '' }}>
                    Vocational School
                </option>
            </x-dropdown>

            <x-input label="Jurusan Sekolah" name="school_major"
                value="{{ old('school_major', $user->student?->school_major) }}"
                placeholder="Input jurusan sekolah" required />

            <x-input label="Tahun Lulus" name="graduation_year" type="number"
                value="{{ old('graduation_year', $user->student?->graduation_year) }}"
                placeholder="Input tahun lulus" required />

            {{-- Todo: Nanti pas pertama kali update bakal redirect ke kalkulasi nilai --}}
            <x-button type="submit">Update profile</x-button>
        </form>
    </div>
</x-user-layout>
