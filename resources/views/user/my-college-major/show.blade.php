<x-user-layout title="Detail Jurusan - {{ $collegeMajor->major_name }}">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <!-- Breadcrumb -->
                    <nav class="flex mb-6" aria-label="Breadcrumb">
                        <ol
                            class="inline-flex items-center space-x-1 md:space-x-2">
                            <li>
                                <a href="{{ route('my-recommendations.index') }}"
                                    class="text-slate-600 hover:text-slate-800">
                                    Rekomendasi Jurusan
                                </a>
                            </li>
                            <li aria-current="page">
                                <div class="flex items-center">
                                    <svg class="w-6 h-6 text-gray-400"
                                        fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    <span
                                        class="ml-1 text-sm font-medium text-gray-500 md:ml-2">
                                        {{ $collegeMajor->major_name }}
                                    </span>
                                </div>
                            </li>
                        </ol>
                    </nav>

                    <!-- Detail Jurusan -->
                    <div class="mb-8 bg-gray-50 p-6 rounded-lg">
                        <h1 class="text-3xl font-bold text-gray-800 mb-4">
                            {{ $collegeMajor->major_name }}</h1>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Informasi Utama -->
                            <div class="space-y-4">
                                <div>
                                    <p class="text-sm text-gray-500">Fakultas
                                    </p>
                                    <p class="font-medium">
                                        {{ $collegeMajor->faculty ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Bidang
                                        Keilmuan</p>
                                    <p class="font-medium">
                                        {{ $collegeMajor->field_of_study ?? '-' }}
                                    </p>
                                </div>
                            </div>

                            <!-- Deskripsi & Prospek -->
                            <div class="space-y-4">
                                @if ($collegeMajor->description)
                                    <div>
                                        <p class="text-sm text-gray-500">
                                            Deskripsi Jurusan</p>
                                        <p class="text-gray-700 prose">
                                            {{ $collegeMajor->description }}</p>
                                    </div>
                                @endif

                                @if ($collegeMajor->career_prospects)
                                    <div>
                                        <p class="text-sm text-gray-500">Prospek
                                            Karir</p>
                                        <p class="text-gray-700 prose">
                                            {{ $collegeMajor->career_prospects }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Daftar Kampus -->
                    <div class="bg-white border rounded-lg">
                        <div class="p-6 border-b">
                            <h3 class="text-xl font-semibold text-gray-800">
                                Kampus yang Menyediakan Jurusan Ini
                            </h3>
                        </div>

                        @if ($universities->isNotEmpty())
                            <div class="divide-y divide-gray-200">
                                @foreach ($universities as $university)
                                    <div class="p-6 hover:bg-gray-50">
                                        <div
                                            class="flex flex-col md:flex-row gap-6">
                                            <!-- Logo Kampus -->
                                            <div class="flex-shrink-0">
                                                @if ($university->logo)
                                                    <img src="{{ asset($university->logo) }}"
                                                        alt="Logo {{ $university->name }}"
                                                        class="w-24 h-24 object-contain rounded-lg">
                                                @else
                                                    <div
                                                        class="w-24 h-24 bg-gray-100 rounded-lg flex items-center justify-center">
                                                        <span
                                                            class="text-gray-400 text-xs">No
                                                            Logo</span>
                                                    </div>
                                                @endif
                                            </div>

                                            <!-- Detail Kampus -->
                                            <div class="flex-grow">
                                                <div
                                                    class="flex items-center gap-2 mb-2">
                                                    <h4
                                                        class="text-lg font-semibold text-gray-800">
                                                        {{ $university->name }}
                                                    </h4>
                                                    <span
                                                        class="px-2 py-1 text-xs font-medium rounded-full 
                                                        {{ $university->status === 'negeri' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                                        {{ strtoupper($university->status) }}
                                                    </span>
                                                </div>

                                                <!-- Lokasi & Rating -->
                                                <div
                                                    class="flex flex-wrap gap-4 text-sm text-gray-600 mb-3">
                                                    <span
                                                        class="flex items-center">
                                                        <svg class="w-5 h-5 mr-1 text-gray-400"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                                            </path>
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z">
                                                            </path>
                                                        </svg>
                                                        {{ $university->city }},
                                                        {{ $university->province }}
                                                    </span>

                                                    @if ($university->rating > 0)
                                                        <span
                                                            class="flex items-center">
                                                            <svg class="w-5 h-5 mr-1 text-yellow-400"
                                                                fill="currentColor"
                                                                viewBox="0 0 20 20">
                                                                <path
                                                                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                                                                </path>
                                                            </svg>
                                                            {{ number_format($university->rating, 1) }}/5.0
                                                        </span>
                                                    @endif
                                                </div>

                                                <!-- Website -->
                                                @if ($university->website)
                                                    <a href="{{ $university->website }}"
                                                        target="_blank"
                                                        class="inline-flex items-center text-slate-600 hover:text-slate-800 text-sm">
                                                        <svg class="w-4 h-4 mr-1"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1">
                                                            </path>
                                                        </svg>
                                                        {{ parse_url($university->website, PHP_URL_HOST) }}
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="p-6">
                                {{ $universities->links() }}
                            </div>
                        @else
                            <div class="p-6 text-center text-gray-500">
                                Belum ada data kampus yang terkait dengan
                                jurusan ini.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
