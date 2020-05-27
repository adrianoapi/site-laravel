@if ($paginator->hasPages())
    <div class="table-pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <a href="#" class="disabled">Previous</a>
        @else
            <a href="{{ $paginator->previousPageUrl().'&'.str_replace('page=', '', $_SERVER['QUERY_STRING']) }}">Previous</a>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                <span>
                    @if ($page == $paginator->currentPage())
                        <a href="#" class="active"><span>{{ $page }}</span></a>
                    @else
                        <a href="{{ $url.'&'.str_replace('page=', '', $_SERVER['QUERY_STRING']) }}">{{ $page }}</a>
                    @endif
                </span>
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl().'&'.str_replace('page=', '', $_SERVER['QUERY_STRING']) }}" rel="next">Next</a>
        @else
            <a href="#" class="disabled">Next</a>
        @endif
    </div>
@endif