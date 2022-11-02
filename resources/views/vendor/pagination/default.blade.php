@if ($paginator->hasPages())
    <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled"><i class="material-icons">chevron_left</i></li>
        @else
            <li class="waves-effect"><a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev"><i class="material-icons">chevron_left</i></a></li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="waves-effect disabled"><a class="page-link">{{ $element }}</a></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="waves-effect active"><a class="page-link">{{ $page }}</a></li>
                    @else
                        <li class="waves-effect"><a class="" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="waves-effect"><a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="material-icons">chevron_right</i></a></li>
        @else
            <li class="disabled"><i class="material-icons">chevron_right</i></li>
        @endif
    </ul>
@endif
