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
                console.log('submit');

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

                console.log('filterUrl', filterUrl);

                window.location = filterUrl;
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

    @if($page !== 'live-dvd' && $page !== 'hall-of-fame')
        <div class="videos-filter">
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
                        <div class="form-group">
                            <label>Tags:</label>
                            <input type="text" class="form-control" />
                        </div>
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
    @endif

    <div class="videos-collection">
        @forelse(array_get($videos, 'data') as $video)
            <div class="row">
                <div class="col-xs-12">
                    <a href="/videos/{{ array_get($video, 'id') }}/{{ array_get($video, 'slug') }}">
                        <div class="video-card">
                            <div class="video-card-image col-xs-12 col-sm-4">
                                <img src="{{ array_get($video, 'images.medium.url') }}" class="img-responsive">
                            </div>
                            <div class="video-card-text col-xs-12 col-sm-8">
                                <h3>{{ array_get($video, 'name') }}</h3>
                                <p>{{ mb_strimwidth(array_get($video, 'description'), 0, 250, "...") }}</p>
                                <div class="video-card-tags">
                                    @foreach(array_get($video, 'tags.data') as $tag)
                                        <span class="label label-primary">{{ array_get($tag, 'name') }}</span>
                                    @endforeach
                                </div>
                                <div class="video-statistics">
                                    <i class="fa fa-eye"></i> <span class="stat">{{ array_get($video, 'views') }}</span>
                                    @if(array_get($video, 'thumbsUp') != null)
                                        <i class="fa fa-thumbs-up"></i> <span class="stat">{{ array_get($video, 'thumbsUp') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @empty
            <div class="row">
                <div class="col-xs-12">
                    <p>Sorry, nothing matches your criteria. Try again.</p>
                </div>
            </div>
        @endforelse
        @if(array_get($videos, 'meta.pagination.total_pages', 1) > 1)
            <div class="row">
                <div class="col-xs-12">
                    @include('components.pagination', ['pagination' => array_get($videos, 'meta.pagination')])
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
