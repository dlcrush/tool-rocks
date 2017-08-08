@extends('layouts/app')

@section('content')
    <h1>Tool Ipsum</h1>

    <form class="form-horizontal container">
        <div class="form-group">
            <label class="control-label col-sm-2">How Many Paragraphs?</label>
            <div class="col-sm-1">
                <input type="number" name="paragraphs" class="form-control" value="4">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Size of paragraphs?</label>
            <div class="col-sm-3">
                <select name="typeOfParagraphs" class="form-control">
                    <option>Small</option>
                    <option selected="selected">Medium</option>
                    <option>Large</option>
                    <option>YUGE</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <input class="btn form-control" type="submit" value="Generate">
        </div>
    </form>

    @foreach($paragraphs as $paragraph)
        <p>{{ $paragraph }}</p>
    @endforeach

@endsection
