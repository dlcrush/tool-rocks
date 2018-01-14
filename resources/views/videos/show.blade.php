@extends('layouts/app', [
    'wide' => true,
    'meta' => [
        'title' => array_get($video, 'name'),
        'description' => array_get($video, 'description'),
        'keywords' => 'tool, tool band',
        'og.image' => array_get($video, 'images.standard.url'),
        'og.description' => "Check out this awesome performance of Tool!",
        'og.title' => array_get($video, 'name')
    ]
])

@section('content')

<div class="container-fluid video-layout">

    <h3>{{ array_get($video, 'name') }}</h3>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8">
            <div class="video-wrapper">
                <div class="video-container">
                    @include('components.ytVideo', [
                        'width' => '960',
                        'height' => '540',
                        'videoId' => array_get($video, 'youtube_video_id')
                    ])
                </div>
            </div>
        </div>
        <div class="video-info-wrapper col-xs-12 col-sm-12 col-md-4">
            <div class="content">
                <ul class="nav nav-tabs">
                    <li class="nav-item" data-tab-id="video-youtube-info">
                        <a class="nav-link active" href="#">Description</a>
                    </li>
                    @if(count(array_get($video, 'songs.data')) > 1)
                        <li class="nav-item" data-tab-id="video-setlist">
                            <a class="nav-link" href="#">Set list</a>
                        </li>
                    @endif
                    <li class="nav-item" data-tab-id="video-lyrics">
                        <a class="nav-link" href="#">Lyrics</a>
                    </li>
                </ul>
                <div class="content-wrapper">
                    <div id="video-youtube-info">
                        <a href="https://youtube.com/channel/UCRUq9jueekA0t4uz_z5LZmA">
                            <center><img style="margin-top: 15px; max-height: 120px;" class="img-responsive" src="{{ array_get($video, 'channel.images.high.url') }}"></img></center>
                        </a>
                        <p style="margin-top: 10px; text-align: center;"> Uploaded By: <a href="#"> &nbsp; {{ array_get($video, 'channel.name') }}</a></p>
                        <p style="text-align: center">
                            <i class="fa fa-eye"></i> <span class="stat">{{ array_get($video, 'views') }}</span>
                            <i class="fa fa-thumbs-up"></i> <span class="stat">{{ array_get($video, 'thumbsUp') }}</span>
                            <i class="fa fa-thumbs-down"></i> <span class="stat">{{ array_get($video, 'thumbsDown') }}</span>
                        </p>
                        <div class="description-wrapping">
                            <p>
                                {!! nl2br(array_get($video, 'description')) !!}
                            </p>
                        </div>
                    </div>
                    <div id="video-lyrics" style="display: none;">
                        @foreach(array_get($video, 'songs.data') as $song)
                            <div id="video-lyrics-song-{{ array_get($song, 'slug') }}">
                                <h4>{{ array_get($song, 'name') }}</h4>
                                @if(array_get($song, 'has_lyrics', false))
                                    <p>{!! nl2br(array_get($song, 'lyrics.body')) !!}</p>
                                @else
                                    <p>No lyrics.</p>
                                @endif
                            </div>
                            @if( ! $loop->last )
                                <hr>
                            @endif
                        @endforeach
                    </div>
                    <div id="video-setlist" style="display: none;">
                        <div class="row">
                            <div class="col-xs-12 col-lg-10 col-lg-offset-1">
                                <table class="table table-condensed borderless">
                                    <tbody>
                                        <?php $count = 1 ?>
                                        @foreach(array_get($video, 'songs.data') as $song)
                                            <tr>
                                                <td>{{ $count . '.' }}</td>
                                                <td>{{ array_get($song, 'name') }}</td>
                                                <td><a class="video-jump-to-time" href="#" data-timestamp="{{ array_get($song, 'start_time') }}">{{ array_get($song, 'start_time') }}</a></td>
                                                <td><a class="video-jump-to-lyrics" href="#" data-song="{{ array_get($song, 'slug') }}">Lyrics</a></td>
                                            </tr>
                                            <?php $count = $count + 1 ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="related-videos-wrapper">
                <h3>You May Also Like</h3>

                <div class="related-videos">
                    @foreach(array_get($video, 'related.data') as $i => $x)
                        <?php //if (++$i > 4) { break; } ?>
                        <a href="{{ array_get($x, 'links.web') }}" style="color: white">
                            <div class="related-video col-xs-12 col-sm-4 col-md-3 col-lg-2">
                                <img src="{{ array_get($x, 'images.high.url') }}" class="img-responsive" style="max-width: 240px; width: 100%;">
                                <div class="related-video-info" style="background-color: #131313; max-width: 240px;">
                                    <div style="padding: 20px;">
                                        <h5>{{ array_get($x, 'name') }}</h5>
                                    </div>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h3>Comments</h3>
            <div class="comments">
                <div class="fb-comments" data-href="{{ url()->current() }}" data-width="1024" data-numposts="5" data-colorscheme="dark" style="margin: 0 auto;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        var tag = document.createElement('script');
        //tag.id = 'iframe-demo';
        tag.src = 'https://www.youtube.com/iframe_api';
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

        var player;
        function onYouTubeIframeAPIReady() {
            player = new YT.Player('video', {
                events: {
                    'onReady': onPlayerReady,
                    'onStateChange': onPlayerStateChange
                }
            });
        }

        function onPlayerReady(event) {
            console.log('onPlayerReady', event);
        }

        function onPlayerStateChange(event) {
            console.log('onStateChange', event);
        }

        function loadTab(id) {
            $('.video-info-wrapper .content-wrapper').children().hide();
            $('.video-info-wrapper .content-wrapper #' + id).show();
        }

        $('.video-jump-to-time').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            var timestamp = $(this).data('timestamp');
            var times = timestamp.split(':');

            if (times.length == 1) {
                var seconds = parseInt(times[0]);
            } else if (times.length == 2) {
                var seconds = parseInt(times[1]);
                seconds += parseInt(times[0]) * 60;
            } else if (times.length == 3) {
                var seconds = parseInt(times[2]);
                seconds += parseInt(times[1]) * 60;
                seconds += parseInt(times[0]) * 60 * 60;
            }

            player.seekTo(seconds);
        });
        $('.video-jump-to-lyrics').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            loadTab('video-lyrics');
            var song = $(this).data('song');
            console.log('song', song);
            document.getElementById('video-lyrics-song-' + $(this).data('song')).scrollIntoView(false);
            //$('#video-lyrics-' + $(this).data('song')).scrollIntoView(true);
        });

        $('.video-info-wrapper .nav-tabs .nav-item').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            // load tab
            var tabId = $(this).data('tab-id');
            loadTab(tabId);

            // change active tab
            $('.video-info-wrapper .nav-tabs .nav-item .nav-link').removeClass('active');
            $(this).children('.nav-link').addClass('active');
        });
    </script>
@endsection
