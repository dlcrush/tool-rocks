@extends('layouts/app', ['wide' => false])

@section('content')

<style>
    // .lyric-card {
    //     margin-bottom: 15px;
    //     display: inline-block;
    //     //max-width: 280px;
    // }

    // .lyric-card.left {
    //     float: left;
    // }

    // .lyric-card.right {
    //     float: right;
    // }

    // .lyrics-collection {
    //     width: 100%;
    // }

    // .lyric-card img {
    //     //max-width: 100px;
    // }

    // .lyric-songs-list {
    //     list-style: none;
    //     margin-top: 15px;
    // }

    // .lyric-card .lyric-card-inner {
    //     max-width: 300px;
    //     width: 100%;
    //     text-align: center;
    // }

    // .lyric-card.middle .lyric-card-inner {
    //     margin-right: auto;
    //     margin-left: auto;
    // }

    // .lyric-card.right .lyric-card-inner {
    //     float: right;
    // }

    // .lyric-card.left .lyric-card-inner {
    //     float: left;
    // }

    // .header {
    //     position: relative;
    // }

    // .header img {
    //     //opacity: 0.9;
    // }

    // .header .text {
    //     position: absolute;
    //     top: 30%;
    //     left: 40%;
    //     max-width: 400px;
    //     margin-right: auto;
    //     margin-left: auto;
    //     color: white;
    //     font-size: 36px;
    //     background-color: black;
    //     padding-left: 50px;
    //     padding-right: 50px;
    //     padding-top: 25px;
    //     padding-bottom: 25px;
    //     background-color:rgba(0, 0, 0, 0.8)
    // }

    // a {
    //     color: #fff;
    // }
</style>

<div class="container-fluid lyrics-layout">
    <div class="header" style="margin-top: 15px; margin-bottom: 15px;">
        <!-- <img src="http://fakeimg.pl/1024x200/?text=Lyrics" class="img-responsive"> -->
        <img src="/img/concert.jpg" class="img-responsive">
        <div class="text">Lyrics</div>
    </div>

    <div class="lyrics-collection">
        <div class="row">
            <div class="lyric-card col-xs-12 col-sm-6 col-md-4 left">
                <div class="lyric-card-inner">
                    <img src="/img/tool-opiate-500x500.jpg" class="img-responsive">
                    <ul class="lyric-songs-list list-unstyled">
                        <li><a href="#">Sweat</a></li>
                        <li><a href="#">Hush</a></li>
                        <li><a href="#">Part of Me</a></li>
                        <li><a href="#">Cold and Ugly</a></li>
                        <li><a href="#">Jerk-Off</a></li>
                        <li><a href="#">Opiate</a></li>
                        <li><a href="#">The Gaping Lotus Experience</a></li>
                    </ul>
                </div>
            </div>

            <div class="clearfix visible-xs-block"></div>

            <div class="lyric-card col-xs-12 col-sm-6 col-md-4 middle">
                <div class="lyric-card-inner">
                    <img src="/img/tool-undertow-500x500.jpg" class="img-responsive">
                    <ul class="lyric-songs-list list-unstyled">
                        <li><a href="#">Intolerance</a></li>
                        <li><a href="/lyrics/song/prison-sex">Prison Sex</a></li>
                        <li><a href="#">Sober</a></li>
                        <li><a href="#">Bottom</a></li>
                        <li><a href="#">Crawl Away</a></li>
                        <li><a href="#">Swamp Song</a></li>
                        <li><a href="#">Undertow</a></li>
                        <li><a href="#">4 Degrees</a></li>
                        <li><a href="#">Flood</a></li>
                        <li><a href="#">Disgustipated</a></li>
                    </ul>
                </div>
            </div>

            <div class="clearfix visible-xs-block visible-sm-block"></div>

            <div class="lyric-card col-xs-12 col-sm-6 col-md-4 right">
                <div class="lyric-card-inner">
                    <img src="/img/tool-aenima-500x500.jpg" class="img-responsive">
                    <ul class="lyric-songs-list list-unstyled">
                        <li><a href="#">Stinkfist</a></li>
                        <li><a href="#">Eulogy</a></li>
                        <li><a href="#">H.</a></li>
                        <li><a href="#">Useful Idiot</a></li>
                        <li><a href="#">Forty-Six & Two</a></li>
                        <li><a href="#">Message to Harry Manback</a></li>
                        <li><a href="#">Hooker with a Penis</a></li>
                        <li><a href="#">Intermission</a></li>
                        <li><a href="#">Jimmy</a></li>
                        <li><a href="#">Die Eier Von Satan</a></li>
                        <li><a href="#">Pushit</a></li>
                        <li><a href="#">Cesaro Summability</a></li>
                        <li><a href="#">Aenema</a></li>
                        <li><a href="#">(-) Ions</a></li>
                        <li><a href="#">Third Eye</a></li>
                    </ul>
                </div>
            </div>

            <div class="clearfix visible-md-block"></div>
        </div>

        <div class="row">
            <div class="lyric-card col-xs-12 col-sm-6 col-md-4 left">
                <div class="lyric-card-inner">
                    <img src="/img/tool-salival-500x500.jpg" class="img-responsive">
                    <ul class="lyric-songs-list list-unstyled">
                        <li><a href="#">Third Eye</a></li>
                        <li><a href="#">Part of Me</a></li>
                        <li><a href="#">Pushit</a></li>
                        <li><a href="#">Message to Harry Manback II</a></li>
                        <li><a href="#">Merkaba</a></li>
                        <li><a href="#">You Lied</a></li>
                        <li><a href="#">No Quarter</a></li>
                        <li><a href="#">L.A.M.C.</a></li>
                        <li><a href="#">Maynard's Dick</a></li>
                    </ul>
                </div>
            </div>

            <div class="clearfix visible-xs-block"></div>

            <div class="lyric-card col-xs-12 col-sm-6 col-md-4 middle">
                <div class="lyric-card-inner">
                    <img src="/img/tool-lateralus-500x500.jpg" class="img-responsive">
                    <ul class="lyric-songs-list list-unstyled">
                        <li><a href="#">The Grudge</a></li>
                        <li><a href="#">Eon Blue Apocalypse</a></li>
                        <li><a href="#">The Patient</a></li>
                        <li><a href="#">Mantra</a></li>
                        <li><a href="#">Schism</a></li>
                        <li><a href="#">Parabol</a></li>
                        <li><a href="#">Parabola</a></li>
                        <li><a href="#">Ticks and Leeches</a></li>
                        <li><a href="#">Lateralus</a></li>
                        <li><a href="#">Disposition</a></li>
                        <li><a href="#">Reflection</a></li>
                        <li><a href="#">Triad</a></li>
                        <li><a href="#">Faaip de Oiad</a></li>
                    </ul>
                </div>
            </div>

            <div class="clearfix visible-xs-block visible-sm-block"></div>

            <div class="lyric-card col-xs-12 col-sm-6 col-md-4 right">
                <div class="lyric-card-inner">
                    <img src="/img/tool-10000-days-500x500.jpg" class="img-responsive">
                    <ul class="lyric-songs-list list-unstyled">
                        <li><a href="#">Vicarious</a></li>
                        <li><a href="#">Jambi</a></li>
                        <li><a href="#">Wings for Marie (Part 1)</a></li>
                        <li><a href="#">10,000 Days (Wings pt. 2)</a></li>
                        <li><a href="#">The Pot</a></li>
                        <li><a href="#">Lipan Conjuring</a></li>
                        <li><a href="#">Lost Keys (Blame Hofmann)</a></li>
                        <li><a href="#">Rosetta Stoned</a></li>
                        <li><a href="#">Intension</a></li>
                        <li><a href="#">Right in Two</a></li>
                        <li><a href="#">Viginti Tres</a></li>
                    </ul>
                </div>
            </div>

            <div class="clearfix visible-md-block"></div>
        </div>
    </div>
</div>
@endsection
