@extends('admin/layouts/app')

@section('content')
    <h1>Edit Ipsum</h1>

    <form action="{{ action('Admin\IpsumController@update', $ipsum->id) }}" method="POST">
        {{ csrf_field() }}
        <input name="_method" type="hidden" value="PUT">
        @include('admin.ipsums.partials.form')
    </form>

@endsection
