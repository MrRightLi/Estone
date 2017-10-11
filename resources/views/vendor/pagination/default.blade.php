@if ($paginator->hasPages())
    <div class="panel-foot table-foot clearfix">
        <div class="float-left">
            总计：{{ $paginator->total() }}条
        </div>
        <div class="float-right">
            <ul class="hl_page">
                <div>
                    {{-- Previous Page Link --}}
                    @if ($paginator->onFirstPage())
                    @else
                        <a class="next" href="{{ $paginator->previousPageUrl() }}">上一页</a>
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
                                @if ($page == $paginator->currentPage())
                                    <span class="current">{{ $page }}</span>
                                @else
                                    <a class="num" href="{{ $url }}">{{ $page }}</a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <a class="next" href="{{ $paginator->nextPageUrl() }}">下一页</a>
                    @else

                    @endif
                </div>
            </ul>
        </div>
    </div>
@endif