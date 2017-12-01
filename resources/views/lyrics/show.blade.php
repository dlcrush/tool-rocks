@extends('layouts/app', ['wide' => false])

@section('content')

<div class="container-fluid lyric-layout">
    <div class="header" style="margin-top: 15px; margin-bottom: 15px;">
        <!-- <img src="http://fakeimg.pl/1024x200/?text=Lyrics" class="img-responsive"> -->
        <img src="/img/concert.jpg" class="img-responsive">
        <div class="text">Lyrics</div>
    </div>

    <div class="lyrics-container row col-xs-12">
        <div class="lyrics-content" style="max-width: 500px; text-align: left; display: inline-block; float: left;">
            <h2>Prison Sex</h2>
            <p>
                It took so long to remember just what happened.<br>
                I was so young and vestal then, you know it hurt me, but I'm breathing so I guess I'm still alive even if signs seem to tell me otherwise.<br>
                I've got my hands bound, my head down, my eyes closed, and my throat wide open.<br>
                Do unto others what has been done to you.<br>
                I'm treading water, I need to sleep a while.<br>
                My lamb and martyr, you look so precious.<br>
                Won't you come a bit closer, close enough so I can smell you.<br>
                I need you to feel this, I can't stand to burn too long.<br>
                Released in this sodomy.<br>
                For one sweet moment I am whole.<br>
                Do unto you now what has been done to me.<br>
                You're breathing so I guess you're still alive even if signs seem to tell me otherwise.<br>
                Won't you come just a bit closer, close enough so I can smell you.<br>
                I need you to feel this.<br>
                I need this to make me whole.<br>
                There's release in this sodomy.<br>
                For I am your witness that blood and flesh can be trusted.<br>
                And only this one holy medium brings me piece of mind.<br>
                Got your hands bound, your head down, your eyes closed.<br>
                You look so precious now.<br>
                I have found some kind of temporary sanity in this shit blood and cum on my hands.<br>
                I've come round full circle.<br>
                My lamb and martyr, this will be over soon.<br>
                You look so precious.
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
        <div class="fb-comments" data-href="http://toolrocks.dev/lyrics/song/prison-sex" data-width="1200" data-numposts="5" data-colorscheme="dark" style="margin: 0 auto;"></div>
    </div>
</div>
@endsection
