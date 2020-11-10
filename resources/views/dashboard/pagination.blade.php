@if ($paginator->hasPages())
    <ul class="pagination float-right">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
        <li class="footable-page-arrow"><a href="#" class="disabled"><</a></li>
        @else
        <li class="footable-page-arrow"><a href="{{ $paginator->previousPageUrl().'&'.str_replace('page=', '', $_SERVER['QUERY_STRING']) }}"><</a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="footable-page"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)

                    @if ($page == $paginator->currentPage())
                    <li class="footable-page active"><a href="#" class="active"><span>{{ $page }}</span></a></li>
                    @else
                    <li class="footable-page"><a href="{{ $url.'&'.str_replace('page=', '', $_SERVER['QUERY_STRING']) }}">{{ $page }}</a></li>
                    @endif

                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
        <li class="footable-page-arrow"><a href="{{ $paginator->nextPageUrl().'&'.str_replace('page=', '', $_SERVER['QUERY_STRING']) }}" rel="next">></a></li>
        @else
        <li class="footable-page-arrow"><a href="#" class="disabled">></a></li>
        @endif
    </ul>
@endif
