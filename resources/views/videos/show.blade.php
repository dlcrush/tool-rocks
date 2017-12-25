@extends('layouts/app', ['wide' => true])

@section('content')

<style>

</style>

<div class="container-fluid video-layout">

    <h3>{{ array_get($video, 'name') }}</h3>

    <div class="video-wrapper">
        <div class="video-container">
             <iframe class="video" width="960" height="540" src="https://www.youtube.com/embed/{{ array_get($video, 'youtube_video_id') }}" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <div class="video-info-wrapper">
        <div class="content">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#">Description</a>
                </li>
                @if(count(array_get($video, 'songs.data')) > 1)
                    <li class="nav-item">
                        <a class="nav-link" href="#">Set list</a>
                    </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="#">Lyrics</a>
                </li>
            </ul>
            <div class="content-wrapper" style="max-height: 550px; overflow-y: scroll;">
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
                    <div class="description-wrapping" style="width: 300px; margin-left: auto; margin-right: auto;">
                        <p>
                            {!! nl2br(array_get($video, 'description')) !!}
                        </p>
                    </div>
                </div>
                <div id="video-lyrics" style="display: none;">
                    This be where the lyrics would go.
                </div>
            </div>
        </div>
    </div>
    <div class="related-videos-wrapper">
        <h3>You May Also Like</h3>

        <div class="row related-videos">
            @foreach(array_get($video, 'related.data') as $i => $x)
                <?php if (++$i > 4) { break; } ?>
                <a href="{{ array_get($x, 'links.web') }}" style="color: white">
                    <div class="related-video col-xs-12 col-sm-4 col-md-3 col-lg-2">
                        <img src="{{ array_get($x, 'images.high.url') }}" class="img-responsive" style="max-width: 240px; width: 100%;">
                        <div class="related-video-info" style="background-color: #131313; max-width: 240px;">
                            <div style="padding: 20px;">
                                <h5>{{ array_get($x, 'name') }}</h5>
                                <?php /*<p>{{ array_get($x, 'description') }}</p>*/ ?>
                            </div>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <h3>Comments</h3>
        <div class="comments">
            <div class="fb-comments" data-href="{{ url()->current() }}" data-width="1024" data-numposts="5" data-colorscheme="dark" style="margin: 0 auto;"></div>
        </div>
    </div>
</div>

<script>
window.onload = function() {
    // $('.related-videos').slick({
    //     infinite: true,
    //     slidesToShow: 3,
    //     slidesToScroll: 3
    // });
};
</script>
@endsection
