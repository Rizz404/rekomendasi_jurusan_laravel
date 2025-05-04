<x-admin-layout title="Users">
    <div class="container px-4 py-6">
        <div
            class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
            <h1 class="text-2xl font-semibold">Users List</h1>
            <div>
                <form action="{{ route('admin.users.index') }}" method="GET"
                    class="flex flex-col sm:flex-row gap-2">

                    <x-searchbar name="search" placeholder="Search users..."
                        value="{{ request('search') }}" />

                    <x-dropdown name="role">
                        <option value="">All Roles</option>
                        <option value="admin"
                            {{ request('role') == 'admin' ? 'selected' : '' }}>
                            Admin</option>
                        <option value="user"
                            {{ request('role') == 'user' ? 'selected' : '' }}>
                            User</option>
                    </x-dropdown>

                    <x-button type="submit">
                        Filter
                    </x-button>

                    <x-link-button href="{{ route('admin.users.create') }}">
                        Create
                    </x-link-button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-teto-cream">
                <thead class="bg-teto-cream">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text-muted uppercase tracking-wider">

                            Username
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text-muted uppercase tracking-wider">

                            Email
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text-muted uppercase tracking-wider">

                            Role
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text-muted uppercase tracking-wider">

                            Student Info
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text-muted uppercase tracking-wider">

                            School Type
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-teto-cream">
                    @forelse ($users as $user)
                        <tr onclick="window.location='{{ route('admin.users.show', $user) }}'"
                            class="hover:bg-teto-cream-hover cursor-pointer transition-colors duration-150">

                            <td
                                class="px-6 py-4 whitespace-nowrap text-teto-dark-text flex gap-2">

                                @if ($user->profile_picture)
                                    <img src="{{ $user->profile_picture }}"
                                        class=" rounded-full object-cover size-6"
                                        alt="{{ $user->username }}">
                                @endif
                                {{ $user->username }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-teto-dark-text">

                                    {{ $user->email }}</div>
                                @if ($user->email_verified_at)
                                    <div class="text-xs text-teto-soft-teal">
                                        Verified
                                    </div>
                                @else
                                    <div class="text-xs text-teto-primary">Not

                                        Verified</div>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-white
                                    {{ $user->role === 'admin' ? 'bg-teto-light' : 'bg-teto-soft-blue' }}">

                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($user->student)
                                    <div
                                        class="text-sm font-medium text-teto-dark-text">

                                        {{ $user->student->name }}</div>
                                    <div
                                        class="text-xs text-teto-dark-text-muted">
                                        NIS:
                                        {{ $user->student->NIS ?? 'Not set' }}
                                    </div>
                                @else
                                    <span
                                        class="text-xs text-teto-dark-text-muted">No

                                        student profile</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($user->student && $user->student->school_type)
                                    <span class="text-sm text-teto-dark-text">

                                        {{ $user->student->formatted_school_type }}
                                        @if ($user->student->school_major)
                                            -
                                            {{ $user->student->school_major }}
                                        @endif
                                    </span>
                                @else
                                    <span
                                        class="text-xs text-teto-dark-text-muted">Not

                                        specified</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="px-6 py-4 text-center text-teto-dark-text-muted">

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
