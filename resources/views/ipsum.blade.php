@extends('layouts/app', [
    'meta' => [
        'title' => 'Tool Ipsum',
        'description' => 'Check out this awesome Tool Ipsum generator! The best text to fill space on your site!',
        'keywords' => 'tool ipsum, ipsum, ipsum generator, tool ipsum generator, tool band ipsum, tool band ipsum generator, tool lorem ipsum, lorem ipsum, lorem ipsum generator'
    ]
])

@section('content')
    <div class="ipsum-layout">
        <div class="row">
            <div class="col-xs-12">
                @include('components.prettyHeader', ['text' => 'Ipsum'])
            </div>
        </div>

        <div class="row">
            <form class="form-horizontal container" method="get">
                <div class="form-group">
                    <label class="control-label col-sm-2">How Many Paragraphs?</label>
                    <div class="col-sm-1">
                        <input type="number" name="paragraphs" class="form-control" value="{{ $numParagraphs }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-2">Size of paragraphs?</label>
                    <div class="col-sm-3">
                        <select name="paragraphSize" class="form-control">
                            <option value="small" {{ $sizeOfParagraph === 'small' ? 'selected="selected"' : '' }}>Small</option>
                            <option value="medium" {{ $sizeOfParagraph === 'medium' ? 'selected="selected"' : '' }}>Medium</option>
                            <option value="large" {{ $sizeOfParagraph === 'large' ? 'selected="selected"' : '' }}>Large</option>
                            <option value="huge" {{ $sizeOfParagraph === 'huge' ? 'selected="selected"' : '' }}>YUGE</option>
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
