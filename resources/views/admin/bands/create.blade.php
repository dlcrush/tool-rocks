@extends('admin/layouts/app')

@section('content')
    <h1>Create Band</h1>

    <form action="{{ action('Admin\BandController@store') }}" method="POST">
        {{ csrf_field() }}
        @include('admin.bands.partials.form')
    </form>

@endsection
