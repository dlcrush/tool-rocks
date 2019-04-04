@extends('admin/layouts/app')

@section('content')
    <h1>Edit Maynardism</h1>

    <form action="{{ action('Admin\MaynardismController@update', $maynardism->id) }}" method="POST">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        @include('admin.maynardisms.partials.form')
    </form>

@endsection
