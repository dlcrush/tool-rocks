@extends('admin/layouts/app')

@section('content')
    <h1>Edit Tag</h1>

    <form action="{{ action('Admin\TagController@update', $tag->id) }}" method="POST">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        @include('admin.tags.partials.form')
    </form>

@endsection
