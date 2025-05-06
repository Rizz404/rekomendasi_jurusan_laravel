<x-user-layout title="Detail Universitas">
    <div class="container px-4 py-6">
        <x-breadcrumb :items="[
            ['title' => 'Universitas', 'url' => route('my-universities.index')],
            ['title' => $university->name, 'url' => '#'],
        ]" :show-back-button="true" :back-url="route('my-universities.index')"
            back-text="Kembali ke daftar universitas" />

        <div
            class="bg-white border border-teto-cream rounded-lg shadow-sm overflow-hidden">
            <div class="p-6">
                <div
                    class="flex flex-col md:flex-row md:items-center md:justify-between">
                    <div class="flex items-center">
                        @if ($university->logo)
                            <img src="{{ $university->logo }}"
                                alt="{{ $university->name }}"
                                class="w-20 h-20 object-contain mr-4">
                        @else
                            <div
                                class="w-20 h-20 bg-teto-cream rounded-full flex items-center justify-center mr-4">
                                <span
                                    class=" text-teto-dark-text font-semibold text-2xl">{{ substr($university->name, 0, 1) }}</span>
                            </div>
                        @endif
                        <div>
                            <h1 class="text-2xl font-bold text-teto-primary">
                                {{ $university->name }}</h1>
                            <p class="text-teto-dark-text">
                                {{ $university->city }},
                                {{ $university->province }}</p>
                            <div class="flex items-center mt-1">
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $university->status === 'negeri' ? 'bg-blue-100 text-blue-800' : 'bg-purple-100 text-purple-800' }}">
                                    {{ ucfirst($university->status) }}
                                </span>
                                <div class="flex items-center ml-3">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 text-yellow-400"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span
                                        class="text-lg font-medium ml-1">{{ number_format($university->rating, 1) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($university->website)
                        <x-link-button href="{{ $university->website }}">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5 mr-2  text-white" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2"
                                    d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                            </svg>
                            Kunjungi Website
                        </x-link-button>
                    @endif
                </div>

                <div class="mt-6 border-t border-teto-cream pt-6">
                    <h2 class="text-lg font-semibold text-teto-dark mb-3">
                        Deskripsi Universitas</h2>
                    <p class="text-teto-dark-text">
                        {{ $university->description ?? 'Tidak ada deskripsi tersedia.' }}
                    </p>
                </div>

                <div class="mt-6 border-t border-teto-cream pt-6">
                    <div
                        class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4">
                        <h2 class="text-lg font-semibold text-teto-dark">Jurusan
                            yang Tersedia</h2>
                    </div>

                    @if ($university->collegeMajors->count() > 0)
                        <div class="overflow-x-auto rounded shadow">
                            <table
                                class="min-w-full divide-y divide-teto-cream">
                                <thead class="bg-teto-cream">
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium  text-teto-dark-text uppercase tracking-wider">
                                            Nama Jurusan</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium  text-teto-dark-text uppercase tracking-wider">
                                            Fakultas</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium  text-teto-dark-text uppercase tracking-wider">
                                            Bidang Studi</th>
                                        <th scope="col"
                                            class="px-6 py-3 text-right text-xs font-medium  text-teto-dark-text uppercase tracking-wider">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody
                                    class="bg-white divide-y divide-teto-cream">
                                    @foreach ($university->collegeMajors as $major)
                                        <tr
                                            class="hover:bg-teto-cream-hover cursor-pointer transition-colors duration-150">
                                            <td
                                                class="px-6 py-4 whitespace-nowrap">
                                                <div
                                                    class="text-sm font-medium text-teto-dark-text">
                                                    {{ $major->major_name }}
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap">
                                                <div
                                                    class="text-sm text-teto-dark-text">
                                                    {{ $major->faculty ?? 'Tidak tersedia' }}
                                                </div>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-slate-100 text-teto-dark">
                                                    {{ $major->field_of_study ?? 'Tidak tersedia' }}
                                                </span>
                                            </td>
                                            <td
                                                class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                                <a href="{{ route('my-college-majors.show', $major) }}"
                                                    class="text-teto-dark-text hover:text-teto-dark-text">
                                                    Detail
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="bg-teto-cream rounded-lg p-6 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-12 w-12 mx-auto text-slate-400"
                                fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round"
                                    stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <h3
                                class="mt-3 text-lg font-medium text-teto-dark-text">
                                Belum ada jurusan</h3>
                            <p class="mt-2  text-teto-dark-text">Belum ada data
                                jurusan yang tersedia di universitas ini.</p>
                        </div>
                    @endif
                </div>

                <div class="mt-6 border-t border-teto-cream pt-6">
                    <h2 class="text-lg font-semibold text-teto-dark mb-4">Lokasi
                    </h2>

                    <div class="bg-teto-cream rounded-lg p-4">
                        <div class="flex items-start">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5  text-teto-dark-text mt-0.5 mr-2"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                    clip-rule="evenodd" />
                            </svg>
                            <div>
                                <h3 class="font-medium text-teto-dark">
                                    {{ $university->name }}</h3>
                                <p class="text-teto-dark-text mt-1">
                                    {{ $university->city }},
                                    {{ $university->province }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-6 border-t border-teto-cream pt-6">
                    <h2 class="text-lg font-semibold text-teto-dark mb-4">
                        Rating/Akreditas</h2>

                    <div class="bg-teto-cream rounded-lg p-4">
                        <div class="flex items-center mb-4">
                            <div class="flex items-center">
                                @for ($i = 1; $i <= 5; $i++)
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                        class="h-5 w-5 {{ $i <= ceil($university->rating) ? 'text-yellow-400' : 'text-slate-300' }}"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path
                                            d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118l-2.8-2.034c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                @endfor
                                <span
                                    class="ml-2 text-teto-dark-text font-medium">{{ number_format($university->rating, 1) }}
                                    / 5.0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-user-layout>
