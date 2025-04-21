<x-user-layout title="Nilai kamu">
    <div class="container px-4 py-6">
        <div
            class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
            <h2 class="text-2xl font-bold text-slate-800 mb-4 md:mb-0">
                Daftar Nilai Kamu
            </h2>
            <div class="flex gap-2">
                <x-link-button href="{{ route('student-scores.create') }}"
                    class="bg-slate-700 hover:bg-slate-800 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah
                </x-link-button>
                <x-link-button href="{{ route('student-scores.create-many') }}"
                    class="bg-slate-600 hover:bg-slate-700 text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 3a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0V7H8a1 1 0 110-2h1V4a1 1 0 011-1zm-4 8a1 1 0 011-1h8a1 1 0 110 2H7a1 1 0 01-1-1zm0 4a1 1 0 011-1h8a1 1 0 110 2H7a1 1 0 01-1-1z"
                            clip-rule="evenodd" />
                    </svg>
                    Tambah Banyak
                </x-link-button>
            </div>
        </div>

        @if ($studentScores->isEmpty())
            <div
                class="bg-slate-100 border border-slate-200 rounded-lg p-8 text-center">
                <svg xmlns="http://www.w3.org/2000/svg"
                    class="h-16 w-16 mx-auto text-slate-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <h3 class="mt-4 text-lg font-medium text-slate-700">Belum ada
                    nilai</h3>
                <p class="mt-2 text-slate-500">Tambahkan nilai pertama kamu
                    dengan menekan tombol "Tambah" di atas.</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach ($studentScores as $studentScore)
                    <div
                        class="bg-white border border-slate-200 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <div
                            class="flex items-center justify-between p-4 border-b border-slate-100">
                            <h3 class="font-semibold text-slate-800">
                                {{ $studentScore->criteria->name }}</h3>
                            <span
                                class="px-3 py-1 rounded-full text-sm font-medium {{ $studentScore->criteria->type === 'benefit' ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800' }}">
                                {{ ucfirst($studentScore->criteria->type) }}
                            </span>
                        </div>
                        <div class="p-4">
                            <div class="flex justify-between items-center mb-2">
                                <span
                                    class="text-slate-500 text-sm">Nilai:</span>
                                <span
                                    class="text-2xl font-bold text-slate-800">{{ $studentScore->score }}</span>
                            </div>

                            <div class="flex justify-between items-center">
                                <span
                                    class="text-slate-500 text-sm">Bobot:</span>
                                <span
                                    class="text-slate-700">{{ $studentScore->criteria->weight }}</span>
                            </div>

                            @if ($studentScore->criteria->description)
                                <div
                                    class="mt-3 pt-3 border-t border-slate-100">
                                    <p class="text-slate-600 text-sm">
                                        {{ $studentScore->criteria->description }}
                                    </p>
                                </div>
                            @endif

                            <div
                                class="mt-4 pt-3 border-t border-slate-100 flex justify-between items-center text-xs text-slate-500">
                                <span>{{ $studentScore->input_date->format('d M Y') }}</span>
                                <div class="flex gap-2">
                                    <a href="{{ route('student-scores.edit', $studentScore->id) }}"
                                        class="text-slate-600 hover:text-slate-800">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="h-4 w-4" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path
                                                d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                        </svg>
                                    </a>
                                    <form
                                        action="{{ route('student-scores.destroy', $studentScore->id) }}"
                                        method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-slate-600 hover:text-red-600"
                                            onclick="return confirm('Yakin ingin menghapus nilai ini?')">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="h-4 w-4"
                                                viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-8 text-center">
            <x-link-button
                href="{{ route('recomendations.my-recomendations') }}"
                class="bg-slate-800 hover:bg-slate-900 text-white px-6 py-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                        clip-rule="evenodd" />
                </svg>
                Lihat Rekomendasi
            </x-link-button>
        </div>
    </div>
</x-user-layout>
