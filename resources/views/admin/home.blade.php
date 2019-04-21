@extends('admin/layouts/app')

@section('content')
    <h1>Admin</h1>

    <h3>Videos</h3>

    <div class="row">
        <div class="col-xs-12">
            <a href="/admin/commands/videos/ingest" class="btn btn-default">Ingest Video Data</a>
        </div>
    </div>

    <h3>Wordpress</h3>

    <div class="row">
        <div class="col-xs-12">
            <a href="/admin/commands/wordpress/ingest" class="btn btn-default">Ingest WP Data</a>
        </div>
    </div>

    <h3>Daily Fix</h3>

    <div class="row">
        <div class="col-xs-12">
            <a href="/admin/commands/dailyfix/generate" class="btn btn-default">Generate Daily Fix</a>
        </div>
    </div>

@endsection
