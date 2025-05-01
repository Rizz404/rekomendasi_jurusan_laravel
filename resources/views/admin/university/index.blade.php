<x-admin-layout title="Universitas">
    <div class="container px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Daftar Universitas</h1>
            <div class="flex space-x-2">
                <form action="{{ route('admin.universities.index') }}"
                    method="GET" class="flex space-x-2">
                    <x-input type="text" name="search"
                        placeholder="Cari universitas..."
                        value="{{ request('search') }}" />

                    <x-button type="submit">
                        Cari
                    </x-button>
                </form>
                <x-link-button href="{{ route('admin.universities.create') }}">
                    Tambah Baru
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
                                            class="h-10 w-10 rounded-full bg-gray-200 flex items-center justify-center">
                                            <span
                                                class="text-teto-dark-text text-xs">No
                                                Logo</span>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $university->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $university->status === 'negeri' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                    {{ ucfirst($university->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $university->city }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $university->province }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div
                                        class="text-sm font-medium text-gray-900 mr-2">
                                        {{ $university->rating }}
                                    </div>
                                    <div class="flex text-yellow-400">
                                        @for ($i = 1; $i <= 5; $i++)
                                            @if ($i <= floor($university->rating))
                                                <svg class="h-4 w-4 fill-current"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                    </path>
                                                </svg>
                                            @elseif($i - 0.5 <= $university->rating)
                                                <svg class="h-4 w-4 fill-current"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                    </path>
                                                    <path fill="#e5e7eb"
                                                        d="M12 17.27V5 17.27z">
                                                    </path>
                                                </svg>
                                            @else
                                                <svg class="h-4 w-4 fill-current text-gray-300"
                                                    viewBox="0 0 24 24">
                                                    <path
                                                        d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2 9.19 8.63 2 9.24l5.46 4.73L5.82 21z">
                                                    </path>
                                                </svg>
                                            @endif
                                        @endfor
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $university->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $university->is_active ? 'Aktif' : 'Tidak Aktif' }}
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
