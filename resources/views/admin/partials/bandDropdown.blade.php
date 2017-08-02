<form>
    <select name="band" id="band">
        @foreach($bands as $band)
            <option value="{{ $band->id }}" @if($selected == $band->id) selected="selected" @endif>{{ $band->name }}</option>
        @endforeach
    </select>
</form>

{{-- I should do this a better way but I'm lazy and it's just an admin page --}}
<script>
    $(function() {
        $('#band').on('change', function() {
            var bandId = $(this).val();

            if (bandId != '') {
                window.location = '/admin/album?bandId=' + bandId;
            }
        });
    });
</script>
