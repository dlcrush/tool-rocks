@extends('layouts/app', [
    'wide' => true,
    'meta' => [
        'title' => 'Daily Fix',
        'description' => 'Get your Daily Fix of your favorite Live Tool videos here! New playlists generated daily!',
        'keywords' => 'tool, tool band, tool live, tool tv, tool live stream, tool daily fix, tool playlist, tool live playlist, tool live daily fix'
    ]
])

@section('content')

<?php $video = $videos[0] ?>

<div class="container-fluid video-layout">

    <div class="row">
        <div class="col-xs-12">
            <h3><i class="fa fa-fire"></i> Daily Fix</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-9">
            <div class="video-wrapper">
                <div class="video-container">
                    @include('components.ytVideo', [
                        'width' => '960',
                        'height' => '540',
                        'videoId' => array_get($video, 'youtube_video_id')
                    ])
                </div>
            </div>
            <h3>Comments</h3>
            <div class="comments">
                <div class="fb-comments" data-href="{{ url()->current() }}" data-width="1024" data-numposts="5" data-colorscheme="dark" style="margin: 0 auto;"></div>
            </div>
        </div>
        <div class="video-info-wrapper col-xs-12 col-sm-12 col-md-3">
            <div class="content">
                <div class="row">
                    <h4>Currently Playing</h4>
                    @include('dailyfix.partials.videoCard', [
                        'video' => $video,
                        'current' => true
                    ])
                </div>
                <div class="row">
                    <h4>Up Next</h4>
                    @foreach(array_slice($videos, 1) as $i => $upNext)
                        @include('dailyfix.partials.videoCard', [
                            'video' => $upNext,
                            'hidden' => $i > 1
                        ])
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        var videos = <?php echo json_encode(array_slice($videos, 1)) ?>;

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
            if (event.data === 0) {
                console.log('video finished');
                loadNextVideo();
            }
        }

        function loadNextVideo() {
            if (videos.length <= 0) {
                return;
            }

            var video = videos[0];
            var videoId = video.youtube_video_id;

            player.loadVideoById(videoId);
            refreshSidebar();

            videos.shift();
        }

        function refreshSidebar() {
            var newCurrent = $('#video-' + videos[0].id);
            newCurrent.addClass('current');
            newCurrent.find('div.hidden').removeClass('hidden');
            $('a.current').html(newCurrent.html());

            newCurrent.remove();
            if (videos.length >= 3) {
                var videoId = videos[2].id;
                $('#video-' + videoId).find('div.related-video').removeClass('hidden');
            }
        }
    </script>
@endsection
