@extends('layouts/app', [
    'meta' => [
        'title' => 'Blog',
        'description' => 'Check out this awesome blog covering Tool!',
        'keywords' => 'tool blog, tool band blog, tool news, tool rumours',
        'url' => action('BlogController@getPosts')
    ]
])

@section('js')

@endsection

@section('content')
<div class="container-fluid blog-layout">
    <div class="row">
        <div class="col-xs-12">
            @include('components.prettyHeader', ['text' => 'Blog'])
        </div>
    </div>

    <div class="posts-collection">
        @forelse(array_get($posts, 'data') as $post)
            <div class="row">
                <div class="col-xs-12">
                    <a href="/blog/post/{{ array_get($post, 'id') }}/{{ array_get($post, 'slug') }}">
                        <div class="post-card">
                            <div class="post-card-image col-xs-12 col-sm-4">
                                <div class="post-card-image-wrapper">
                                    @if(false && array_get($post, 'image') != null)
                                        <center><img src="{{ array_get($post, 'image') }}" class="img-responsive" /></center>
                                    @else
                                        <center><img src="/img/sacred-geometry.svg" class="img-responsive" /></center>
                                    @endif
                                </div>
                            </div>
                            <div class="post-card-text col-xs-12 col-sm-8">
                                <h3>{{ array_get($post, 'title') }}</h3>
                                <p>{!! array_get($post, 'excerpt') !!}</p>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="row">
                <div class="col-xs-12">
                    <p>Sorry, nothing matches your criteria. Try again.</p>
                </div>
            </div>
        @endforelse
        @if(array_get($posts, 'meta.pagination.total_pages', 1) > 1)
            <div class="row">
                <div class="col-xs-12">
                    @include('components.pagination', ['pagination' => array_get($posts, 'meta.pagination')])
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
