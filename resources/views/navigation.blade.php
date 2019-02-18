<div class="navbar-container">
    <div class="navbar navbar-default" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/admin">
                    <span class="tool">TOOL</span>
                    <span class="rocks">Rocks</span>
                </a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/"><i class="fa fa-home"></i> Home</a>
                    </li>
                    {{-- <li>
                        <a href="/tv"><i class="fa fa-tv"></i> TV</a>
                    </li> --}}
                    <li class="dropdown">
                        <a href="/videos" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-play"></i> Videos <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/videos">Browse</a></li>
                            {{-- <li><a href="/videos/search">Search</a></li> --}}
                            <li><a href="/videos?tags=hall-of-fame&page=hall-of-fame">Hall of Fame</a></li>
                            <li><a href="/videos?tags=live-dvd&orderBy=name:desc&page=live-dvd">Live DVDs</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/lyrics"><i class="fa fa-music"></i> Lyrics</a>
                    </li>
                    <li>
                        <a href="/tours"><i class="fa fa-bus"></i> Tours</a>
                    </li>
                    <li>
                        <a href="/blog"><i class="fa fa-book"></i> Blog</a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">More <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/ipsum">Ipsum Generator</a></li>
                            <li><a href="/maynardisms">Maynardisms</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
