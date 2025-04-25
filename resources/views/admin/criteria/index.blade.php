<x-admin-layout title="Users">
    <div class="container px-4 py-6">
        <div
            class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
            <h1 class="text-2xl font-semibold">Users List</h1>
            <div>
                <form action="{{ route('admin.criterias.index') }}" method="GET"
                    class="flex flex-col sm:flex-row gap-2">

                    <x-input type="text" name="search"
                        placeholder="Search criterias..."
                        value="{{ request('search') }}" />

                    <x-dropdown name="type">
                        <option value="">All type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}"
                                {{ request('type') == $type ? 'selected' : '' }}>
                                {{ $type }}
                            </option>
                        @endforeach
                    </x-dropdown>

                    <x-dropdown name="school_type">
                        <option value="">All school type</option>
                        @foreach ($schoolTypes as $schoolType)
                            <option value="{{ $schoolType }}"
                                {{ request('school_type') == $schoolType ? 'selected' : '' }}>
                                {{ $schoolType }}
                            </option>
                        @endforeach
                    </x-dropdown>

                    <x-button type="submit">
                        Search
                    </x-button>
                    <x-link-button href="{{ route('admin.criterias.create') }}">
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
                            Name
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Weight
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Type
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            School Type
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($criterias as $criteria)
                        <tr onclick="window.location='{{ route('admin.criterias.show', $criteria) }}'"
                            class="hover:bg-gray-50 cursor-pointer transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $criteria->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $criteria->weight }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $criteria->type === 'cost' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ ucfirst($criteria->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $criteria->school_type === 'All' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($criteria->school_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $criteria->is_active === 'false' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $criteria->is_active ? 'Active' : 'Non active' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="px-6 py-4 text-center text-gray-500">
                                No criterias found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $criterias->links() }}
        </div>
    </div>
</x-admin-layout>
