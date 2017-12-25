@if(! isset($meta))
    <?php $meta = array(); ?>
@endif
@if(! isset($wide))
    <?php $wide = false; ?>
@endif

<!doctype html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ array_get($meta, 'title', 'Home') }} - ToolRocks.com</title>
        <meta name="description" content="{{ array_get($meta, 'description') }}" />
        <meta name="keywords" content="{{ array_get($meta, 'keywords') }}" />
        <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
        <link rel="icon" type="image/vnd.microsoft.icon"  href="/images/favicon.ico">
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
                            <center>Tool Rocks &copy; 2017. Thanks for visiting.</center>
                        </p>
                </footer>
            </div>
        </div>

        <script src=" {{ mix('/js/app.js') }}"></script>
    </body>
</html>
