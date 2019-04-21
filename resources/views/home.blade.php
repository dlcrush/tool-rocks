@extends('layouts/app', [
    'meta' => [
        'title' => 'Home',
        'description' => "Visit ToolRocks.com to get the latest news, commentary, videos, lyrics, and all other information related to Tool",
        'keywords' => 'toolrocks.com, tool band news, tool news, tool band commentary, tool commentary, tool videos, tool band videos, tool lyrics, tool band lyrics, tool band info, tool info, tool information, tool band information'
    ]
])

@section('content')
    <div class="home-layout" style="max-width: 1000px; margin-right: auto; margin-left: auto;">
        <div class="row">
            <div class="col-xs-12">
                <h1>{{ array_get($data, 'welcome.title') }}</h1>

                <div class="welcome-content">
                    {!! html_entity_decode(array_get($data, 'welcome.content')) !!}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h3>Latest Video Uploads</h3>
                <div class="row">
                    @foreach(array_get($data, 'latestVideos.data') as $video)
                        <a href="{{ array_get($video, 'links.web') }}" style="color: white">
                            <div class="related-video col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                <img src="{{ array_get($video, 'images.high.url') }}" class="img-responsive">
                                <div class="related-video-info">
                                    <div style="padding: 20px;">
                                        <h5 style="max-height: 15px">{{ array_get($video, 'name') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
                <p style="margin-top: 10px;"><a href="/videos" class="btn btn-default">View All Videos</a></p>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <h3>Latest News</h3>
                @foreach(array_get($data, 'latestNews.data') as $post)
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
                @endforeach
                <a href="/blog" class="btn btn-default">View All Posts</a>
            </div>
        </div>
    </div>
@endsection
