@props(['collegeMajor' => $collegeMajor])

<div
    class="bg-white border border-teto-cream rounded-lg shadow overflow-hidden hover:shadow-md transition-shadow duration-300">
    <div
        class="flex items-center justify-between p-4 border-b border-teto-cream">
        <h3 class="font-semibold text-teto-dark-text font-sans">
            {{ $collegeMajor->major_name }}</h3>
        <span
            class="px-3 py-1 rounded-full text-sm font-medium bg-teto-light text-white">
            {{ $collegeMajor->field_of_study }}
        </span>
    </div>
    <div class="p-4">
        <div class="flex justify-between items-center mb-2">
            <span class="text-teto-dark-text text-sm font-body">Fakultas:</span>
            <span
                class="text-teto-primary font-body">{{ $collegeMajor->faculty ?? 'Tidak tersedia' }}</span>
        </div>

        <div class="mt-3 pt-3 border-t border-teto-cream">
            <p class="text-teto-dark-text text-sm line-clamp-3 font-body">
                {{ $collegeMajor->description ?? 'Tidak ada deskripsi tersedia.' }}
            </p>
        </div>

        <div class="mt-4 pt-3 flex justify-end">
            <a href="{{ route('my-college-majors.show', $collegeMajor) }}"
                class="text-sm text-white bg-teto-primary hover:bg-teto-dark px-3 py-1 rounded-full font-medium flex items-center font-sans">
                Lihat Detail
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1"
                    viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                        clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
</div>
