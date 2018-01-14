<form>
    <select name="tour" id="tour">
        @foreach($tours as $tour)
            <option value="{{ $tour->id }}" @if($selected == $tour->id) selected="selected" @endif>{{ $tour->name }}</option>
        @endforeach
    </select>
</form>

{{-- I should do this a better way but I'm lazy and it's just an admin page --}}
<script>
    $(function() {
        $('#band').on('change', function() {
            var tourId = $(this).val();
            var bandId = '{{ $bandId }}';

            if (tourId != '') {
                window.location = '/admin/' + '{{ $page }}' + '?bandId=' + bandId + '&tourId=' + tourId;
            }
        });
    });
</script>
