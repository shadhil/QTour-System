@if ($paginator->hasPages())
<!-- BEGIN: Pagination -->
<div class="intro-y col-span-12 flex flex-wrap sm:flex-row sm:flex-no-wrap items-center">
    <ul class="pagination">
        {{-- More than 5 Pages --}}
        @if ($paginator->lastPage() > 5)
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
        <li>
            <a class="pagination__link" href="javascript:void(0);" data-page-num={{ 1 }}
                onclick="filterPages(this.getAttribute('data-page-num'))"> <i class="w-4 h-4"
                    data-feather="chevrons-left"></i> </a>
        </li>
        <li>
            <a class="pagination__link" href="javascript:void(0);" data-page-num={{ ($paginator->currentPage() - 1) }}
                onclick="filterPages(this.getAttribute('data-page-num'))">
                <i class="w-4 h-4" data-feather="chevron-left"></i>
            </a>
        </li>
        @endif

        @if ($paginator->currentPage() > 2)
        <li> <span class="pagination__link">...</span> </li>
        @endif

        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        {{-- @if (is_string($element))
        <span aria-disabled="true">
            <li> <span class="pagination__link">*** {{ $element }}</span> </li>
        </span>
        @endif --}}
        {{-- Array Of Links --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($paginator->lastPage()>5)

        @if ($paginator->onFirstPage() && $page == $paginator->currentPage())
        <li> <span class="pagination__link pagination__link--active">1</span> </li>
        <li> <a class="pagination__link" href="javascript:void(0);" data-page-num={{ 2 }}
                onclick="filterPages(this.getAttribute('data-page-num'))">2</a>
        </li>
        <li> <a class="pagination__link" href="javascript:void(0);" data-page-num={{ 3 }}
                onclick="filterPages(this.getAttribute('data-page-num'))">3</a>
        </li>
        @elseif($paginator->currentPage() == $paginator->lastPage() && $page == $paginator->currentPage())
        <li> <a class="pagination__link" href="javascript:void(0);" data-page-num={{ ($paginator->lastPage() - 2) }}
                onclick="filterPages(this.getAttribute('data-page-num'))">{{ ($paginator->lastPage() - 2)}}</a> </li>
        <li> <a class="pagination__link" href="javascript:void(0);" data-page-num={{ ($paginator->lastPage() - 1) }}
                onclick="filterPages(this.getAttribute('data-page-num'))">{{ ($paginator->lastPage() - 1)}}</a> </li>
        <li> <span class="pagination__link pagination__link--active">{{ $paginator->lastPage()}}</span> </li>
        @elseif ($page == $paginator->currentPage())
        <li> <a class="pagination__link" href="javascript:void(0);" data-page-num={{ ($page - 1) }}
                onclick="filterPages(this.getAttribute('data-page-num'))"> {{ ($page - 1) }} </a> </li>
        <li> <span class="pagination__link pagination__link--active">{{ $page }}</span> </li>
        <li> <a class="pagination__link" href="javascript:void(0);" data-page-num={{ ($page + 1) }}
                onclick="filterPages(this.getAttribute('data-page-num'))">{{ ($page + 1) }}</a> </li>
        @endif

        @else

        @if ($page == $paginator->currentPage())
        <li> <span class="pagination__link pagination__link--active">{{ $page }}</span> </li>
        @else
        <li> <a class="pagination__link" href="javascript:void(0);" data-page-num={{ $page }}
                onclick="filterPages(this.getAttribute('data-page-num'))">{{ $page }}</a> </li>
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
            <a class="pagination__link" href="javascript:void(0);" data-page-num={{ ($paginator->currentPage() + 1) }}
                onclick="filterPages(this.getAttribute('data-page-num'))">
                <i class="w-4 h-4" data-feather="chevron-right"></i>
            </a>
        </li>
        <li>
            <a class="pagination__link" href="javascript:void(0);" data-page-num={{ $paginator->lastPage() }}
                onclick="filterPages(this.getAttribute('data-page-num'))"> <i class="w-4 h-4"
                    data-feather="chevrons-right"></i> </a>
        </li>
        @endif

        @endif
    </ul>
    <select id="input-count" class="w-20 input box mt-3 sm:mt-0" onchange="filterCount()">
        <option value="10" selected>10</option>
        <option value="20">20</option>
        <option value="30">30</option>
        <option value="40">40</option>
        <option value="50">50</option>
    </select>
</div>
<!-- END: Pagination -->
@endif
