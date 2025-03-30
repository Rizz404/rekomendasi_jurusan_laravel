<x-user-layout title="Kriteria Kuliah">
    <div class="container px-4 py-6">
        @if (session('success'))
            <x-alert>{{ session('success') }}</x-alert>
        @endif

        <div class="flex items-center justify-between ">
            <h2 class="text-2xl font-bold text-slate-800">
                List kriteria
            </h2>
            <x-link-button href="{{ route('criterias.create') }}">
                Tambah
            </x-link-button>
        </div>
        <div
            class="grid grid-cols-1 gap-6 mt-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            @foreach ($criterias as $criteria)
                <x-criteria.criteria-card :criteria="$criteria" />
            @endforeach
        </div>
    </div>
</x-user-layout>
