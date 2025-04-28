<x-user-layout title="Jurusan Kuliah">
    <div class="container px-4 py-6">
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h2
                class="text-2xl font-bold text-teto-dark-text font-sans mb-4 md:mb-0">
                Daftar Jurusan Kuliah
            </h2>
            <div class="flex gap-2">
                <form class="flex w-full md:w-64">
                    <x-searchbar placeholder="Cari jurusan..." />
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($collegeMajors as $collegeMajor)
                <x-my-college-major.college-major-card :$collegeMajor />
            @empty
                <div
                    class="col-span-full bg-white rounded-lg p-8 text-center shadow">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-16 w-16 mx-auto text-teto-primary opacity-70"
                        fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3
                        class="mt-4 text-lg font-medium text-teto-dark-text font-sans">
                        Belum
                        ada data jurusan</h3>
                    <p class="mt-2 text-teto-dark-text opacity-80 font-body">
                        Mohon maaf, data jurusan
                        kuliah belum tersedia.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $collegeMajors->links() }}
        </div>
    </div>
</x-user-layout>
