@extends('admin/layouts/app')

@section('content')
    <h1>Songs</h1>

    <form>
        <select name="band" id="band">
            @foreach($bands as $b)
                @if ($band->id == $b->id)
                    <option value="{{ $b->id }}" selected="selected">{{ $b->name }}</option>
                @else
                    <option value="{{ $b->id }}">{{ $b->name }}</option>
                @endif
            @endforeach
        </select>
    </form>

    <table class="table">
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Slug</th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($band->songs as $song)
                <tr>
                    <td>{{$song->id}}</td>
                    <td>{{$song->name}}</td>
                    <td>{{$song->slug}}</td>
                    <td><a href="" class="btn btn-primary btn-block">Edit</a></td>
                    <td><a href="" class="btn btn-danger btn-block">Delete</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection
