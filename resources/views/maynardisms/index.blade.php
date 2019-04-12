@extends('layouts/app', [
    'meta' => [
        'title' => 'Maynardisms',
        'description' => 'Check out these awesome Maynardisms featuring the wisdom of Maynard James Keenan!',
        'keywords' => 'tool maynardisms, maynard james keenan, maynard james keenan quotes, maynard, maynard quotes, tool maynardisms',
        'url' => action('MaynardismController@getMaynardisms')
    ]
])

@section('content')
<div class="container-fluid maynardisms-layout">
    <div class="row">
        <div class="col-xs-12">
            @include('components.prettyHeader', ['text' => 'Maynardisms'])
        </div>
    </div>

    <div class="maynardisms-collection">
        @forelse(array_get($maynardisms, 'data') as $maynardism)
            <div class="row">
                <div class="col-xs-12">
                    <a href="/maynardisms/{{ array_get($maynardism, 'id') }}">
                        <div class="maynardisms-card">
                            <div class="maynardisms-card-image col-xs-12 col-sm-4">
                                <img src="{{ array_get($maynardism, 'video.images.high.url') }}" class="img-responsive" style="max-width: 320px; max-height: 180px;">
                            </div>
                            <div class="maynardisms-card-text col-xs-12 col-sm-8">
                                <h3>&ldquo;{!! array_get($maynardism, 'content') !!}&rdquo;</h3>
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
        @if(array_get($maynardisms, 'meta.pagination.total_pages', 1) > 1)
            <div class="row">
                <div class="col-xs-12">
                    @include('components.pagination', ['pagination' => array_get($maynardisms, 'meta.pagination')])
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
