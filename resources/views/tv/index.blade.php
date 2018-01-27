@extends('layouts/app', [
    'wide' => true,
    'meta' => [
        'title' => 'Tool TV',
        'description' => 'Watch live Tool 24/7 here!',
        'keywords' => 'tool, tool band, tool live, tool tv, tool live stream'
    ]
])

@section('content')

<?php $video = array_get($tv, 'current.video'); ?>

<div class="container-fluid video-layout">

    <div class="row">
        <div class="col-xs-12">
            <h3>Tool TV</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-9">
            <div class="video-wrapper">
                <div class="video-container">
                    @include('components.ytVideo', [
                        'width' => '960',
                        'height' => '540',
                        'videoId' => array_get($video, 'youtube_video_id'),
                        'showControls' => false
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
                <h4>Currently Playing</h4>
                @include('tv.partials.videoCard', [
                    'video' => array_get($tv, 'current.video')
                ])
                <h4>Up Next</h4>
                @foreach(array_get($tv, 'upNext.data') as $upNext)
                    @include('tv.partials.videoCard', [
                        'video' => array_get($upNext, 'video')
                    ])
                @endforeach
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div class="related-videos-wrapper">

                <div class="related-videos">

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
