@extends('admin/layouts/app')

@section('content')
    <h1>Create Tour</h1>

    <form action="{{ action('Admin\TourController@store') }}" method="POST">
        {{ csrf_field() }}
        @include('admin.tours.partials.form')
    </form>

@endsection
