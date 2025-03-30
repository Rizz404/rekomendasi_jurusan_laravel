<x-user-layout title="Profile">
    <div class="container max-w-md py-4 mx-auto">
        <form action="{{ route('profile') }}" method="POST"
            class="flex flex-col gap-4">
            @csrf
            @method('PUT')

            <!-- User Fields -->
            <div>
                <label for="name"
                    class="block text-sm font-medium text-gray-700">Name</label>
                <input type="text" id="name" name="name"
                    value="{{ old('name', $user->name) }}"
                    class="block w-full px-4 py-2 mt-1 border-gray-300 rounded shadow-sm focus:border-gray-500 focus:ring-slate-500">
                @error('name')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email"
                    class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" id="email" name="email"
                    value="{{ old('email', $user->email) }}"
                    class="block w-full px-4 py-2 mt-1 border-gray-300 rounded shadow-sm focus:border-gray-500 focus:ring-slate-500">
                @error('email')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="phone"
                    class="block text-sm font-medium text-gray-700">Phone</label>
                <input type="text" id="phone" name="phone"
                    value="{{ old('phone', $user->phone) }}"
                    class="block w-full px-4 py-2 mt-1 border-gray-300 rounded shadow-sm focus:border-gray-500 focus:ring-slate-500">
                @error('phone')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <!-- Student Fields -->
            <div>
                <label for="NIS"
                    class="block text-sm font-medium text-gray-700">NIS</label>
                <input type="text" id="NIS" name="NIS"
                    value="{{ old('NIS', $user->student?->NIS) }}"
                    class="block w-full px-4 py-2 mt-1 border-gray-300 rounded shadow-sm focus:border-gray-500 focus:ring-slate-500">
                @error('NIS')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label
                    class="block text-sm font-medium text-gray-700">Gender</label>
                <div class="mt-1 space-y-2">
                    <label class="inline-flex items-center">
                        <input type="radio" name="gender" value="man"
                            {{ old('gender', $user->student?->gender) === 'man' ? 'checked' : '' }}
                            class="border-gray-300 text-slate-600 focus:ring-slate-500">
                        <span class="ml-2">Male</span>
                    </label>
                    <label class="inline-flex items-center ml-4">
                        <input type="radio" name="gender" value="woman"
                            {{ old('gender', $user->student?->gender) === 'woman' ? 'checked' : '' }}
                            class="border-gray-300 text-slate-600 focus:ring-slate-500">
                        <span class="ml-2">Female</span>
                    </label>
                </div>
                @error('gender')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="school_origin"
                    class="block text-sm font-medium text-gray-700">School
                    Origin</label>
                <input type="text" id="school_origin" name="school_origin"
                    value="{{ old('school_origin', $user->student?->school_origin) }}"
                    class="block w-full px-4 py-2 mt-1 border-gray-300 rounded shadow-sm focus:border-gray-500 focus:ring-slate-500">
                @error('school_origin')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="school_type"
                    class="block text-sm font-medium text-gray-700">School
                    Type</label>
                <select id="school_type" name="school_type"
                    class="block w-full px-4 py-2 mt-1 border-gray-300 rounded shadow-sm focus:border-gray-500 focus:ring-slate-500">
                    <option value="">Select School Type</option>
                    <option value="high_school"
                        {{ old('school_type', $user->student?->school_type) === 'high_school' ? 'selected' : '' }}>
                        High School
                    </option>
                    <option value="vocational_school"
                        {{ old('school_type', $user->student?->school_type) === 'vocational_school' ? 'selected' : '' }}>
                        Vocational School
                    </option>
                </select>
                @error('school_type')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="school_major"
                    class="block text-sm font-medium text-gray-700">School
                    Major</label>
                <input type="text" id="school_major" name="school_major"
                    value="{{ old('school_major', $user->student?->school_major) }}"
                    class="block w-full px-4 py-2 mt-1 border-gray-300 rounded shadow-sm focus:border-gray-500 focus:ring-slate-500">
                @error('school_major')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="graduation_year"
                    class="block text-sm font-medium text-gray-700">Graduation
                    Year</label>
                <input type="number" id="graduation_year"
                    name="graduation_year"
                    value="{{ old('graduation_year', $user->student?->graduation_year) }}"
                    class="block w-full px-4 py-2 mt-1 border-gray-300 rounded shadow-sm focus:border-gray-500 focus:ring-slate-500">
                @error('graduation_year')
                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="px-4 py-2 text-white bg-gray-800 rounded hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
                Update Profile
            </button>
        </form>
    </div>
</x-user-layout>
