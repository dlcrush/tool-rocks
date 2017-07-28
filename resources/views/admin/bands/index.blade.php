@extends('admin/layouts/app')

@section('content')
    <h1>Bands</h1>

    <table class="table" style="color: black">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Slug</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($bands as $band)
                <tr>
                    <td>{{$band->id}}</td>
                    <td>{{$band->name}}</td>
                    <td>{{$band->slug}}</td>
                    <td><a href="" class="btn btn-primary btn-block">Edit</a></td>
                    <td><a href="" class="btn btn-danger btn-block">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
