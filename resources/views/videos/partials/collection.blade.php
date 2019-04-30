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
                                <i class="fa fa-clock-o"></i> <span class="stat">{{ array_get($video, 'duration') }}</span>
                                <i class="fa fa-eye"></i> <span class="stat">{{ array_get($video, 'views') }}</span>
                                @if(array_get($video, 'thumbsUp') != null)
                                    <i class="fa fa-thumbs-up"></i> <span class="stat">{{ array_get($video, 'thumbsUp') }}</span>
                                @endif
                                @if(array_get($video, 'channel.name') != null)
                                    <i class="fa fa-user"></i> <span class="stat">{{ array_get($video, 'channel.name') }}</span>
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
