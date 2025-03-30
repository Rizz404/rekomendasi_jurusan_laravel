<x-user-layout title="Home">
    <div class="text-black bg-slate-200">
        {{-- Todo: Nanti jadiin komponen --}}
        @if (session('success'))
            <x-alert type="success">
                {{ session('success') }}
            </x-alert>
        @endif

        <div class="container px-4 py-2 mx-auto">
            <h1 class="font-bold text-red-500 text-7xl">Ini adalah home page
            </h1>



            <x-button>hehe</x-button>

        </div>
    </div>
</x-user-layout>
