@extends('admin/layouts/app')

@section('content')
    <h1>Create Maynardism</h1>

    <form action="{{ action('Admin\MaynardismController@store') }}" method="POST">
        {{ csrf_field() }}
        @include('admin.maynardisms.partials.form')
    </form>

@endsection
