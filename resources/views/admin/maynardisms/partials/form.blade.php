<div class="form-group">
    <label for="content">Content</label>
    <input type="text" class="form-control" id="content" name="content" value="{{ isset($maynardism->content) ? $maynardism->content : '' }}">
</div>
<div class="form-group">
    <label for="band_id">Video ID</label>
    <input type="text" class="form-control" id="video_id" name="video_id" value="{{ isset($maynardism->video_id) ? $maynardism->video_id : '' }}">
</div>
<button type="submit" class="btn btn-default">Submit</button>
