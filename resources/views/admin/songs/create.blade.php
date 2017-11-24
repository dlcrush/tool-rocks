@extends('admin/layouts/app')

@section('content')
    <h1>Create Song</h1>

    <form action="{{ action('Admin\SongController@store') }}" method="POST">
        {{ csrf_field() }}
        @include('admin.songs.partials.form')
    </form>

@endsection
