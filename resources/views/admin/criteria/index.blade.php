<x-admin-layout title="Criterias"> {{-- Judul Layout diperbaiki --}}
    <div class="container px-4 py-6">
        <div
            class="flex flex-col md:flex-row md:justify-between md:items-center mb-6 gap-4">
            <h1 class="text-2xl font-semibold">Criteria List</h1>
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
                                {{ ucfirst($type) }} {{-- Tampilkan Type dengan huruf kapital di awal --}}
                            </option>
                        @endforeach
                    </x-dropdown>

                    <x-dropdown name="school_type">
                        <option value="">All school type</option>
                        @foreach ($schoolTypes as $schoolType)
                            <option value="{{ $schoolType }}"
                                {{ request('school_type') == $schoolType ? 'selected' : '' }}>
                                {{ ucfirst($schoolType) }} {{-- Tampilkan School Type dengan huruf kapital di awal --}}
                            </option>
                        @endforeach
                    </x-dropdown>

                    {{-- Menambahkan style warna Teto ke tombol Search --}}
                    <x-button type="submit"
                        class="bg-teto-primary hover:bg-teto-primary-hover text-white font-semibold rounded-md shadow-md transition ease-in-out duration-150">
                        Search
                    </x-button>
                    {{-- x-link-button diasumsikan sudah mengikuti tema dari konfigurasi Tailwind --}}
                    <x-link-button href="{{ route('admin.criterias.create') }}">
                        Create
                    </x-link-button>
                </form>
            </div>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">
            {{-- Table divider dan header background sudah menggunakan warna Teto --}}
            <table class="min-w-full divide-y divide-teto-cream">
                <thead class="bg-teto-cream">
                    <tr>
                        {{-- Header text sudah menggunakan warna Teto --}}
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
                {{-- Table body divider sudah menggunakan warna Teto --}}
                <tbody class="bg-white divide-y divide-teto-cream">
                    @forelse ($criterias as $criteria)
                        {{-- Hover effect sudah menggunakan warna Teto --}}
                        <tr onclick="window.location='{{ route('admin.criterias.show', $criteria) }}'"
                            class="hover:bg-teto-cream-hover cursor-pointer transition-colors duration-150">
                            {{-- Text body akan mengikuti warna default dari @layer base (teto-dark-text) --}}
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
                                    {{-- Teto colors for Type badge --}}
                                    {{ ucfirst($criteria->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-white
                                    {{ $criteria->school_type === 'All' ? 'bg-teto-soft-teal' : 'bg-teto-accent' }}">
                                    {{-- Teto colors for School Type badge --}}
                                    {{-- Menyesuaikan teks badge agar konsisten dengan dropdown --}}
                                    {{ $criteria->school_type === 'All' ? 'All' : ucfirst($criteria->school_type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-white
                                    {{ !$criteria->is_active ? 'bg-teto-light' : 'bg-teto-soft-teal' }}">
                                    {{-- Teto colors for Status badge & corrected condition --}}
                                    {{ $criteria->is_active ? 'Active' : 'Non active' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5"
                                class="px-6 py-4 text-center text-teto-dark-text-muted">
                                {{-- Empty state text menggunakan muted color --}}
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
