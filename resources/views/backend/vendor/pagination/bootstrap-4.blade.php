@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" aria-disabled="true" aria-label="&laquo; Previous">
                <span class="page-link alpha-indigo text-indigo" aria-hidden="true">&laquo;</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link alpha-indigo text-indigo font-weight-bold" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="&laquo; Previous">
                    &laquo;
                </a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link alpha-indigo">{{ $element }}</span>
                </li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item" aria-current="page">
                            <span class="page-link bg-indigo">{{ $page }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link alpha-indigo" href="{{ $url }}">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <a class="page-link alpha-indigo text-indigo font-weight-bold" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="Next &raquo;">
                    &raquo;
                </a>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="Next &raquo;">
                <span class="page-link alpha-indigo text-indigo" aria-hidden="true">&raquo;</span>
            </li>
        @endif
    </ul>
@endif
