<div class="form-group">
    <label for="band">Band</label>
    <select name="band_id" id="band_id" class="form-control">
        @foreach($bands as $band)
            <option value="{{ $band->id }}" {{ isset($tour->band_id) && $tour->band_id == $band->id ? 'selected="selected"' : '' }}>{{ $band->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" value="{{ isset($tour->name) ? $tour->name : '' }}">
</div>
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" class="form-control" id="slug" name="slug" value="{{ isset($tour->slug) ? $tour->slug : '' }}">
</div>
<div class="form-group">
    <label for="date">Date</label>
    <input type="text" class="form-control" id="date" name="date" value="{{ isset($tour->date) ? $tour->date : '' }}">
</div>
<button type="submit" class="btn btn-default">Submit</button>
