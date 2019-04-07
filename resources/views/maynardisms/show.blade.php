@extends('layouts/app', [
    'meta' => [
        'title' => 'Maynardism',
        'description' => array_get($maynardism, 'content'),
        'keywords' => 'tool, tool band, tool maynardisms, maynard james keenan, maynard james keenan quotes, maynard, maynard quotes, tool maynardisms, tool maynardism'
    ]
])

@section('content')
<div class="container-fluid maynardism-layout">
    <div class="row">
        <div class="col-xs-12">
            @include('components.prettyHeader', ['text' => 'Maynardisms'])
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            @include("components.backTo", [
                'url' => action('MaynardismController@getMaynardisms'),
                'text' => 'Back to All Maynardisms'
            ])
        </div>
    </div>

    <div class="maynardism-full-card" style="margin-top: 10px;">
        <div class="row">
            <div class="col-xs-12">
                <div class="jumbotron">
                    <h1>&ldquo;{{ array_get($maynardism, 'content') }}&rdquo;</h1>
                    <center>
                        @include('components.ytVideo', [
                            'width' => '560',
                            'height' => '315',
                            'videoId' => array_get($maynardism, 'video.youtube_video_id')
                        ])
                        <a href="{{ action('VideoController@getVideo', [ 'id' => array_get($maynardism, 'video.id'), 'slug' => array_get($maynardism, 'video.slug') ] ) }}" class="btn btn-default">Full Video</a>
                    </center>
                </div>
            </div>
        </div>
    </div>

    @include('components.fbComments')
</div>
@endsection
