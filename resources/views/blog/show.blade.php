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
        <div class="row">
            <div class="col-xs-12">
                @include("components.backTo", [
                    'url' => action('BlogController@getPosts'),
                    'text' => 'Back to All Posts'
                ])
            </div>
        </div>

        <h1>{{ array_get($post, 'title') }}</h1>

        <div>{!! html_entity_decode(array_get($post, 'content')) !!}</div>

        @include('components.fbComments', ['width' => 800])
    </div>
</div>
@endsection
