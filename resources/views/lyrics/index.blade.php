@extends('layouts/app', ['wide' => false])

@section('content')
<div class="container-fluid lyrics-layout">
    @include('components.prettyHeader', ['text' => 'Lyrics'])

    <div class="lyrics-collection">
        <div class="row">
            <?php $i = 0; ?>
            @foreach($albums as $album)
                <?php
                    $class = '';
                    if ($i % 3 === 0) {
                        $class = 'left';
                    } else if ($i % 3 === 1) {
                        $class = 'middle';
                    } else if ($i % 3 === 2) {
                        $class = 'right';
                    }
                ?>

                <div class="lyric-card col-xs-12 col-sm-6 col-md-4 {{ $class }}">
                    <div class="lyric-card-inner">
                        <img src="/img/tool-{{ array_get($album, 'slug') }}-500x500.jpg" class="img-responsive">
                        <ul class="lyric-songs-list list-unstyled">
                            @foreach(array_get($album, 'songs.data') as $song)
                                <li>
                                    @if(array_get($song, 'has_lyrics'))
                                        <a href="{{ Action('LyricController@getLyric', ['songId' => array_get($song, 'slug')]) }}">
                                    @endif
                                        {{ array_get($song, 'name') }}
                                    @if(array_get($song, 'has_lyrics'))
                                        </a>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="clearfix visible-xs"></div>
                @if(($i+1) % 2 === 0)
                    <div class="clearfix visible-sm"></div>
                @endif
                @if(($i+1) % 3 === 0)
                    <div class="clearfix visible-md visible-lg"></div>
                @endif
                <?php $i++ ?>
            @endforeach
        </div>
    </div>
</div>
@endsection
