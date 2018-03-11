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
            <h3>Search</h3>

            <form class="form">
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input name="tags" id="tags" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="name">Text</label>
                    <input name="name" id="name" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <select name="year" id="year" class="form-control">
                        <option value="">Select a Year</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-lg btn-default">Search</button>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
