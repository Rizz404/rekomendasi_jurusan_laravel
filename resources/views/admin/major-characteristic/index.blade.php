<x-user-layout title="Nilai kamu">
    <div class="container px-4 py-6">

        <div class="flex items-center justify-between ">
            <h2 class="text-2xl font-bold text-slate-800">
                List nilai kamu
            </h2>
            <div class="flex gap-2">
                <x-link-button
                    href="{{ route('major-characteristics.create') }}">
                    Tambah
                </x-link-button>
                <x-link-button
                    href="{{ route('major-characteristics.create-many') }}">
                    Tambah banyak
                </x-link-button>
            </div>
        </div>
        <div class="grid grid-cols-1 gap-6 mt-4">
            @foreach ($studentScores as $studentScore)
                <div class=" bg-slate-300">
                    <h2 class="">
                        {{ $studentScore->score }}
                    </h2>
                </div>
            @endforeach
        </div>
    </div>
</x-user-layout>
