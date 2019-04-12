<!DOCTYPE html>
@if(! isset($meta))
    <?php $meta = array(); ?>
@endif
@if(! isset($wide))
    <?php $wide = false; ?>
@endif
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ array_get($meta, 'title', 'Home') }} - ToolRocks.com</title>
        <meta name="description" content="{{ array_get($meta, 'description') }}" />
        <meta name="keywords" content="tool, toolband, tool band, tool rocks, toolrocks, {{ array_get($meta, 'keywords') }}" />
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
        <link rel="icon" type="image/vnd.microsoft.icon"  href="/images/favicon.ico">
        @if (array_has($meta, 'url'))
            <link rel="canonical" href="{{ array_get($meta, 'url') }}" />
        @endif
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta property="fb:app_id" content="114546565996433" />
        <meta property="og:site_name" content="ToolRocks.com"/>
        <meta property="og:type" content="website" />
        <meta property="og:title" content="{{ array_get($meta, 'title', 'Home') }} - ToolRocks.com"/>
        <meta property="og:url" content="{{ url()->current() }}" />
        @if(array_has($meta, 'image'))
            <meta property="og:image:width" content="{{ array_get($meta, 'image.width') }}" />
            <meta property="og:image:height" content="{{ array_get($meta, 'image.height') }}" />
            <meta property="og:image:url" content="{{ array_get($meta, 'image.url') }}" />
            <meta property="og:image" content="{{ array_get($meta, 'image.url') }}"/>
        @endif
        <meta property="og:description" content="{{ array_get($meta, 'description') }}"/>
        @if(array_get($meta, 'noindex') === true)
            <meta name="robots" content="noindex">
        @endif

        <script src=" {{ mix('/js/app.js') }}"></script>
        <script src="/js/bootstrap-tagsinput.min.js"></script>
        <script src="/js/typeahead.min.js"></script>
    </head>

    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.11&appId=114546565996433';
        fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <div class="container frame-wrapper">
            @include('../navigation')

            <div class="content">
                <div class="main-content @if($wide == true) {{ 'wide' }} @endif">
                    @yield('content')
                </div>

                <footer>
                    <div class="padding">
                        <p>
                            <center>Tool Rocks &copy; {{ date('Y') }}. Thanks for visiting.</center>
                        </p>
                </footer>
            </div>
        </div>


        @yield('js')
    </body>
</html>
