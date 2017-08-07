@extends('layouts/app')

@section('content')
    <h1>Tool Ipsum</h1>

    @foreach($paragraphs as $paragraph)
        <p>{{ $paragraph }}</p>
    @endforeach

@endsection
