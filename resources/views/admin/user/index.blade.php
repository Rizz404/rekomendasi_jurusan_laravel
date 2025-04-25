<x-admin-layout title="Users">
    <div class="container px-4 py-6">
        <div
            class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
            <h1 class="text-2xl font-semibold">Users List</h1>
            <div>
                <form action="{{ route('admin.users.index') }}" method="GET"
                    class="flex flex-col sm:flex-row gap-2">
                    <input type="text" name="search"
                        placeholder="Search users..."
                        value="{{ request('search') }}"
                        class="px-4 py-2 border rounded-lg w-full sm:w-auto">

                    <select name="role"
                        class="px-4 py-2 border rounded-lg w-full sm:w-auto">
                        <option value="">All Roles</option>
                        <option value="admin"
                            {{ request('role') == 'admin' ? 'selected' : '' }}>
                            Admin</option>
                        <option value="user"
                            {{ request('role') == 'user' ? 'selected' : '' }}>
                            User</option>
                    </select>

                    <x-button type="submit">
                        Search
                    </x-button>
                    <x-link-button href="{{ route('admin.users.create') }}">
                        Create
                    </x-link-button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Username
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Role
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Student Info
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            School Type
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($users as $user)
                        <tr onclick="window.location='{{ route('admin.users.show', $user) }}'"
                            class="hover:bg-gray-50 cursor-pointer transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $user->username }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $user->email }}</div>
                                @if ($user->email_verified_at)
                                    <div class="text-xs text-green-600">Verified
                                    </div>
                                @else
                                    <div class="text-xs text-red-600">Not
                                        Verified</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $user->role === 'admin' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($user->student)
                                    <div
                                        class="text-sm font-medium text-gray-900">
                                        {{ $user->student->name }}</div>
                                    <div class="text-xs text-gray-500">NIS:
                                        {{ $user->student->NIS ?? 'Not set' }}
                                    </div>
                                @else
                                    <span class="text-xs text-gray-500">No
                                        student profile</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($user->student && $user->student->school_type)
                                    <span class="text-sm text-gray-900">
                                        {{ $user->student->formatted_school_type }}
                                        @if ($user->student->school_major)
                                            -
                                            {{ $user->student->school_major }}
                                        @endif
                                    </span>
                                @else
                                    <span class="text-xs text-gray-500">Not
                                        specified</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="px-6 py-4 text-center text-gray-500">
                                No users found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $users->links() }}
        </div>
    </div>
</x-admin-layout>
