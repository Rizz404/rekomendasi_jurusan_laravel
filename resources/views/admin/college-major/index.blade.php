<x-admin-layout title="Users">
    <div class="container px-4 py-6">
        <div
            class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
            <h1 class="text-2xl font-semibold">College Major List</h1>
            <div>
                <form action="{{ route('admin.college-majors.index') }}"
                    method="GET" class="flex flex-col sm:flex-row gap-2">

                    <x-input type="text" name="search"
                        placeholder="Search college-majors..."
                        value="{{ request('search') }}" />

                    <x-button type="submit">
                        Search
                    </x-button>
                    <x-link-button
                        href="{{ route('admin.college-majors.create') }}">
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
                            Major Name
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Faculty
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Field Of Study
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse ($collegeMajors as $collegeMajor)
                        <tr onclick="window.location='{{ route('admin.college-majors.show', $collegeMajor) }}'"
                            class="hover:bg-gray-50 cursor-pointer transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $collegeMajor->major_name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $collegeMajor->faculty }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $collegeMajor->field_of_study }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $collegeMajor->is_active === 'false' ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                    {{ $collegeMajor->is_active ? 'Active' : 'Non active' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="px-6 py-4 text-center text-gray-500">
                                No college major found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $collegeMajors->links() }}
        </div>
    </div>
</x-admin-layout>
