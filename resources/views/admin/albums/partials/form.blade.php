<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ isset($album->name) ? $album->name : '' }}">
</div>
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" class="form-control" id="slug" name="slug" value="{{ isset($album->slug) ? $album->slug : '' }}">
</div>
<div class="form-group">
    <label for="release_date">Release Date</label>
    <input type="text" class="form-control" id="release_date" name="release_date" value="{{ isset($album->release_date) ? $album->release_date : '' }}">
</div>
{{-- <div class="form-group">
    <label for="exampleInputFile">File input</label>
    <input type="file" id="exampleInputFile">
    <p class="help-block">Example block-level help text here.</p>
</div> --}}
<div class="checkbox">
    <label>
        <input type="checkbox"> Check me out
    </label>
</div>
<button type="submit" class="btn btn-default">Submit</button>
