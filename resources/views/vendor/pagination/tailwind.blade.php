@if ($paginator->hasPages())
    <div class="pagination">
        @if ($paginator->onFirstPage())
            <span class="pagination-img disabled">
                <img class="arrow" src="{{ asset('img/arrow_left.png') }}" alt="Назад">
            </span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="pagination-img">
                <img class="arrow" src="{{ asset('img/arrow_left.png') }}" alt="Назад">
            </a>
        @endif

        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="pagination-dots">{{ $element }}</span>
            @endif

            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pagination-link active">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="pagination-link">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="pagination-img">
                <img class="arrow" src="{{ asset('img/arrow_right.png') }}" alt="Вперёд">
            </a>
        @else
            <span class="pagination-img disabled">
                <img class="arrow" src="{{ asset('img/arrow_right.png') }}" alt="Вперёд">
            </span>
        @endif
    </div>
@endif