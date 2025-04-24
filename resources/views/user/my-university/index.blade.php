<x-user-layout title="Universitas">
    <div class="container px-4 py-6">
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h2 class="text-2xl font-bold text-slate-800 mb-4 md:mb-0">
                Daftar Universitas
            </h2>
            <div class="flex flex-col sm:flex-row gap-2">
                <form class="flex w-full">
                    <input type="text" name="search"
                        placeholder="Cari universitas..."
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
                    {{-- Todo: Nanti kasih filtering --}}
                </form>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @forelse ($universities as $university)
                <div
                    class="bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <div class="p-4">
                        <div class="flex items-start">
                            @if ($university->logo)
                                <img src="{{ $university->logo }}"
                                    alt="{{ $university->name }}"
                                    class="w-16 h-16 object-contain mr-3">
                            @else
                                <div
                                    class="w-16 h-16 bg-slate-200 rounded-full flex items-center justify-center mr-3">
                                    <span
                                        class="text-slate-500 font-semibold text-xl">{{ substr($university->name, 0, 1) }}</span>
                                </div>
                            @endif
                            <div>
                                <h3 class="font-semibold text-slate-800">
                                    {{ $university->name }}</h3>
                                <p class="text-slate-600 text-sm">
                                    {{ $university->city }},
                                    {{ $university->province }}</p>
                                <div class="flex items-center mt-1">
                                    <span
                                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $university->status === 'negeri' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                        {{ ucfirst($university->status) }}
                                    </span>
                                    <div class="flex items-center ml-2">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4 text-yellow-400"
                                            viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                        </svg>
                                        <span
                                            class="text-sm ml-1">{{ number_format($university->rating, 1) }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3 pt-3 border-t border-slate-100">
                            <p class="text-slate-600 text-sm line-clamp-3">
                                {{ $university->description ?? 'Tidak ada deskripsi tersedia.' }}
                            </p>
                        </div>

                        <div
                            class="mt-4 pt-3 border-t border-slate-100 flex justify-between items-center">
                            @if ($university->website)
                                <a href="{{ $university->website }}"
                                    target="_blank"
                                    class="text-sm text-slate-600 hover:text-slate-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Website
                                </a>
                            @else
                                <span class="text-sm text-slate-400">Tidak ada
                                    website</span>
                            @endif
                            <a href="{{ route('my-universities.show', $university) }}"
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
                            d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                    </svg>
                    <h3 class="mt-4 text-lg font-medium text-slate-700">Belum
                        ada data universitas</h3>
                    <p class="mt-2 text-slate-500">Mohon maaf, data universitas
                        belum tersedia.</p>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $universities->links() }}
        </div>
    </div>
</x-user-layout>
