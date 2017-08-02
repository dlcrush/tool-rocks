<?php
    $classes = ['btn'];

    if (isset($full_width) && $full_width === true) {
        array_push($classes, 'btn-block');
    }
    if ($type == 'edit') {
        array_push($classes, 'btn-warning');
    } else if ($type == 'delete') {
        array_push($classes, 'btn-danger');
    }
 ?>

<a
    href="{{ $href }}"
    class="{{ implode(" ", $classes) }}"
>
    {{ $text }}
</a>
