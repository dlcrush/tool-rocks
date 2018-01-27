<a href="{{ array_get($video, 'links.web') }}" style="color: white">
    <div class="related-video col-xs-12">
        <img src="{{ array_get($video, 'images.high.url') }}" class="img-responsive" style="width: 100%;">
        <div class="related-video-info" style="background-color: #131313;">
            <div style="padding: 20px;">
                <h5>{{ array_get($video, 'name') }}</h5>
            </div>
        </div>
    </div>
</a>
