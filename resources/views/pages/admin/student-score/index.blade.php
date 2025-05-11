<x-admin-layout title="Nilai Siswa">
    <div class="container px-4 py-6">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold">Daftar Nilai Siswa</h1>
            <div class="flex space-x-2">
                <form action="{{ route('admin.student-scores.index') }}"
                    method="GET" class="flex space-x-2">
                    <x-ui.searchbar name="search"
                        placeholder="Cari siswa atau kriteria..."
                        value="{{ request('search') }}" />


                    <x-ui.button type="submit">
                        Cari
                    </x-ui.button>
                </form>
                <x-ui.link-button
                    href="{{ route('admin.student-scores.create') }}">
                    Tambah
                </x-ui.link-button>
            </div>
        </div>

        <div class="bg-white rounded shadow overflow-x-auto">
            <table class="min-w-full divide-y divide-teto-cream">
                <thead class="bg-teto-cream">
                    <tr>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Nama Siswa
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            NIS
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Sekolah Asal
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
                            Nilai
                        </th>
                        <th
                            class="px-6 py-3 text-left text-xs font-medium text-teto-dark-text uppercase tracking-wider">
                            Tgl. Input
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-teto-cream">
                    @forelse ($studentScores as $studentScore)
                        <tr onclick="window.location='{{ route('admin.student-scores.show', $studentScore) }}'"
                            class="hover:bg-teto-cream-hover cursor-pointer transition-colors duration-150">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $studentScore->student->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-teto-dark-text">
                                    {{ $studentScore->student->NIS ?? 'Tidak ada' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-teto-dark-text">
                                    {{ $studentScore->student->school_origin ?? 'Tidak ada' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $studentScore->criteria->name }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full text-white
                                    {{ !$studentScore->criteria->type === 'benefit' ? 'bg-teto-light' : 'bg-teto-soft-teal' }}">
                                    {{ ucfirst($studentScore->criteria->type) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $studentScore->score }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">
                                    {{ $studentScore->input_date->format('d/m/Y') ?? '-' }}
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7"
                                class="px-6 py-4 text-center text-teto-dark-text">
                                Data nilai siswa tidak ditemukan
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-4">
            {{ $studentScores->links() }}
        </div>
    </div>
</x-admin-layout>
