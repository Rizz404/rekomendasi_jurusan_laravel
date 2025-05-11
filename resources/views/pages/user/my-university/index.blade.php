<x-user-layout title="Universitas">
    <div class="container px-4 py-6">
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h2 class="text-2xl font-bold text-teto-dark-text mb-4 md:mb-0">
                Daftar Universitas
            </h2>
            <div class="flex flex-col sm:flex-row gap-2">
                <form class="flex w-full md:w-64">
                    <x-ui.searchbar placeholder="Cari universitas..." />
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($universities as $university)
                <x-cards.university-card :$university />
            @empty
                <x-ui.empty-grid title="Belum ada universitas"
                    description="Input universitas terlebih dahulu" />
            @endforelse
        </div>

        <div class="mt-6">
            {{ $universities->links() }}
        </div>
    </div>
</x-user-layout>
