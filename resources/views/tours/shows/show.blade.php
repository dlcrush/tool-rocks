@extends('layouts/app', [
    'meta' => [
        'title' => array_get($show, 'name') . ' Setlist',
        'description' => "Check out this setlist from Tool's live show " . array_get($show, 'name') . "!",
        'keywords' => 'tool tour, tool live, tool live show, tool setlist, tool setlists, tool band tour, tool band live, tool band live show, tool band setlist'
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

                <div class="songs-collection list-group">
                    @foreach(array_get($show, 'songs.data') as $song)
                        <div class="list-group-item">
                            {{ $loop->iteration }}. {{ array_get($song, 'name') }}
                        </div>
                    @endforeach
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
