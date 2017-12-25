@extends('layouts/app', [
    'meta' => [
        'title' => 'Tool Ipsum - ToolRocks.com',
        'description' => 'Check out this awesome Tool Ipsum generator!',
        'keywords' => 'tool, tool band, tool ipsum, ipsum, ipsum generator, tool ipsum generator'
    ]
])

@section('content')
    <div class="ipsum-layout">
        <div class="row">
            <div class="col-xs-12">
                <div class="header" style="margin-top: 15px; margin-bottom: 15px;">
                    <img src="/img/concert.jpg" class="img-responsive">
                    <div class="text">Ipsum</div>
                </div>
            </div>
        </div>

        <div class="row">
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
        </div>

        <div class="row">
            <div class="col-xs-12">
                @foreach($paragraphs as $paragraph)
                    <p>{{ $paragraph }}</p>
                @endforeach
            </div>
        </div>

    </div>

@endsection
