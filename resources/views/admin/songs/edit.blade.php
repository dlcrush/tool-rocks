@extends('admin/layouts/app')

@section('content')
    <h1>Edit Song</h1>

    <form action="{{ action('Admin\SongController@update', $song->id) }}" method="POST">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        @include('admin.songs.partials.form')
    </form>

@endsection
