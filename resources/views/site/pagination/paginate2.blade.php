
@if ($paginator->hasPages())
{{--    <ul class='pagination phantrang'>--}}
{{--        <li class='disabled'>--}}
{{--        <li class='active'><a href='#'>1<span class='sr-only'></span></a></li>--}}
{{--        <li><a href="https://vietlandtravel.vn/danh-muc/tour-khuyen-mai.html?per_page=12"--}}
{{--               data-ci-pagination-page="2">2</a></li>--}}
{{--        <li><a href="https://vietlandtravel.vn/danh-muc/tour-khuyen-mai.html?per_page=24"--}}
{{--               data-ci-pagination-page="3">3</a></li>--}}
{{--        <li><a href="https://vietlandtravel.vn/danh-muc/tour-khuyen-mai.html?per_page=12" data-ci-pagination-page="2"--}}
{{--               rel="next">&gt;</a>--}}
{{--    </ul>--}}

    <ul class="pagination phantrang">
        @if (!$paginator->onFirstPage())
            <li><a href="{{ $paginator->previousPageUrl() }}" data-ci-pagination-page="1"
                   rel="prev">&lt;</a></li>
        @endif

            @foreach ($elements as $element)
                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li class="active"><a href="#">{{ $page }}<span class="sr-only"></span></a></li>
                        @else
                            <li><a href="{{ $url }}"
                                   data-ci-pagination-page="{{ $page }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" data-ci-pagination-page="3"
                       rel="next">&gt;</a></li>
            @endif
    </ul>
@endif

