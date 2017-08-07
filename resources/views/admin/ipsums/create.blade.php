@extends('admin/layouts/app')

@section('content')
    <h1>Create Ipsum</h1>

    <form action="{{ action('Admin\IpsumController@store') }}" method="POST">
        {{ csrf_field() }}
        @include('admin.ipsums.partials.form')
    </form>

@endsection
