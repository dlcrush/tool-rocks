@extends('layouts/app', ['wide' => false])

@section('content')

<div class="container-fluid lyric-layout">
    @include('components.prettyHeader', ['text'=> 'Lyrics'])

    <div class="lyrics-container row col-xs-12">
        <div class="lyrics-content col-xs-12 col-sm-12 col-md-6" style="text-align: left; display: inline-block; float: left;">
            <h1>{{ array_get($song, 'name') }}</h1>
            <p>
                @if (array_get($song, 'has_lyrics'))
                    {!! nl2br(array_get($song, 'lyrics.body')) !!}
                @else
                    No lyrics.
                @endif
            </p>
        </div>
        <div class="lyrics-video col-xs-12 col-sm-12 col-md-6" style="display: inline-block; max-width: 560px; float: right;">
            @if(array_get($song, 'lyrics.youtube_video_id') != null)
                <div class="video-wrapper">
                    <div class="video-container">
                        @include('components.ytVideo', [
                            'width' => '560',
                            'height' => '315',
                            'videoId' => array_get($song, 'lyrics.youtube_video_id')
                        ])
                    </div>
                </div>
            @endif

            <p>
                <h4 style="text-align: center">Appears On:</h4>
                @foreach(array_get($song, 'albums.data', []) as $album)
                    <div class="album-card">
                        <div class="album-card-content" style="margin-right: auto; margin-left: auto;">
                            <center>
                                <img src="/img/tool-{{ array_get($album, 'slug') }}-500x500.jpg" class="img-responsive" style="max-width: 200px;">
                                <ul class="list-unstyled">
                                    <li>{{ array_get($album, 'name') }}</li>
                                    <li>Released: {{ Carbon\Carbon::parse(array_get($album, 'released'))->format('Y') }}</li>
                                </ul>
                            </center>
                        </div>
                    </div>
                @endforeach
            </p>
        </div>
    </div>
    <center><h3>Comments</h3></center>
    <div class="comments">
        <div class="fb-comments" data-href="{{ url()->current() }}" data-width="1200" data-numposts="5" data-colorscheme="dark" style="margin: 0 auto;"></div>
    </div>
</div>
@endsection
