@extends('layouts/app', [
    'meta' => [
        'title' => 'Tours',
        'description' => "Check out this awesome collection of Tool's current, past, and upcoming tours!",
        'keywords' => 'tool tour, tool live, tool live show, tool setlist, tool setlists, tool live shows, tool tours, tool band tours, tool band tour',
        'url' => action('TourController@getTours')
    ]
])

@section('content')

<div class="container-fluid tours-layout">
    <div class="row">
        <div class="col-xs-12">
            @include('components.prettyHeader', ['text' => 'Tours'])
        </div>
    </div>

    <div class="tours-collection">
        <div class="row">
            @forelse(array_get($tours, 'data') as $tour)
                <div class="col-xs-6 col-sm-3 col-md-2" style="margin-bottom: 15px;">
                    @include('components.tourCard', ['tour' => $tour])
                </div>
            @empty
                <div class="col-xs-12">
                    <p>Sorry, no tours. How sad!</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
