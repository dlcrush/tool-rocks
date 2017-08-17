@extends('admin/layouts/app')

@section('content')
    <h1>Edit Band</h1>

    <form action="{{ action('Admin\BandController@update', $band->id) }}" method="POST">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        @include('admin.bands.partials.form')
    </form>

@endsection
