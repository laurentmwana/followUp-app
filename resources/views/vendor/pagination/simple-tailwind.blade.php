@if ($paginator->hasPages())
    <nav role="navigation" aria-label="Pagination Navigation" class="flex justify-between">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                {!! __('pagination.previous') !!}
            </span>
        @else
            <x-button-link variant="secondary" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                {!! __('pagination.previous') !!}
            </x-button-link>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <x-button-link variant="secondary" href="{{ $paginator->nextPageUrl() }}" rel="next">
                {!! __('pagination.next') !!}
            </x-button-link>
        @else
            <span class="relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300 cursor-default leading-5 rounded-md dark:text-gray-600 dark:bg-gray-800 dark:border-gray-600">
                {!! __('pagination.next') !!}
            </span>
        @endif
    </nav>
@endif
