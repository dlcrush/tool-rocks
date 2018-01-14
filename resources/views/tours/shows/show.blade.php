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
                        <div class="list-group-item" style="color:black;">
                            {{ $loop->iteration }}. {{ array_get($song, 'name') }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
