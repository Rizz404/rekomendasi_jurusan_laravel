@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation"
        class="flex justify-between">

        @if ($paginator->onFirstPage())
            <span
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-teto-dark-text-muted bg-teto-cream-hover opacity-50 cursor-not-allowed rounded">
                &laquo; Previous
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}"
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-teto-dark-text bg-teto-cream-hover hover:bg-teto-cream transition duration-150 ease-in-out rounded">
                &laquo; Previous
            </a>
        @endif


        <div class="hidden md:flex items-center px-4">
            <span class="text-sm text-teto-dark-text-muted">
                Showing
                <span class="font-medium">{{ $paginator->firstItem() }}</span>
                to
                <span class="font-medium">{{ $paginator->lastItem() }}</span>
                of
                <span class="font-medium">{{ $paginator->total() }}</span>
                results
            </span>
        </div>


        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}"
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-teto-dark-text bg-teto-cream-hover hover:bg-teto-cream transition duration-150 ease-in-out rounded">
                Next &raquo;
            </a>
        @else
            <span
                class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-teto-dark-text-muted bg-teto-cream-hover opacity-50 cursor-not-allowed rounded">
                Next &raquo;
            </span>
        @endif
    </nav>
@endif
