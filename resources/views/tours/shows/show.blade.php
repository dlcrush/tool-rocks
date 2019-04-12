@extends('layouts/app', [
    'meta' => [
        'title' => array_get($show, 'name') . ' Setlist',
        'description' => "Check out this setlist from Tool's live show " . array_get($show, 'name') . "!",
        'keywords' => 'tool tour, tool live, tool live show, tool setlist, tool setlists, tool band tour, tool band live, tool band live show, tool band setlist',
        'url' => action('TourController@getShow', ['showId' => array_get($show, 'id'), 'tourId' => $tourId, 'slug' => array_get($show, 'slug')])
    ]
])

@section('content')

<div class="container-fluid show-layout">
    <div class="row">
        <div class="col-xs-12">
            @include('components.prettyHeader', ['text' => 'Tours'])
        </div>
    </div>

    <div class="show-item">
        <div class="row">
            <div class="col-xs-12">
                @include('components.backTo', [
                    'url' => action('TourController@getTour', ['id' => $tourId]),
                    'text' => "Back to All " . $tourId . " Shows"
                ])

                <h3>{{ array_get($show, 'name') }}</h3>

                @if (array_has($show, 'video'))
                    <a href="{{ array_get($show, 'video.links.web') }}" class="btn btn-default btn-lg" style="margin-bottom: 15px"><i class="fa fa-video-camera"></i> Watch Show</a>
                @endif

                <div class="songs-collection list-group">
                    @forelse(array_get($show, 'songs.data') as $song)
                        <div class="list-group-item">
                            {{ $loop->iteration }}. {{ array_get($song, 'name') }}
                        </div>
                    @empty
                        No setlist for this show yet.
                    @endforelse
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
</div>
@endsection
