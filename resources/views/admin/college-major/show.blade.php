<x-user-layout title="{{ $collegeMajor->major_name }}">
    <div class="container px-4 py-8 max-w-5xl mx-auto">
        <div
            class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 mb-8">
            <div
                class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-slate-800">
                        {{ $collegeMajor->major_name }}</h1>
                    <div class="flex flex-wrap items-center gap-3 mt-2">
                        <span
                            class="inline-block px-3 py-1 text-sm rounded-full {{ $collegeMajor->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                            {{ $collegeMajor->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                        @if ($collegeMajor->faculty)
                            <span
                                class="inline-block px-3 py-1 text-sm rounded-full bg-blue-50 text-blue-700">
                                {{ $collegeMajor->faculty }}
                            </span>
                        @endif
                        @if ($collegeMajor->field_of_study)
                            <span
                                class="inline-block px-3 py-1 text-sm rounded-full bg-purple-50 text-purple-700">
                                {{ $collegeMajor->field_of_study }}
                            </span>
                        @endif
                    </div>
                </div>
                <div class="flex flex-wrap gap-3">
                    <x-link-button
                        href="{{ route('college-majors.edit', $collegeMajor) }}"
                        class="bg-blue-500 text-white hover:bg-blue-600">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 mr-2" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                    </x-link-button>
                    <form
                        action="{{ route('college-majors.destroy', $collegeMajor) }}"
                        method="POST"
                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus jurusan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="flex items-center bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 transition-colors">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-4 w-4 mr-2" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            {{-- Left Column: Details Section --}}
            <div class="md:col-span-2">
                <div
                    class="bg-white rounded-xl shadow-sm border border-slate-100 p-6 space-y-8">
                    {{-- Description Section --}}
                    @if ($collegeMajor->description)
                        <div>
                            <h2
                                class="text-xl font-semibold text-slate-800 border-b pb-2 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 inline-block mr-1 text-slate-600"
                                    fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                Deskripsi Jurusan
                            </h2>
                            <div class="text-slate-600 leading-relaxed">
                                {{ $collegeMajor->description }}
                            </div>
                        </div>
                    @endif

                    {{-- Career Prospects Section --}}
                    @if ($collegeMajor->career_prospects)
                        <div>
                            <h2
                                class="text-xl font-semibold text-slate-800 border-b pb-2 mb-4">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 inline-block mr-1 text-slate-600"
                                    fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Prospek Karir
                            </h2>
                            <div class="text-slate-600 leading-relaxed">
                                {{ $collegeMajor->career_prospects }}
                            </div>
                        </div>
                    @endif

                    {{-- Additional Information --}}
                    <div class="bg-slate-50 rounded-lg p-4">
                        <h3 class="text-sm font-medium text-slate-600 mb-2">
                            Informasi Tambahan</h3>
                        <div
                            class="text-sm text-slate-500 flex flex-wrap gap-x-6 gap-y-1">
                            <p>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 inline-block mr-1"
                                    fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Dibuat:
                                {{ $collegeMajor->created_at->translatedFormat('d F Y') }}
                            </p>
                            <p>
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 inline-block mr-1"
                                    fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Terakhir diperbarui:
                                {{ $collegeMajor->updated_at->translatedFormat('d F Y') }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Right Column: Characteristics Section --}}
            <div class="md:col-span-1">
                <div
                    class="bg-white rounded-xl shadow-sm border border-slate-100 overflow-hidden">
                    <div
                        class="px-6 py-4 bg-slate-50 border-b border-slate-200 flex justify-between items-center">
                        <h2 class="text-lg font-semibold text-slate-800">
                            Karakteristik Jurusan</h2>
                        <span
                            class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded-full">
                            {{ $collegeMajor->majorCharacteristics->count() }}
                        </span>
                    </div>

                    <div class="p-4">
                        @if ($collegeMajor->majorCharacteristics->count() > 0)
                            <div class="space-y-3">
                                @foreach ($collegeMajor->majorCharacteristics as $characteristic)
                                    <x-major-characteristic.major-characteristic-item
                                        :characteristic="$characteristic" />
                                @endforeach
                            </div>
                        @else
                            <div class="text-center py-8 text-slate-500">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-12 w-12 mx-auto mb-2 text-slate-300"
                                    fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round" stroke-width="2"
                                        d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <p>Belum ada karakteristik yang ditambahkan</p>
                            </div>
                        @endif

                        <div class="flex flex-col gap-2 mt-4">
                            <x-link-button
                                href="{{ route('major-characteristics.create', $collegeMajor) }}"
                                class="bg-green-500 text-white hover:bg-green-600 w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2" d="M12 4v16m8-8H4" />
                                </svg>
                                Tambah Karakteristik
                            </x-link-button>
                            <x-link-button
                                href="{{ route('major-characteristics.create-many', $collegeMajor) }}"
                                class="bg-indigo-500 text-white hover:bg-indigo-600 w-full justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="h-4 w-4 mr-2" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M4 6h16M4 12h16m-7 6h7" />
                                </svg>
                                Tambah Banyak Karakteristik
                            </x-link-button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
