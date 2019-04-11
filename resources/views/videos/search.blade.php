@extends('layouts/app', [
    'meta' => [
        'title' => 'Videos - Search',
        'description' => 'Search our full database of your favorite Tool videos!',
        'keywords' => 'tool live, watch tool live, tool live performances, search, search tool videos, search tool live videos, find tool videos'
    ]
])

@section('content')
<div class="container-fluid videos-layout">
    <div class="row">
        <div class="col-xs-12">
            @include('components.prettyHeader', ['text' => 'Videos'])
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12">
            <h3>Search</h3>

            <form class="form">
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input name="tags" id="tags" class="form-control" />
                </div>
                <div class="form-group">
                    <label for="name">Text</label>
                    <input name="text" id="text" class="form-control" value="{{ isset($text) ? $text : '' }}" />
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <select name="year" id="year" class="form-control">
                        <option value="">Select a Year</option>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-lg btn-default">Search</button>
                </div>
            </form>

            @if(isset($videos))
                <h3>Search Results</h3>

                @include('videos.partials.collection', ['videos' => $videos])
            @endif

        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function() {

        $.ajax({
            url: '{{ action('API\TagController@getTags') }}',
            success: function(data) {

                var selectedIds = $('#tags').val().split(',');

                var tagsList = (data && data.data) || [];

                var tags = new Bloodhound({
                    datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
                    queryTokenizer: Bloodhound.tokenizers.whitespace,
                    local: tagsList
                });
                tags.initialize();

                $('#tags').tagsinput({
                    itemValue: 'slug',
                    itemText: 'name',
                    cancelConfirmKeysOnEmpty: true,
                    freeInput: false,
                    typeaheadjs: {
                        name: 'tags',
                        displayKey: 'name',
                        source: tags.ttAdapter()
                    }
                });

                for(var i = 0; i < tagsList.length; i ++) {
                    var tag = tagsList[i];
                    if (selectedIds.indexOf(tag.id + "") > -1) {
                        $('#tags').tagsinput('add', tag);
                    }
                }
            }
        });
    });
</script>
@endsection
