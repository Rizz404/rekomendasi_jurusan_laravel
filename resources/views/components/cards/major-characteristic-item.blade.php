@props(['characteristic'])

<div
    class="bg-white rounded-lg border border-slate-200 overflow-hidden hover:shadow-md transition-shadow">
    <div class="p-4 flex justify-between items-start">
        <div>
            <h3 class="font-medium text-slate-800">
                {{ $characteristic->criteria->name }}</h3>
            <p class="text-sm text-slate-600 mt-1">
                {{ $characteristic->criteria->description }}</p>
        </div>
        <span class="px-3 py-1 text-sm rounded-full bg-blue-100 text-blue-800">
            {{ number_format($characteristic->compatibility_weight * 100, 0) }}%
        </span>
    </div>
    <div class="bg-slate-50 px-4 py-3 flex justify-between items-center text-sm">
        @if ($characteristic->minimum_score)
            <span class="text-slate-600">Skor Minimum: <span
                    class="font-medium">{{ $characteristic->minimum_score }}</span></span>
        @else
            <span class="text-slate-500 italic">Tidak ada skor minimum</span>
        @endif

        <div class="flex space-x-2">
            <a href="{{ route('major-characteristics.edit', $characteristic) }}"
                class="text-blue-600 hover:text-blue-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                </svg>
            </a>
            <form
                action="{{ route('major-characteristics.destroy', $characteristic) }}"
                method="POST" class="inline"
                onsubmit="return confirm('Apakah Anda yakin ingin menghapus karakteristik ini?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-600 hover:text-red-800">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                        fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</div>
