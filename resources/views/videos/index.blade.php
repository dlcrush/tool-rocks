@extends('layouts/app')

@section('content')
<div class="container-fluid videos-layout">
    <div class="row">
        <div class="col-xs-12">
            <div class="header" style="margin-top: 15px; margin-bottom: 15px;">
                <img src="/img/concert.jpg" class="img-responsive">
                <div class="text">Videos</div>
            </div>
        </div>
    </div>

    <div class="videos-collection">
        @foreach(array_get($videos, 'data') as $video)
            <div class="row">
                <div class="col-xs-12">
                    <a href="/videos/{{ array_get($video, 'id') }}/{{ array_get($video, 'slug') }}">
                        <div class="video-card">
                            <div class="video-card-image col-xs-12 col-sm-4">
                                <img src="{{ array_get($video, 'images.medium.url') }}" class="img-responsive">
                            </div>
                            <div class="video-card-text col-xs-12 col-sm-8">
                                <h3>{{ array_get($video, 'name') }}</h3>
                                <p>{{ mb_strimwidth(array_get($video, 'description'), 0, 250, "...") }}</p>
                                <div class="video-card-tags">
                                    @foreach(array_get($video, 'tags.data') as $tag)
                                        <span class="label label-primary">{{ array_get($tag, 'name') }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
