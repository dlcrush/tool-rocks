@extends('admin/layouts/app')

@section('content')
    <h1>Albums</h1>

    <div class="row">
        <div class="col-md-8">
            @include("admin.partials.bandDropdown", ["bands" => $bands, "bandId" => $bandId])
        </div>
        <div class="col-md-4">
            <a href="/admin/album/create" class="btn btn-primary btn-lg pull-right">New Album</a>
        </div>
    </div>

    <table class="table">
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
            @foreach($albums as $album)
                <tr>
                    <td>{{$album->id}}</td>
                    <td>{{$album->name}}</td>
                    <td>{{$album->slug}}</td>
                    <td><a href="" class="btn btn-primary btn-block">Edit</a></td>
                    <td><a href="" class="btn btn-danger btn-block">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <script>
        $(function() {
            $('#band').on('change', function() {
                var bandId = $(this).val();

                if (bandId != '') {
                    window.location = '/admin/album?bandId=' + bandId;
                }
            });
        });
    </script>

@endsection
