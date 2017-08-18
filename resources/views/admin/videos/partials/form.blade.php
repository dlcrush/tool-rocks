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
    <textarea class="form-control" id="description" name="description">{{ isset($video->description) ? $video->description : "" }}</textarea>
</div>
<div class="form-group">
    <label for="tags">Tags</label>
    <input type="text" id="tags" name="tags" value="{{ isset($video->tags) ? $video->tags : "1,2,3" }}">
</div>
<button type="submit" class="btn btn-default btn-lg">Submit</button>

<script>
    $(function(){

        $('#fetchVideoInfo').on('click', function(e) {

            e.preventDefault();

            var youtubeId = $('#youtube_id').val();

            $.ajax({
                url: '/api/v1/youtube/video/' + youtubeId,
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

        var tags = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.obj.whitespace('name'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            prefetch: {
                url: '/api/v1/tags',
                filter: function(data) {
                    var bacon = data && data.data;
                    return $.map(bacon, function(tag) {
                        return { id: tag.id, name: tag.name };
                    });
                }
            }
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

        //$('#tags').tagsinput('add', { "id": 1 , "name": "Remastered" });

    });


</script>
