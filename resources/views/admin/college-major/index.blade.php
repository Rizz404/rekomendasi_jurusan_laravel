<x-user-layout title="Jurusan Kuliah">
    <div class="container px-4 py-6">
        <div class=" flex justify-between items-center">
            <h2 class=" text-2xl font-bold text-slate-800 ">
                List jurusan kuliah
            </h2>
            <x-link-button href="{{ route('college-majors.create') }}">
                Tambah
            </x-link-button>
        </div>
        <div
            class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mt-4">
            @foreach ($collegeMajors as $collegeMajor)
                {{-- <x-college-major.college-major-card
                    collegeMajor="{{ $collegeMajor }}" /> --}}
                {{-- ! harus kek gini :collegeMajor="$collegeMajor" soalnya yang diatas ini convert jadi string bukan object --}}
                <x-college-major.college-major-card :collegeMajor="$collegeMajor" />
            @endforeach
        </div>
    </div>
</x-user-layout>
