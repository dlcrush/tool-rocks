<div class="form-group">
    <label for="band">Band</label>
    <select name="band_id" id="band_id" class="form-control">
        @foreach($bands as $band)
            <option value="{{ $band->id }}" {{ isset($song->band_id) && $song->band_id == $band->id ? 'selected="selected"' : '' }}>{{ $band->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ isset($song->name) ? $song->name : '' }}">
</div>
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" class="form-control" id="slug" name="slug" value="{{ isset($song->slug) ? $song->slug : '' }}">
</div>
<div class="form-group">
    <label for="has_lyrics">Has Lyrics</label>
    <input type="checkbox" id="has_lyrics" name="has_lyrics" value="true" <?php if( isset($song->has_lyrics) && $song->has_lyrics == 1) { ?> checked="checked" <?php } ?>>
</div>
<div class="form-group">
    <label for="lyrics">Lyrics</label>
    <textarea name="lyrics" id="lyrics" class="form-control" rows="20">{{ isset($song->lyrics) ? $song->lyrics : '' }}</textarea>
</div>
<div class="form-group">
    <label for="lyrics_video_id">Lyrics Video ID</label>
    <input type="text" class="form-control" id="lyrics_video_id" name="lyrics_video_id" value="{{ isset($song->lyrics_video_id) ? $song->lyrics_video_id : '' }}">
</div>
<button type="submit" class="btn btn-default">Submit</button>
