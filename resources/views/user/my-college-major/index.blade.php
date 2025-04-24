<x-user-layout title="Jurusan Kuliah">
    <div class="container px-4 py-6">
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h2 class="text-2xl font-bold text-slate-800 mb-4 md:mb-0">
                Daftar Jurusan Kuliah
            </h2>
            <div class="flex gap-2">
                <form class="flex w-full md:w-64">
                    <input type="text" name="search"
                        placeholder="Cari jurusan..."
                        class="w-full rounded-l-lg border-slate-300 focus:border-slate-500 focus:ring focus:ring-slate-200 focus:ring-opacity-50"
                        value="{{ request('search') }}">
                    <button type="submit"
                        class="bg-slate-700 hover:bg-slate-800 text-white px-4 rounded-r-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                            fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($collegeMajors as $collegeMajor)
                <div
                    class="bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div
                        class="flex items-center justify-between p-4 border-b border-slate-100">
                        <h3 class="font-semibold text-slate-800">
                            {{ $collegeMajor->major_name }}</h3>
                        <span
                            class="px-3 py-1 rounded-full text-sm font-medium bg-slate-100 text-slate-800">
                            {{ $collegeMajor->field_of_study }}
                        </span>
                    </div>
                    <div class="p-4">
                        <div class="flex justify-between items-center mb-2">
                            <span
                                class="text-slate-500 text-sm">Fakultas:</span>
                            <span
                                class="text-slate-700">{{ $collegeMajor->faculty ?? 'Tidak tersedia' }}</span>
                        </div>

                        <div class="mt-3 pt-3 border-t border-slate-100">
                            <p class="text-slate-600 text-sm line-clamp-3">
                                {{ $collegeMajor->description ?? 'Tidak ada deskripsi tersedia.' }}
                            </p>
                        </div>

                        <div
                            class="mt-4 pt-3 border-t border-slate-100 flex justify-end">
                            <a href="{{ route('my-college-majors.show', $collegeMajor) }}"
                                class="text-sm text-slate-700 hover:text-slate-900 font-medium flex items-center">
                                Lihat Detail
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 ml-1" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div
                    class="col-span-full bg-slate-100 border border-slate-200 rounded-lg p-8 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-16 w-16 mx-auto text-slate-400" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-slate-700">Belum
                        ada data jurusan</h3>
                    <p class="mt-2 text-slate-500">Mohon maaf, data jurusan
                        kuliah belum tersedia.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $collegeMajors->links() }}
        </div>
    </div>
</x-user-layout>
