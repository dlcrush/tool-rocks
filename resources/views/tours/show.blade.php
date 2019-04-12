@extends('layouts/app', [
    'meta' => [
        'title' => array_get($tour, 'name') . ' Tour',
        'description' => "Check out all the shows and setlists from Tool's " . array_get($tour, 'name') . " Tour!",
        'keywords' => 'tool tour, tool live, tool live show, tool setlist, tool setlists, tool band tour, tool band live, tool band live shows',
        'url' => action('TourController@getTour', array_get($tour, 'slug'))
    ]
])

@section('content')

<div class="container-fluid tour-layout">
    <div class="row">
        <div class="col-xs-12">
            @include('components.prettyHeader', ['text' => 'Tours'])
        </div>
    </div>

    <div class="tour-item">
        <div class="row">
            <div class="col-xs-12">
                @include('components.backTo', [
                    'url' => action('TourController@getTours'),
                    'text' => 'Back to All Tours'
                ])

                <h3>{{ array_get($tour, 'name') }} Tour</h3>

                <div class="shows-collection list-group">
                    @forelse(array_get($tour, 'shows.data') as $show)
                        <a href="{{ action('TourController@getShow', ['tourId' => array_get($tour, 'slug'), 'showId' => array_get($show, 'id'), 'slug' => array_get($show, 'slug')]) }}" class="list-group-item">
                            <div class="show-card">
                                <h4 class="list-group-item-heading hidden-xs hidden-sm">{{ array_get($show, 'name') }}</h4>
                                <h5 class="list-group-item-heading visible-xs-inline-block visible-sm-inline-block">{{ array_get($show, 'name') }}</h5>
                                @if(array_get($show, 'video') != null)
                                    <div class="pull-right watch-link" data-href="{{ array_get($show, 'video.links.web') }}">
                                        <i class="fa fa-video-camera"></i> Watch
                                    </div>
                                @endif
                            </div>
                        </a>
                    @empty
                        <p>Sorry, no shows for this tour. So sad!</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function() {
        $('.watch-link').on('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            window.location = $(this).data('href');
        });
    });
</script>
@endsection
