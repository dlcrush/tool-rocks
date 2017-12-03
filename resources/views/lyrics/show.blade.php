@extends('layouts/app', ['wide' => false])

@section('content')

<div class="container-fluid lyric-layout">
    <div class="header" style="margin-top: 15px; margin-bottom: 15px;">
        <img src="/img/concert.jpg" class="img-responsive">
        <div class="text">Lyrics</div>
    </div>

    <div class="lyrics-container row col-xs-12">
        <div class="lyrics-content" style="max-width: 500px; text-align: left; display: inline-block; float: left;">
            <h1>{{ array_get($song, 'name') }}</h1>
            <p>
                @if (array_get($song, 'has_lyrics'))
                    {!! nl2br(array_get($song, 'lyrics.body')) !!}
                @else
                    No lyrics.
                @endif
            </p>
        </div>
        <div class="lyrics-video" style="display: inline-block; max-width: 560px; float: right;">
            <iframe class="video" width="560" height="315" src="https://www.youtube.com/embed/-eYb5f1LqZ0" frameborder="0" allowfullscreen></iframe>
            <p>
                <h4>Song Info</h4>
                <ul class="list-unstyled">
                    <li>Runtime: 4:56</li>
                    <li>Released: 1993</li>
                    <li>Album: Undertow</li>
                </ul>
            </p>
        </div>
    </div>
    <center><h3>Comments</h3></center>
    <div class="comments">
        <div class="fb-comments" data-href="{{ url()->current() }}" data-width="1200" data-numposts="5" data-colorscheme="dark" style="margin: 0 auto;"></div>
    </div>
</div>
@endsection
