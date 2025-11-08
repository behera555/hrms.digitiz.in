@if($paginator->hasPages())
<ul class="pagination mg-b-0 page-0 ">
        @if ($paginator->onFirstPage())
        <li class="page-item"><a aria-label="Next" class="page-link"  href="javascript:void(0);"><i class="fa fa-angle-left"></i></a></li>
        @else
        <li class="page-item"><a aria-label="Last" class="page-link"  href="{{ $paginator->previousPageUrl() }}"><i class="fa fa-angle-double-left"></i></a></li>
        @endif
        @foreach ($elements as $element)
            @if (is_string($element))
                <li class="disabled"><span>{{ $element }}</span></li>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active"><a class="page-link"  href="javascript:void(0);">{{ $page }}</a></li>
                    @else
                        <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
        <li class="page-item"><a aria-label="Next" class="page-link"  href="{{ $paginator->nextPageUrl() }}"><i class="fa fa-angle-double-right"></i></a></li>
        @else
        <li class="page-item"><a aria-label="Last" class="page-link"  href="javascript:void(0);"><i class="fa fa-angle-right"></i></a></li>
        @endif
    </ul>
@endif 