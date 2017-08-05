<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ isset($band->name) ? $band->name : '' }}">
</div>
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" class="form-control" id="slug" name="slug" value="{{ isset($band->slug) ? $band->slug : '' }}">
</div>
<button type="submit" class="btn btn-default">Submit</button>
