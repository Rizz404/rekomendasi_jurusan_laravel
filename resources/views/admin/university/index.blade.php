<x-admin-layout title="Universitas">
    <div class="container px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Daftar Universitas</h1>
            <div class="flex space-x-2">
                <form action="{{ route('admin.universities.index') }}"
                    method="GET" class="flex space-x-2">
                    <x-searchbar name="search" placeholder="Cari universitas..."
                        value="{{ request('search') }}" />

                    <x-button type="submit">
                        Cari
                    </x-button>
                </form>
                <x-link-button href="{{ route('admin.universities.create') }}">
                    Tambah
                </x-link-button>
            </div>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-teto-cream">
                <thead class="bg-teto-cream">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Logo
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Nama Universitas
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Status
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Kota
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Provinsi
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Rating
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Status
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-teto-cream">
                    @forelse ($universities as $university)
                        <tr onclick="window.location='{{ route('admin.universities.show', $university) }}'"
                            class="hover:bg-teto-cream-hover cursor-pointer transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex-shrink-0 h-10 w-10">
                                    @if ($university->logo)
                                        <img class="h-10 w-10 rounded-full object-cover"
                                            src="{{ $university->logo }}"
                                            alt="{{ $university->name }}">
                                    @else
                                        <div
                                            class="h-10 w-10 rounded-full bg-teto-cream flex items-center justify-center">
                                            <span
                                                class="text-teto-dark-text text-xs">No
                                                Logo</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div
                                    class="text-sm font-medium text-teto-dark-text">
                                    {{ $university->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-white
                                {{ !$university->status === 'negeri' ? 'bg-teto-light' : 'bg-teto-soft-teal' }}">
                                    {{ ucfirst($university->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-teto-dark-text">
                                    {{ $university->city }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-teto-dark-text">
                                    {{ $university->province }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="text-sm font-medium text-teto-secondary">
                                        {{ $university->rating }}
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-white
                            {{ !$university->is_active ? 'bg-teto-light' : 'bg-teto-soft-teal' }}">

                                    {{ $university->is_active ? 'Active' : 'Non active' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"
                                class="px-6 py-4 text-center text-teto-dark-text">
                                Data universitas tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $universities->links() }}
        </div>
    </div>
</x-admin-layout>
