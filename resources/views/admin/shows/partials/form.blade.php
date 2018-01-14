<div class="form-group">
    <label for="band_id">Band</label>
    <input type="text" class="form-control disabled" name="band_id" id="band_id" value="{{ isset($band) ? $band->name : ''}}" disabled>
</div>
<div class="form-group">
    <label for="tour_id">Tour</label>
    <select name="tour_id" id="tour_id" class="form-control">
        @foreach($tours as $tour)
            <option value="{{ $tour->id }}" {{ isset($show->tour_id) && $show->tour_id == $tour->id ? 'selected="selected"' : '' }}>{{ $tour->name }}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" id="name" name="name" placeholder="Date - Venue - Location" value="{{ isset($show->name) ? $show->name : '' }}">
</div>
<div class="form-group">
    <label for="slug">Slug</label>
    <input type="text" class="form-control" id="slug" name="slug" placeholder="tool-year-location" value="{{ isset($show->slug) ? $show->slug : '' }}">
</div>
<div class="form-group">
    <label for="date">Date</label>
    <input type="text" class="form-control" id="date" name="date" value="{{ isset($show->date) ? $show->date : '' }}">
</div>
<div class="form-group">
    <label for="video_id">Video ID</label>
    <input type="text" class="form-control" id="video_id" name="video_id" value="{{ isset($show->video_id) ? $show->video_id : '' }}">
</div>
<div class="form-group">
    <label for="venue_id">Venue</label>
    <select name="venue_id" id="venue_id" class="form-control">
        <option value="">Select a Venue</option>
    </select>
</div>
<div class="form-group">
    <label for="songs">Setlist</label>
    @if(! isset($show->songs) || $show->songs->isEmpty())
        <div class="entry">
            <div class="col-sm-3">
                <select name="songs[]" class="form-control">
                    <option value="">Please select a song</option>
                    @foreach($band->songs as $song)
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
        @foreach($show->songs as $s)
            <div class="entry">
                <div class="col-sm-3">
                    <select name="songs[]" class="form-control">
                        <option value="">Please select a song</option>
                        @foreach($band->songs as $song)
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
<button type="submit" class="btn btn-default">Submit</button>

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

    });


</script>
