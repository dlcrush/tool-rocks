@extends('layouts/app')

@section('content')
    <h1>Tool Ipsum</h1>

    <form class="form-horizontal container" method="get">
        <div class="form-group">
            <label class="control-label col-sm-2">How Many Paragraphs?</label>
            <div class="col-sm-1">
                <input type="number" name="paragraphs" class="form-control" value="4">
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-sm-2">Size of paragraphs?</label>
            <div class="col-sm-3">
                <select name="paragraphSize" class="form-control">
                    <option value="small">Small</option>
                    <option value="medium" selected="selected">Medium</option>
                    <option value="large">Large</option>
                    <option value="huge">YUGE</option>
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
