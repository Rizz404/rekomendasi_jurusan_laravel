@props(['university' => $university])

<div
    class="bg-white border border-teto-cream rounded-lg shadow overflow-hidden hover:shadow-md transition-shadow duration-300">
    <div class="p-4">
        <div class="flex items-start">
            @if ($university->logo)
                <img src="{{ $university->logo }}" alt="{{ $university->name }}"
                    class="w-16 h-16 object-contain mr-3">
            @else
                <div
                    class="w-16 h-16 bg-teto-cream rounded-full flex items-center justify-center mr-3">
                    <span
                        class=" text-teto-dark-text font-semibold text-xl">{{ substr($university->name, 0, 1) }}</span>
                </div>
            @endif
            <div>
                <h3 class="font-semibold text-teto-dark-text">
                    {{ $university->name }}</h3>
                <p class=" text-teto-metallic text-sm">
                    {{ $university->city }},
                    {{ $university->province }}</p>
                <div class="flex items-center mt-1">
                    <span
                        class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $university->status === 'negeri' ? 'bg-teto-light text-white' : 'bg-teto-secondary text-white' }}">
                        {{ ucfirst($university->status) }}
                    </span>
                    <div class="flex items-center ml-2">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-4 w-4 text-teto-accent" viewBox="0 0 20 20"
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

        <div class="mt-3 pt-3 border-t border-teto-cream">
            <p class=" text-teto-dark-text text-sm line-clamp-3">
                {{ $university->description ?? 'Tidak ada deskripsi tersedia.' }}
            </p>
        </div>

        <div
            class="mt-4 pt-3 border-t border-teto-cream flex justify-between items-center">
            @if ($university->website)
                <a href="{{ $university->website }}" target="_blank"
                    class="text-sm  text-teto-metallic hover:text-teto-accent flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1"
                        viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M4.083 9h1.946c.089-1.546.383-2.97.837-4.118A6.004 6.004 0 004.083 9zM10 2a8 8 0 100 16 8 8 0 000-16zm0 2c-.076 0-.232.032-.465.262-.238.234-.497.623-.737 1.182-.389.907-.673 2.142-.766 3.556h3.936c-.093-1.414-.377-2.649-.766-3.556-.24-.56-.5-.948-.737-1.182C10.232 4.032 10.076 4 10 4zm3.971 5c-.089-1.546-.383-2.97-.837-4.118A6.004 6.004 0 0115.917 9h-1.946zm-2.003 2H8.032c.093 1.414.377 2.649.766 3.556.24.56.5.948.737 1.182.233.23.389.262.465.262.076 0 .232-.032.465-.262.238-.234.498-.623.737-1.182.389-.907.673-2.142.766-3.556zm1.166 4.118c.454-1.147.748-2.572.837-4.118h1.946a6.004 6.004 0 01-2.783 4.118zm-6.268 0C6.412 13.97 6.118 12.546 6.03 11H4.083a6.004 6.004 0 002.783 4.118z"
                            clip-rule="evenodd" />
                    </svg>
                    Website
                </a>
            @else
                <span class="text-sm text-teto-metallic">Tidak ada
                    website</span>
            @endif
            <a href="{{ route('my-universities.show', $university) }}"
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
