@if ($paginator->hasPages())
    <?php
        $pages = 3;
        $current = $paginator->currentPage();
        $pagesStart = max(1, $current - $pages);
        $pagesEnd = min($current + $pages * 2, $paginator->lastPage());
    ?>

    <div class="paginator table-paginator">
        @for ($i = $pagesStart; $i <= $pagesEnd; $i++)
            <a href="{{ $paginator->url($i) }}" class="paginator-page @if($i == $current) paginator-current @endif">{{$i}}</a>
        @endfor
    </div>
@endif
