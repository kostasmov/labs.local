@if ($paginator->hasPages())
    <div class="pagination-info">
        <p>Всего записей: {{ $paginator->total() }}</p>
        <p>Страницы:

{{--        <ul class="pagination">--}}
            {{-- Пагинация страниц --}}
            @foreach ($elements as $element)
                {{-- Массив страниц --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span>{{ $page }}</span>
                        @else
                            <a href="{{ $url }}">{{ $page }}</a>
                        @endif
                    @endforeach
                @endif
            @endforeach
{{--        </ul>--}}
        </p>
    </div>
@endif
