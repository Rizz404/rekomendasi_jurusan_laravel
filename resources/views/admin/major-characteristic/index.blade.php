<x-admin-layout title="Karakteristik Jurusan">
    <div class="container px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Daftar Karakteristik Jurusan</h1>
            <div class="flex space-x-2">
                <form action="{{ route('admin.major-characteristics.index') }}"
                    method="GET" class="flex space-x-2">
                    <x-input type="text" name="search"
                        placeholder="Cari jurusan atau kriteria..."
                        value="{{ request('search') }}" />

                    <x-button type="submit">
                        Cari
                    </x-button>
                </form>
                <x-link-button
                    href="{{ route('admin.major-characteristics.create') }}">
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
                            Jurusan
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Fakultas
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Kriteria
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Tipe Kriteria
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Bobot Kompatibilitas
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Nilai Minimum
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-teto-cream">
                    @forelse ($majorCharacteristics as $majorCharacteristic)
                        <tr onclick="window.location='{{ route('admin.major-characteristics.show', $majorCharacteristic) }}'"
                            class="hover:bg-teto-cream-hover cursor-pointer transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $majorCharacteristic->collegeMajor->major_name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-teto-dark-text">
                                    {{ $majorCharacteristic->collegeMajor->faculty ?? 'Tidak ada' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $majorCharacteristic->criteria->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $majorCharacteristic->criteria->type === 'benefit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($majorCharacteristic->criteria->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $majorCharacteristic->compatibility_weight }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $majorCharacteristic->minimum_score ?? '-' }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"
                                class="px-6 py-4 text-center text-teto-dark-text">
                                Data karakteristik jurusan tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $majorCharacteristics->links() }}
        </div>
    </div>
</x-admin-layout>
