@if ($paginator->hasPages())
    <div class="flex items-center">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <span class="shadow rounded-l rounded-sm bg-white px-3 py-2 border border-brand-light cursor-not-allowed no-underline hover:text-white">&laquo;</span>
        @else
            <a
                class="shadow-md rounded-l rounded-sm bg-white border-t border-b border-l border-brand-light px-3 py-2 text-brand-dark hover:bg-brand-light hover:text-white no-underline"
                href="{{ $paginator->previousPageUrl() }}"
                rel="prev"
            >
                &laquo;
            </a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <span class="shadow-md border-t border-b border-l bg-white border-brand-light px-3 py-2 cursor-not-allowed no-underline">{{ $element }}</span>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="shadow-md border-t border-b text-white border-l border-brand-light px-3 py-2 bg-brand-light no-underline">{{ $page }}</span>
                    @else
                        <a class="shadow-md border-t border-b border-l bg-white border-brand-light px-3 py-2 hover:bg-brand-light hover:text-white text-brand-dark no-underline" href="{{ $url }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a class="shadow-md rounded-r rounded-sm border bg-white border-brand-light px-3 py-2 hover:bg-brand-light hover:text-white text-brand-dark no-underline" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
        @else
            <span class="shadow-md rounded-r rounded-sm border bg-white border-brand-light px-3 py-2 hover:bg-brand-light hover:text-white text-brand-dark no-underline cursor-not-allowed">&raquo;</span>
        @endif
    </div>
@endif