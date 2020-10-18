@if ($paginator->hasPages())
<!-- BEGIN: Pagination -->
<div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
    <ul class="pagination">
        {{-- More than 5 Pages --}}
        @if ($paginator->lastPage() > 5)
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
        <li>
            <a class="pagination__link" href="{{ $paginator->url(1) }}"> <i class="w-4 h-4"
                    data-feather="chevrons-left"></i> </a>
        </li>
        <li>
            <a class="pagination__link" href="{{ $paginator->url(($paginator->currentPage() - 1)) }}"> <i
                    class="w-4 h-4" data-feather="chevron-left"></i> </a>
        </li>
        @endif

        @if ($paginator->currentPage() > 2)
        <li> <span class="pagination__link">...</span> </li>
        @endif

        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
        <span aria-disabled="true">
            <li> <span class="pagination__link">... {{ $element }}</span> </li>
        </span>
        @endif
        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($paginator->lastPage()>5)

        @if ($paginator->onFirstPage() && $page == $paginator->currentPage())
        <li> <span class="pagination__link pagination__link--active">1</span> </li>
        <li> <a class="pagination__link" href="{{ $paginator->url(2) }}">2</a> </li>
        <li> <a class="pagination__link" href="{{ $paginator->url(3) }}">3</a> </li>
        @elseif($paginator->currentPage() == $paginator->lastPage() && $page == $paginator->currentPage())
        <li> <a class="pagination__link"
                href="{{ $paginator->url($paginator->currentPage() - 2) }}">{{ ($paginator->lastPage() - 2)}}</a> </li>
        <li> <a class="pagination__link"
                href="{{ $paginator->url($paginator->currentPage() -1) }}">{{ ($paginator->lastPage() - 1)}}</a> </li>
        <li> <span class="pagination__link pagination__link--active">{{ $paginator->lastPage()}}</span> </li>
        @elseif ($page == $paginator->currentPage())
        <li> <a class="pagination__link" href="{{ $paginator->url(($page - 1)) }}">{{ ($page - 1) }}</a> </li>
        <li> <span class="pagination__link pagination__link--active">{{ $page }}</span> </li>
        <li> <a class="pagination__link" href="{{ $paginator->url(($page + 1)) }}">{{ ($page + 1) }}</a> </li>
        @endif

        @else

        @if ($page == $paginator->currentPage())
        <li> <span class="pagination__link pagination__link--active">{{ $page }}</span> </li>
        @else
        <li> <a class="pagination__link" href="{{ $url }}">{{ $page }}</a> </li>
        @endif

        @endif

        @endforeach
        @endif
        @endforeach

        {{-- More than 5 Pages --}}
        @if ($paginator->lastPage() > 5)

        @if (($paginator->lastPage()-1) > $paginator->currentPage())
        <li> <span class="pagination__link">...</span> </li>
        @endif

        {{-- Next Page Link --}}
        @if ($paginator->currentPage() != $paginator->lastPage())
        <li>
            <a class="pagination__link" href="{{ $paginator->url(($paginator->currentPage() + 1)) }}"> <i
                    class="w-4 h-4" data-feather="chevron-right"></i>
            </a>
        </li>
        <li>
            <a class="pagination__link" href="{{ $paginator->url($paginator->lastPage()) }}"> <i class="w-4 h-4"
                    data-feather="chevrons-right"></i> </a>
        </li>
        @endif

        @endif
    </ul>
    <select class="w-20 input box mt-3 sm:mt-0">
        <option>10</option>
        <option>25</option>
        <option>35</option>
        <option>50</option>
    </select>
</div>
<!-- END: Pagination -->
@endif
