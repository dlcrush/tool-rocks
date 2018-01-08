@extends('layouts/app')

@section('content')
<style>
    .form-group {
        margin-right: 25px;
    }
</style>

<div class="container-fluid videos-layout">
    <div class="row">
        <div class="col-xs-12">
            @include('components.prettyHeader', ['text' => 'Videos'])
        </div>
    </div>

    <div class="videos-filter">
        <div class="row">
            <div class="col-xs-12">
                <form class="form-inline">
                    <div class="form-group">
                        <label>Year:</label>
                        <select>
                            <option>Select a Year</option>
                            @foreach($tags as $tag)
                                <option value="{{ array_get($tag, 'id') }}">{{ array_get($tag, 'year') }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type:</label>
                        <select>
                            <option>Select a Type</option>
                            <option>Live</option>
                            <option>Lyrics</option>
                            <option>Studio</option>
                            <option>Music Video</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Sort By:</label>
                        <select>
                            <option>Date Added</option>
                            <option>Views</option>
                            <option>Thumbs Up</option>
                            <option>Date Uploaded</option>
                        </select>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="videos-collection">
        @foreach(array_get($videos, 'data') as $video)
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
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        @endforeach
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
