<div class="form-group">
    <label for="content">Content</label>
    <input type="text" class="form-control" id="content" name="content" value="{{ isset($ipsum->content) ? $ipsum->content : '' }}">
</div>
<div class="form-group">
    <label for="band_id">Band</label>
    <select name="band_id" id="band_id">
        @foreach($bands as $band)
            <option value="{{ $band->id }}">{{ $band->name }}</option>
        @endforeach
    </select>
</div>
<button type="submit" class="btn btn-default">Submit</button>
