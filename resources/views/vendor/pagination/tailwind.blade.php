@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="pagination">
        <div class="pagination__inner">
            @if ($paginator->onFirstPage())
                <span class="">
                    {!! __('pagination.previous') !!}
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="ajax-button">
                    {!! __('pagination.previous') !!}
                </a>
            @endif

            <div class="">
                <div>
                    {{-- Pagination Elements --}}
                    @foreach ($elements as $element)
                        {{-- "Three Dots" Separator --}}
                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="">{{ $element }}</span>
                            </span>
                        @endif

                        {{-- Array Of Links --}}
                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page">
                                        <span class="">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" class="ajax-button">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>
            </div>
            
            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="ajax-button">
                    {!! __('pagination.next') !!}
                </a>
            @else
                <span class="">
                    {!! __('pagination.next') !!}
                </span>
            @endif
        </div>
    </nav>
@endif
