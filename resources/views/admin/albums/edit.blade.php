@extends('admin/layouts/app')

@section('content')
    <h1>Edit Album</h1>

    <form>
        @include('admin.albums.partials.form')
    </form>

@endsection
