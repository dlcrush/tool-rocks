@extends('layouts/app', [
    'meta' => [
        'title' => 'Videos',
        'description' => 'Check out this awesome collection of Tool videos including all of your favorite live performances!',
        'keywords' => 'tool videos, tool band videos, tool live videos, tool live performances'
    ]
])

@section('js')
    <script>
        var baseUrl = '{{ url()->current() }}';

        $(function() {
            $('.apply-criteria-button').on('click', function(e) {
                e.preventDefault();

                var year = $('.year-dropdown').val();
                var type = $('.type-dropdown').val();
                var sortBy = $('.sort-by-dropdown').val();

                var filterUrl = baseUrl + '?';
                var delimiter = '';
                if (year) {
                    filterUrl += 'year=' + year;
                    delimiter = '&';
                }
                if (type) {
                    filterUrl += delimiter + 'type=' + type;
                    delimiter = '&';
                }
                if (sortBy) {
                    filterUrl += delimiter + 'orderBy=' + sortBy;
                }

                window.location = filterUrl;
            });

            $('#toggleFilters').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                $('.videos-filter').toggleClass('hidden-xs');
            });
        });
    </script>
@endsection

@section('content')
<div class="container-fluid videos-layout">
    <div class="row">
        <div class="col-xs-12">
            @include('components.prettyHeader', ['text' => 'Videos'])
        </div>
    </div>

    @if($page !== 'live-dvd' && $page !== 'hall-of-fame' && $page !== 'search-results' && $page !== 'music-videos')
        <a href="#" id="toggleFilters" class="btn btn-default visible-xs"><i class="fa fa-filter"></i> Filters</a>
        <div class="videos-filter hidden-xs">
            <br class="visible-xs">
            <div class="row">
                <div class="col-xs-12">
                    <form class="form-inline">
                        <div class="form-group">
                            <label>Year:</label>
                            <select class="year-dropdown">
                                <option value="">Select a Year</option>
                                @foreach($tags as $tag)
                                    <option
                                        value="{{ array_get($tag, 'id') }}"
                                        {{ $year == array_get($tag, 'year') ? 'selected="selected"' : '' }}
                                    >
                                        {{ array_get($tag, 'year') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Type:</label>
                            <select class="type-dropdown">
                                <option value="">Select a Type</option>
                                <option value="live" {{ $type == 'live' ? 'selected="selected"' : '' }}>Live</option>
                                <option value="lyrics" {{ $type == 'lyrics' ? 'selected="selected"' : '' }}>Lyrics</option>
                                <option value="studio" {{ $type == 'studio' ? 'selected="selected"' : '' }}>Studio</option>
                                <option value="music-video" {{ $type == 'music-video' ? 'selected="selected"' : '' }}>Music Video</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Sort By:</label>
                            <select class="sort-by-dropdown">
                                <option value="views:desc" {{ $orderBy == 'views:desc' ? 'selected="selected"' : '' }}>Most Views</option>
                                <option value="views:asc" {{ $orderBy == 'views:asc' ? 'selected="selected"' : '' }}>Fewest Views</option>
                                <option value="created_at:desc" {{ $orderBy == 'created_at:desc' ? 'selected="selected"' : '' }}>Recently Added</option>
                                <option value="published_at:asc" {{ $orderBy == 'published_at:asc' ? 'selected="selected"' : '' }}>Recently Uploaded</option>
                                <option value="thumbs_up:desc" {{ $orderBy == 'thumbs_up:desc' ? 'selected="selected"' : '' }}>Thumbs Up</option>
                            </select>
                        </div>
                        {{-- <div class="form-group">
                            <label>Tags:</label>
                            <input type="text" class="form-control" />
                        </div> --}}
                        <div class="form-group">
                            <button class="btn btn-default apply-criteria-button">Apply Criteria</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @elseif ($page === 'live-dvd')
        <h3>Live DVDs</h3>
    @elseif ($page === 'hall-of-fame')
        <h3>Hall of Fame</h3>
    @elseif ($page === 'search-results')
        <h3>Search Results</h3>
    @elseif ($page === 'music-videos')
        <h3>Music Videos</h3>
    @endif

    @include('videos.partials.collection', ['videos' => $videos])
</div>
@endsection
