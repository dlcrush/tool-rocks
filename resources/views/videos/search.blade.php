@extends('layouts/app', [
    'meta' => [
        'title' => 'Videos - Search',
        'description' => 'Search our full database of your favorite Tool videos!',
        'keywords' => 'tool live, watch tool live, tool live performances, search, search tool videos, search tool live videos, find tool videos',
        'url' => action('VideoController@getSearch')
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
                    <label for="name">Text</label>
                    <input name="text" id="text" class="form-control" value="{{ isset($text) ? $text : '' }}" />
                </div>
                <div class="form-group">
                    <label for="tags">Tags</label>
                    <input name="tags" id="tags" class="form-control" value="{{ isset($tags) ? $tags : "" }}" />
                </div>
                <div class="form-group">
                    <label for="type">Type</label>
                    <select name="type" id="type" class="form-control">
                        <option value="">Select a Type</option>
                        <option value="live" {{ $type == 'live' ? 'selected="selected"' : '' }}>Live</option>
                        <option value="lyrics" {{ $type == 'lyrics' ? 'selected="selected"' : '' }}>Lyrics</option>
                        <option value="music-video" {{ $type == 'music-video' ? 'selected="selected"' : '' }}>Music Video</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="year">Year</label>
                    <select name="year" id="year" class="form-control">
                        <option value="">Select a Year</option>
                        @foreach($years as $y)
                            <option
                                value="{{ array_get($y, 'id') }}"
                                {{ $year == array_get($y, 'year') ? 'selected="selected"' : '' }}
                            >
                                {{ array_get($y, 'year') }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="songs">Songs</label>
                    @if(! isset($songs) || ! is_array($songs) || sizeof($songs) < 1)
                        <div class="entry">
                            <div class="input-group">
                                <select name="songs[]" class="form-control">
                                    <option value="">Please select a song</option>
                                    @foreach(array_get($allSongs, 'data') as $song)
                                        <option value="{{ array_get($song, 'slug') }}">{{ array_get($song, 'name') }}</option>
                                    @endforeach
                                </select>
                                <span class="input-group-btn">
                                    <button class="btn btn-success btn-add" type="button">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    @else
                        @foreach($songs as $s)
                            <div class="entry">
                                <div class="input-group">
                                    <select name="songs[]" class="form-control">
                                        <option value="">Please select a song</option>
                                        @foreach(array_get($allSongs, 'data') as $song)
                                            <option value="{{ array_get($song, 'slug') }}" @if(array_get($song, 'slug') == $s) selected="selected" @endif >{{ array_get($song, 'name') }}</option>
                                        @endforeach
                                    </select>
                                    <span class="input-group-btn">
                                        @if ($loop->last)
                                            <button class="btn btn-success btn-add" type="button">
                                                <span class="glyphicon glyphicon-plus"></span>
                                            </button>
                                        @else
                                            <button class="btn btn-danger btn-remove" type="button">
                                                <span class="glyphicon glyphicon-minus"></span>
                                            </button>
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    @endif
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

        $(document).on('submit', 'form', function(e) {
            e.preventDefault();

            var url = '{{ action("VideoController@getSearch") }}';

            var tags = $('#tags').val();
            var text = $('#text').val();
            var type = $('#type').val();
            var year = $('#year').val();
            var songInputs = $('select[name="songs[]"]');
            var songs = '';
            for(var i = 0; i < songInputs.length; i ++) {
                var songInput = $(songInputs[i]);
                var val = songInput.val();

                if (val) {

                    if (songs != '') {
                        songs += ',';
                    }

                    songs += songInput.val();

                }
            }

            var vals = {tags: tags, text: text, type: type, year: year, songs: songs};

            for (var key in vals) {
                var val = vals[key];

                if (val) {

                    if (url.indexOf('?') < 0) {
                        url += '?';
                    } else {
                        url += '&';
                    }

                    url += key + '=' + val;

                }
            }

            window.location = url;
        });

        $(document).on('click', '.btn-add', function(e) {
            e.preventDefault();

            var form = $('form:first'),
                currentEntry = $(this).parents('.entry:first'),
                newEntry = $(currentEntry.clone()).appendTo($(this).parents('.form-group'));

            newEntry.find('select,input').val('');
            form.find('.entry:not(:last) .btn-add')
                .removeClass('btn-add').addClass('btn-remove')
                .removeClass('btn-success').addClass('btn-danger')
                .html('<span class="glyphicon glyphicon-minus"></span>');
        });
        $(document).on('click', '.btn-remove', function(e) {
    		$(this).parents('.entry:first').remove();

    		e.preventDefault();
    		return false;
    	});

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
                    if (selectedIds.indexOf(tag.slug + "") > -1) {
                        $('#tags').tagsinput('add', tag);
                    }
                }
            }
        });
    });
</script>
@endsection
