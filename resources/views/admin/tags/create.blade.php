@extends('admin/layouts/app')

@section('content')
    <h1>Create Tag</h1>

    <form action="{{ action('Admin\TagController@store') }}" method="POST">
        {{ csrf_field() }}
        @include('admin.tags.partials.form')
    </form>

@endsection
