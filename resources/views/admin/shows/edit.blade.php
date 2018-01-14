@extends('admin/layouts/app')

@section('content')
    <h1>Edit Show</h1>

    <form action="{{ action('Admin\ShowController@update', $show->id) }}" method="POST">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        @include('admin.shows.partials.form')
    </form>

@endsection
