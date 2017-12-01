@extends('layouts/app', ['wide' => true])

@section('content')
<div class="container-fluid video-layout">

    <h3>{{ array_get($video, 'name') }}</h3>

    <div class="video-wrapper">
        <div class="video-container">
             <iframe class="video" width="960" height="540" src="https://www.youtube.com/embed/{{ array_get($video, 'youtube_video_id') }}" frameborder="0" allowfullscreen></iframe>
        </div>
    </div>
    <div class="video-info-wrapper">
        <div class="content">
            <a href="https://youtube.com/channel/UCRUq9jueekA0t4uz_z5LZmA">
                <img class="img-responsive" src="{{ array_get($video, 'channel.images.high.url') }}"></iframe>
            </a>
            <p> Uploaded By: <a href="#"> &nbsp; {{ array_get($video, 'channel.name') }}</a></p>
            <p>
                <i class="fa fa-eye"></i> <span class="stat">{{ array_get($video, 'views') }}</span>
                <i class="fa fa-thumbs-up"></i> <span class="stat">{{ array_get($video, 'thumbsUp') }}</span>
                <i class="fa fa-thumbs-down"></i> <span class="stat">{{ array_get($video, 'thumbsDown') }}</span>
            </p>
            <p>
                {!! nl2br(array_get($video, 'description')) !!}
            </p>
        </div>
    </div>
    <div class="related-videos-wrapper">
        <h3>Related Videos</h3>

        <p>Gotta divide it all right in two. Who are you to wave your finger? I hope you're choking. I hope you choke on this. But I'm still right here giving blood, keeping faith and I'm still right here. Spark becomes a flame. Flame becomes a fire. Forge a blade to slay the stranger. Take whatever we desire. And it's half as high as heaven and half as clear as reason. I've come round full circle. My lamb and martyr, this will be over soon. You look so precious. Defining, confining, controlling, and we're sinking deeper.</p>

        <p>Lock the door, kill the light. No one's coming home tonight. Lock the door, kill the light. No one's coming home tonight. Overwhelmed as one would be, placed in my position. Such a heavy burden now to be the one. See, my heart is racing 'cause this shit never happens to me. This body makes me feel eternal. How they've survived so misguided is a mystery. Feed my will to feel this moment urging me to cross the line. Boredom's not a burden anyone should bear.</p>

        <p>Ignorant siblings in the congregation gather around spewing sympathy. Spare me. See, my heart is racing 'cause this shit never happens to me. To ascend you must die. You must be crucified. Things like.... "Fuck yourself, kill yourself, you piece of shit." Monkey killing monkey killing monkey over pieces of the ground. Silly monkeys. Shine on forever. Shine on benevolent sun. Shine down upon the broken. Shine until the two become one. Who are you to wave your fatty fingers at me? To bring the pieces back together, rediscover communication.</p>

        <p>Dreaming of that face again. It's bright and blue and shimmering. Grinning wide and comforting me with it's three warm and wild eyes. I need to watch things die from a good safe distance. I hope it sucks you down. But I'm so comfortable...Too comfortable. I know the pieces fit 'cause I watched them fall away. We all feed on tragedy. It's like blood to a vampire. Locked up inside you, like the calm beneath castles, is a cavern of treasures that no one has been to. You believe me, don't you? Please believe what I've just said! See the Dead ain't touring and this wasn't all in my head.</p>

    </div>
</div>
@endsection
