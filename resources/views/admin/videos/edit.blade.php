@extends('admin/layouts/app')

@section('content')
    <h1>Edit Video</h1>

    <form action="{{ action('Admin\VideoController@update', $video->id) }}" method="POST">
        {{ csrf_field() }}
        @include('admin.videos.partials.form')
    </form>

@endsection
