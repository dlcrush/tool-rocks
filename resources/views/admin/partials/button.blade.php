<?php
    $classes = ['btn'];
    $icon = '';

    if (isset($full_width) && $full_width === true) {
        array_push($classes, 'btn-block');
    }
    if (isset($size)) {
        if ($size == 'large') {
            array_push($classes, 'btn-lg');
        } else if ($size == 'small') {
            array_push($classes, 'btn-sm');
        }
    }
    if (isset($float)) {
        if ($float == 'right') {
            array_push($classes, 'pull-right');
        } else if ($float == 'left') {
            array_push($classes, 'pull-left');
        }
    }
    if ($type == 'edit') {
        array_push($classes, 'btn-warning');
        $icon = 'fa fa-edit';
    } else if ($type == 'delete') {
        array_push($classes, 'btn-danger');
        $icon = 'fa fa-trash';
    } else if ($type == 'create') {
        array_push($classes, 'btn-success');
        $icon = 'fa fa-plus';
    }
 ?>

<a
    href="{{ $href }}"
    class="{{ implode(" ", $classes) }}"
>
    @if($icon != '')
        <i class="{{ $icon }}"></i>
    @endif
    {{ $text }}
</a>
