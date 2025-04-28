<x-user-layout title="Nilai kamu">
    <div class="container px-4 py-6">
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h2 class="text-2xl font-bold text-teto-dark-text mb-4 md:mb-0">
                Daftar Nilai Kamu
            </h2>
            <div class="flex gap-2">
                <x-link-button href="{{ route('my-grades.create') }}"
                    class="bg-teto-primary hover:bg-teto-dark text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah
                </x-link-button>
                <x-link-button href="{{ route('my-grades.create-many') }}"
                    class="bg-teto-primary hover:bg-teto-dark text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0V7H8a1 1 0 110-2h1V4a1 1 0 011-1zm-4 8a1 1 0 011-1h8a1 1 0 110 2H7a1 1 0 01-1-1zm0 4a1 1 0 011-1h8a1 1 0 110 2H7a1 1 0 01-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah Banyak
                </x-link-button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($studentScores as $studentScore)
                <x-my-grade.grade-card :$studentScore />
            @empty
                <x-empty-grid title="Belum ada nilai"
                    description="Input nilai terlebih dahulu" />
            @endforelse


            @if (!$studentScores->isEmpty())
                <div class=" fixed bottom-0 right-0 m-6">
                    <x-link-button
                        href="{{ route('my-recommendations.index') }}"
                        class="bg-teto-primary hover:bg-teto-dark text-white px-6 py-3">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                                clip-rule="evenodd" />
                        </svg>
                        Lihat Rekomendasi
                    </x-link-button>
                </div>
            @endif
        </div>
    </div>
</x-user-layout>
