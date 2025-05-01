@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation"
        class="flex items-center justify-between">
        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
            <div>
                <p class="text-sm text-teto-dark-text-muted">
                    Showing
                    <span
                        class="font-medium">{{ $paginator->firstItem() }}</span>
                    to
                    <span class="font-medium">{{ $paginator->lastItem() }}</span>
                    of
                    <span class="font-medium">{{ $paginator->total() }}</span>
                    results
                </p>
            </div>

            <div>
                <ul class="flex items-center space-x-1">
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                        <li
                            class="px-3 py-2 rounded text-teto-dark-text-muted bg-teto-cream-hover opacity-50 cursor-not-allowed">
                            <span>&laquo; Previous</span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $paginator->previousPageUrl() }}"
                                class="px-3 py-2 rounded text-teto-dark-text bg-teto-cream-hover hover:bg-teto-cream transition duration-150 ease-in-out">
                                &laquo; Previous
                            </a>
                        </li>
                    @endif

                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <li
                                class="px-3 py-2 rounded text-teto-dark-text-muted bg-teto-cream-hover">
                                <span>{{ $element }}</span>
                            </li>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <li
                                        class="px-3 py-2 rounded text-white bg-teto-primary font-medium">
                                        <span>{{ $page }}</span>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ $url }}"
                                            class="px-3 py-2 rounded text-teto-dark-text bg-teto-cream-hover hover:bg-teto-cream transition duration-150 ease-in-out">
                                            {{ $page }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <li>
                            <a href="{{ $paginator->nextPageUrl() }}"
                                class="px-3 py-2 rounded text-teto-dark-text bg-teto-cream-hover hover:bg-teto-cream transition duration-150 ease-in-out">
                                Next &raquo;
                            </a>
                        </li>
                    @else
                        <li
                            class="px-3 py-2 rounded text-teto-dark-text-muted bg-teto-cream-hover opacity-50 cursor-not-allowed">
                            <span>Next &raquo;</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>

        {{-- Mobile Pagination --}}
        <div class="flex items-center justify-between sm:hidden">
            @if ($paginator->onFirstPage())
                <span
                    class="px-4 py-2 rounded text-teto-dark-text-muted bg-teto-cream-hover opacity-50 cursor-not-allowed">
                    &laquo; Previous
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}"
                    class="px-4 py-2 rounded text-teto-dark-text bg-teto-cream-hover hover:bg-teto-cream transition duration-150 ease-in-out">
                    &laquo; Previous
                </a>
            @endif

            <div class="text-sm text-teto-dark-text-muted">
                <span>{{ $paginator->currentPage() }}</span>
                <span>/</span>
                <span>{{ $paginator->lastPage() }}</span>
            </div>

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}"
                    class="px-4 py-2 rounded text-teto-dark-text bg-teto-cream-hover hover:bg-teto-cream transition duration-150 ease-in-out">
                    Next &raquo;
                </a>
            @else
                <span
                    class="px-4 py-2 rounded text-teto-dark-text-muted bg-teto-cream-hover opacity-50 cursor-not-allowed">
                    Next &raquo;
                </span>
            @endif
        </div>
    </nav>
@endif
