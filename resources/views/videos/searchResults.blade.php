@extends('layouts/app', [
    'meta' => [
        'title' => 'Videos - Search',
        'description' => 'Search our full database of your favorite Tool videos!',
        'keywords' => 'tool live, watch tool live, tool live performances, search, search tool videos, search tool live videos, find tool videos'
    ]
])

@section('content')
<div class="container-fluid videos-layout">
    <div class="row">
        <div class="col-xs-12">
            @include('components.prettyHeader', ['text' => 'Videos'])
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h3>Search Results</h3>



        </div>
    </div>
</div>
@endsection
