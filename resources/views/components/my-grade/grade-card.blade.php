@props(['studentScore' => $studentScore])

<div
    class="bg-white border border-teto-cream rounded-lg shadow overflow-hidden hover:shadow-md transition-shadow duration-300">
    <div
        class="flex items-center justify-between p-4 border-b border-teto-cream">
        <h3 class="font-semibold text-teto-dark-text">
            {{ $studentScore->criteria->name }}</h3>
        <span
            class="px-3 py-1 rounded-full text-sm font-medium {{ $studentScore->criteria->type === 'benefit' ? 'bg-teto-light text-white' : 'bg-teto-secondary text-white' }}">
            {{ ucfirst($studentScore->criteria->type) }}
        </span>
    </div>
    <div class="p-4">
        <div class="flex justify-between items-center mb-2">
            <span class="text-teto-dark-text text-sm">Nilai:</span>
            <span
                class="text-2xl font-bold text-teto-dark-text">{{ $studentScore->score }}</span>
        </div>

        <div class="flex justify-between items-center">
            <span class="text-teto-dark-text text-sm">Bobot:</span>
            <span
                class=" text-teto-dark-text">{{ $studentScore->criteria->weight }}</span>
        </div>

        @if ($studentScore->criteria->description)
            <div class="mt-3 pt-3 border-t border-teto-cream">
                <p class=" text-teto-dark-text text-sm">
                    {{ $studentScore->criteria->description }}
                </p>
            </div>
        @endif

        <div
            class="mt-4 pt-3 border-t border-teto-cream flex justify-between items-center text-xs text-teto-dark-text">
            <span>{{ $studentScore->input_date->format('d M Y') }}</span>
            <div class="flex gap-2">
                <a href="{{ route('my-grades.edit', $studentScore) }}"
                    class=" text-teto-metallic hover:text-teto-accent">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path
                            d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                    </svg>
                </a>
                <form action="{{ route('my-grades.destroy', $studentScore) }}"
                    method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class=" text-teto-metallic hover:text-teto-accent"
                        onclick="return confirm('Yakin ingin menghapus nilai ini?')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4"
                            viewBox="0 0 20 20" fill="currentColor">
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
