@extends('admin/layouts/app')

@section('content')
    <h1>Create Show</h1>

    <form action="{{ action('Admin\ShowController@store') }}" method="POST">
        {{ csrf_field() }}
        @include('admin.shows.partials.form')
    </form>

@endsection
