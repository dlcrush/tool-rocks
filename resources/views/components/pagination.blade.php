<?php

    $request = request();
    $params = $request->except(['page']);
    $currentPage = array_get($pagination, 'current_page');
    $totalPages = array_get($pagination, 'total_pages');

    $baseUrl = url()->current() . '?';

?>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        @if($currentPage - 1 > 0)
            <li class="page-item"><a class="page-link" href="{{ $baseUrl . http_build_query($params + ['page' => $currentPage - 1]) }}">Previous</a></li>
        @endif
        @for($i = 1; $i <= $totalPages; $i ++)
            <li class="page-item"><a class="page-link" href="{{ $baseUrl . http_build_query($params + ['page' => $i]) }}">{{ $i }}</a></li>
        @endfor
        @if($currentPage + 1 <= $totalPages)
            <li class="page-item"><a class="page-link" href="{{ $baseUrl . http_build_query($params + ['page' => $currentPage + 1]) }}">Next</a></li>
        @endif
    </ul>
</nav>
