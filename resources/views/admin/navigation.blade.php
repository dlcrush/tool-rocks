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
                    Admin
                </a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="/"> Main site</a>
                    </li>
                    <li>
                        <a href="{{ action('Admin\BandController@index') }}"> Bands</a>
                    </li>
                    <li>
                        <a href="{{ action('Admin\AlbumController@index') }}"> Albums</a>
                    </li>
                    <li>
                        <a href="{{ action('Admin\SongController@index') }}"> Songs</a>
                    </li>
                    <li>
                        <a href="{{ action('Admin\ShowController@index') }}"> Shows</a>
                    </li>
                    <li>
                        <a href="{{ action('Admin\TagController@index') }}"> Tags</a>
                    </li>
                    <li>
                        <a href="{{ action('Admin\TourController@index') }}"> Tours</a>
                    </li>
                    <li>
                        <a href="{{ action('Admin\VideoController@index') }}"> Videos</a>
                    </li>
                    <li>
                        <a href="{{ action('Admin\IpsumController@index') }}"> Ipsums</a>
                    </li>
                    <li>
                        <a href="{{ action('Admin\MaynardismController@index') }}"> Maynardisms</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
