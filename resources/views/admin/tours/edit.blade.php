@extends('admin/layouts/app')

@section('content')
    <h1>Edit Tour</h1>

    <form action="{{ action('Admin\TourController@update', $tour->id) }}" method="POST">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        @include('admin.tours.partials.form')
    </form>

@endsection
