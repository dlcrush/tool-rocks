<?php

$title = '';
$description = '';
$keywords = '';

$slug = array_get($page, 'slug');

if ($slug === 'about') {
    $title = 'About';
    $description = 'Learn more information about ToolRocks.com.';
    $keywords = 'toolrocks, tool rocks, toolrocks.com, toolrocks about, tool rocks about';
} else if ($slug === 'links') {
    $title = 'Links';
    $description = 'Check out these awesome links to other great Tool sites.';
    $keywords = 'tool links, tool band links, tool rocks links';
}

?>

@extends('layouts/app', [
    'meta' => [
        'title' => $title,
        'description' => $description,
        'keywords' => $keywords,
        'url' => url()->current()
    ]
])

@section('js')

@endsection

@section('content')
<div class="container-fluid post-layout">

    <div class="blog-post">
        <h1>{{ array_get($page, 'title') }}</h1>

        <div>{!! html_entity_decode(array_get($page, 'content')) !!}</div>

        @include('components.fbComments', ['width' => 800, 'url' => url()->current()])
    </div>
</div>
@endsection
