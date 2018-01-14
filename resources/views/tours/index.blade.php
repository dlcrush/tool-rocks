@extends('layouts/app')

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
                <div class="tour-card col-xs-6 col-sm-3 col-md-2" style="margin-bottom: 15px;">
                    <a href="/tours/{{ array_get($tour, 'slug') }}">
                        <img class="img-responsive" src="http://fakeimg.pl/500x500/000202?text={{ array_get($tour, 'name') }}" />
                    </a>
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
