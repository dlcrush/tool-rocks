<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ isset($tag->name) ? $tag->name : '' }}">
</div>
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" class="form-control" id="slug" name="slug" value="{{ isset($tag->slug) ? $tag->slug : '' }}">
</div>
<button type="submit" class="btn btn-default">Submit</button>
