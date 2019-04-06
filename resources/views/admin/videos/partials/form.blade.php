<div class="form-group">
    <label for="band">Band</label>
    <select name="band" id="band" class="form-control" readonly>
        @foreach($bands as $band)
            <option value="{{ $band->id }}">{{ $band->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="youtube_id">YouTube ID</label>
    <input type="text" class="form-control" name="youtube_id" id="youtube_id" value="{{ isset($video->video_id) ? $video->video_id : '' }}">
</div>
<div class="form-group">
    <a href="#" id="fetchVideoInfo" class="btn btn-default">Fetch Video Info</a>
</div>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ isset($video->name) ? $video->name : '' }}">
</div>
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" class="form-control" id="slug" name="slug" value="{{ isset($video->slug) ? $video->slug : '' }}">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <textarea class="form-control" id="description" name="description" rows="15">{{ isset($video->description) ? $video->description : "" }}</textarea>
</div>
<div class="form-group">
    <label for="tags">Tags</label>
    <input type="hidden" id="tags" name="tags" value="{{ isset($video->tags) ? implode(",", $video->tags->pluck('id')->toArray()) : "" }}">
</div>
<div class="form-group">
    <label for="songs">Setlist</label>
    @if(! isset($video->songs) || $video->songs->isEmpty())
        <div class="entry">
            <div class="col-sm-3">
                <select name="songs[]" class="form-control">
                    <option value="">Please select a song</option>
                    @foreach($bands->first()->songs as $song)
                        <option value="{{ $song->id }}">{{ $song->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-sm-3">
                <input type="text" class="form-control col-sm-3" name="start_time[]" placeholder="start time">
            </div>
            <div class="input-group col-sm-3">
                <input type="text" class="form-control" name="end_time[]" placeholder="end time">
                <span class="input-group-btn">
                    <button class="btn btn-success btn-add" type="button">
                        <span class="glyphicon glyphicon-plus"></span>
                    </button>
                </span>
            </div>
        </div>
    @else
        @foreach($video->songs as $s)
            <div class="entry">
                <div class="col-sm-3">
                    <select name="songs[]" class="form-control">
                        <option value="">Please select a song</option>
                        @foreach($bands->first()->songs as $song)
                            <option value="{{ $song->id }}" @if($song->id == $s->id) selected="selected" @endif>{{ $song->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-3">
                    <input type="text" class="form-control col-sm-3" name="start_time[]" value="{{ $s->pivot->start_time }}" placeholder="start time">
                </div>
                <div class="input-group col-sm-3">
                    <input type="text" class="form-control" name="end_time[]" value="{{ $s->pivot->end_time }}" placeholder="end time">
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
    <label for="meta_title">Meta Title</label>
    <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ isset($video->meta_title) ? $video->meta_title : '' }}">
</div>
<div class="form-group">
    <label for="meta_description">Meta Description</label>
    <textarea class="form-control" id="meta_description" name="meta_description">{{ isset($video->meta_description) ? $video->meta_description : '' }}</textarea>
</div>
<div class="form-group">
    <label for="meta_keywords">Meta Keywords</label>
    <textarea class="form-control" id="meta_keywords" name="meta_keywords">{{ isset($video->meta_keywords) ? $video->meta_keywords : '' }}</textarea>
</div>
<div class="form-group">
    <label for="unlisted">Unlisted</label>
    <input type="checkbox" id="unlisted" name="unlisted" {{ isset($video->unlisted) && $video->unlisted == true ? "checked='checked'" : "" }} />
</div>
<button type="submit" class="btn btn-default btn-lg">Submit</button>

<style>
    .entry:not(:first-of-type) {
        margin-top: 10px;
    }
</style>

{{-- I'd really like to do this better! --}}
<script>
    $(function(){

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

        $('#fetchVideoInfo').on('click', function(e) {

            e.preventDefault();

            var youtubeId = $('#youtube_id').val();

            $.ajax({
                url: "{{ action('API\YouTubeController@getVideo', ['id' => '']) }}/" + youtubeId,
                success: function(data) {
                    var name = data.title,
                        description = data.description;

                    $('#name').val(name);
                    $('#description').val(description);
                },
                failure: function(data) {
                    alert('oh shit');
                }
            });
        });

        // This is pretty stupid, I can find a better way
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
                    itemValue: 'id',
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
