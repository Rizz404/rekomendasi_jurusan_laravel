<x-user-layout title="Detail Jurusan">
    <div class="container px-4 py-6">
        <div class="mb-6">
            <a href="{{ route('my-college-majors.index') }}"
                class="text-slate-600 hover:text-slate-800 flex items-center font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                        clip-rule="evenodd" />
                </svg>
                Kembali ke Daftar Jurusan
            </a>
        </div>

        <div
            class="bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden">
            <div class="p-6">
                <div
                    class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-800">
                            {{ $collegeMajor->major_name }}</h1>
                        <p class="text-slate-600 mt-1">Fakultas:
                            {{ $collegeMajor->faculty ?? 'Tidak tersedia' }}</p>
                    </div>
                    <span
                        class="mt-2 lg:mt-0 px-4 py-2 rounded-full text-sm font-medium bg-slate-100 text-slate-800">
                        {{ $collegeMajor->field_of_study ?? 'Bidang studi tidak tersedia' }}
                    </span>
                </div>

                <div class="mt-6 border-t border-slate-100 pt-6">
                    <h2 class="text-lg font-semibold text-slate-800 mb-3">
                        Deskripsi Jurusan</h2>
                    <p class="text-slate-600">
                        {{ $collegeMajor->description ?? 'Tidak ada deskripsi tersedia.' }}
                    </p>
                </div>

                <div class="mt-6 border-t border-slate-100 pt-6">
                    <h2 class="text-lg font-semibold text-slate-800 mb-3">
                        Prospek Karir</h2>
                    <p class="text-slate-600">
                        {{ $collegeMajor->career_prospects ?? 'Informasi prospek karir belum tersedia.' }}
                    </p>
                </div>

                <div class="mt-6 border-t border-slate-100 pt-6">
                    <h2 class="text-lg font-semibold text-slate-800 mb-4">
                        Universitas yang Menawarkan</h2>

                    @if ($collegeMajor->universities->count() > 0)
                        <div
                            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach ($collegeMajor->universities as $university)
                                <div
                                    class="border border-slate-200 rounded-lg p-4 hover:bg-slate-50 transition-colors duration-200">
                                    <div class="flex items-center">
                                        @if ($university->logo)
                                            <img src="{{ $university->logo }}"
                                                alt="{{ $university->name }}"
                                                class="w-12 h-12 object-contain mr-3">
                                        @else
                                            <div
                                                class="w-12 h-12 bg-slate-200 rounded-full flex items-center justify-center mr-3">
                                                <span
                                                    class="text-slate-500 font-semibold">{{ substr($university->name, 0, 1) }}</span>
                                            </div>
                                        @endif
                                        <div>
                                            <h3
                                                class="font-medium text-slate-800">
                                                {{ $university->name }}</h3>
                                            <p class="text-sm text-slate-600">
                                                {{ $university->city }},
                                                {{ $university->province }}</p>
                                        </div>
                                    </div>
                                    <div
                                        class="mt-3 flex justify-between items-center">
                                        <span
                                            class="inline-flex items-center px-2 py-1 rounded text-xs font-medium {{ $university->status === 'negeri' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                            {{ ucfirst($university->status) }}
                                        </span>
                                        <div class="flex items-center">
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
                                    <div class="mt-3 text-right">
                                        <a href="{{ route('my-universities.show', $university) }}"
                                            class="text-sm text-slate-700 hover:text-slate-900 font-medium flex items-center justify-end">
                                            Detail Universitas
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4 ml-1"
                                                viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-slate-50 rounded-lg p-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-12 w-12 mx-auto text-slate-400"
                                fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2"
                                    d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                            </svg>
                            <h3 class="mt-3 text-lg font-medium text-slate-700">
                                Belum ada universitas</h3>
                            <p class="mt-2 text-slate-500">Belum ada universitas
                                yang menawarkan jurusan ini.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
