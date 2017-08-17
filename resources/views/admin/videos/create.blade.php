@extends('admin/layouts/app')

@section('content')
    <h1>Create Video</h1>

    <form action="{{ action('Admin\VideoController@store') }}" method="POST">
        {{ csrf_field() }}
        @include('admin.videos.partials.form')
    </form>

@endsection
