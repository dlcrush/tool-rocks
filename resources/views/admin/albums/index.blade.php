@extends('admin/layouts/app')

@section('content')
    <h1>Albums</h1>

    <form>
        <select name="band" id="band">
            <option value="">Please select a band</option>
            @foreach($bands as $band)
                @if ($bandId == $band->id)
                    <option value="{{ $band->id }}" selected="selected">{{ $band->name }}</option>
                @else
                    <option value="{{ $band->id }}">{{ $band->name }}</option>
                @endif
            @endforeach
        </select>
    </form>

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
        console.log(window);
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
