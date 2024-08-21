@if ($paginator->hasPages())
    <ul class="pagination" role="navigation" style="display: flex; justify-content: center; list-style: none; padding: 0;">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')" style="border: 1px solid #dee2e6; padding: 8px;">
                <span aria-hidden="true">&lt;</span>
            </li>
        @else
            <li style="border: 1px solid #dee2e6; padding: 8px;">
                <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')" style="text-decoration: none; color: #000;">&lt;</a>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="disabled" aria-disabled="true" style="border: 1px solid #dee2e6; padding: 8px;"><span>{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="active" aria-current="page" style="border: 1px solid #dee2e6; padding: 8px; background-color: #000; color: #fff;"><span>{{ $page }}</span></li>
                    @else
                        <li style="border: 1px solid #dee2e6; padding: 8px;">
                            <a href="{{ $url }}" style="text-decoration: none; color: #000;">{{ $page }}</a>
                        </li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li style="border: 1px solid #dee2e6; padding: 8px;">
                <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')" style="text-decoration: none; color: #000;">&gt;</a>
            </li>
        @else
            <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')" style="border: 1px solid #dee2e6; padding: 8px;">
                <span aria-hidden="true">&gt;</span>
            </li>
        @endif
    </ul>
@endif
