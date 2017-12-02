@extends('layouts/app', ['wide' => false])

@section('content')
<div class="container-fluid lyrics-layout">
    <div class="header" style="margin-top: 15px; margin-bottom: 15px;">
        <img src="/img/concert.jpg" class="img-responsive">
        <div class="text">Lyrics</div>
    </div>

    <div class="lyrics-collection">
        @foreach(array_chunk($albums, 3) as $albumsChunk)
            <div class="row">
                @foreach($albumsChunk as $i => $album)
                    <?php
                        $class = '';
                        if ($i === 0) {
                            $class = 'left';
                        } else if ($i == 1) {
                            $class = 'middle';
                        } else if ($i == 2) {
                            $class = 'right';
                        }
                    ?>
                    <div class="lyric-card col-xs-12 col-sm-6 col-md-4 {{ $class }}">
                        <div class="lyric-card-inner">
                            <img src="/img/tool-{{ array_get($album, 'slug') }}-500x500.jpg" class="img-responsive">
                            <ul class="lyric-songs-list list-unstyled">
                                @foreach(array_get($album, 'songs.data') as $song)
                                    <li><a href="{{ Action('LyricController@getLyric', ['songId' => array_get($song, 'slug')]) }}">{{ array_get($song, 'name') }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
@endsection
