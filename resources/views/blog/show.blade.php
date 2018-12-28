@extends('layouts/app', [
    'meta' => [
        'title' => 'Blog',
        'description' => 'Check out this awesome blog covering Tool!',
        'keywords' => 'tool blog, tool band blog, tool news, tool rumours'
    ]
])

@section('js')

@endsection

@section('content')
<div class="container-fluid post-layout">

    <div class="blog-post">
        <h1>{{ array_get($post, 'title') }}</h1>

        <div>{!! html_entity_decode(array_get($post, 'content')) !!}</div>
    </div>
</div>
@endsection
