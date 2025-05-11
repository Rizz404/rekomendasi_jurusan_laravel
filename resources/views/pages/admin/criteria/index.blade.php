<x-admin-layout title="Criterias">
    <div class="container px-4 py-6">
        <div
            class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
            <h1 class="text-2xl font-semibold">Criteria List</h1>
            <div>
                <form action="{{ route('admin.criterias.index') }}" method="GET"
                    class="flex flex-col sm:flex-row gap-2">

                    <x-ui.searchbar name="search" placeholder="Cari criterias..."
                        value="{{ request('search') }}" />


                    <x-ui.dropdown name="type">
                        <option value="">All type</option>
                        @foreach ($types as $type)
                            <option value="{{ $type }}"
                                {{ request('type') == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </x-ui.dropdown>

                    <x-ui.dropdown name="school_type">
                        <option value="">All school type</option>
                        @foreach ($schoolTypes as $schoolType)
                            <option value="{{ $schoolType }}"
                                {{ request('school_type') == $schoolType ? 'selected' : '' }}>
                                {{ ucfirst($schoolType) }}
                            </option>
                        @endforeach
                    </x-ui.dropdown>


                    <x-ui.button type="submit"
                        class="bg-teto-primary hover:bg-teto-primary-hover text-white font-semibold rounded-md shadow-md transition ease-in-out duration-150">
                        Cari
                    </x-ui.button>

                    <x-ui.link-button
                        href="{{ route('admin.criterias.create') }}">
                        Tambah
                    </x-ui.link-button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">

            <table class="min-w-full divide-y divide-teto-cream">
                <thead class="bg-teto-cream">
                    <tr>

                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Name
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Weight
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Type
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            School Type
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Status
                        </th>
                    </tr>
                </thead>

                <tbody class="bg-white divide-y divide-teto-cream">
                    @forelse ($criterias as $criteria)
                        <tr onclick="window.location='{{ route('admin.criterias.show', $criteria) }}'"
                            class="hover:bg-teto-cream-hover cursor-pointer transition-colors duration-150">

                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $criteria->name }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                {{ $criteria->weight }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-white
                                    {{ $criteria->type === 'cost' ? 'bg-teto-light' : 'bg-teto-soft-teal' }}">

                                    {{ ucfirst($criteria->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-white
                                    {{ $criteria->school_type === 'All' ? 'bg-teto-soft-teal' : 'bg-teto-accent' }}">


                                    {{ $criteria->school_type === 'All' ? 'All' : ucfirst($criteria->school_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-white
                                    {{ !$criteria->is_active ? 'bg-teto-light' : 'bg-teto-soft-teal' }}">

                                    {{ $criteria->is_active ? 'Active' : 'Non active' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="px-6 py-4 text-center text-teto-dark-text-muted">

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
