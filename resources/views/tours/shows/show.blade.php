@extends('layouts/app')

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
