<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Admin - ToolRocks.com</title>
        <meta name="description" content="Because Tool Rocks">
        <link href="/css/app.css" rel="stylesheet">
        <link rel="icon" type="image/vnd.microsoft.icon"  href="/images/favicon.ico">
        <script src="/js/app.js"></script>
        <script src="/js/bootstrap-tagsinput.min.js"></script>
        <script src="/js/typeahead.min.js"></script>
        <meta name="robots" content="noindex">
    </head>

    <body>

        <div class="container frame-wrapper">
            @include('admin/navigation')

            <div class="content">
                <div class="main-content">
                    <div class="row">
                        <div class="col-xs-12">
                            @yield('content')
                        </div>
                    </div>
                </div>

                <footer>
                    <div class="padding">
                        <p>
                            <center>Copyright Tool Rocks {{ date('Y') }}. Thanks for visiting.</center>
                        </p>
                </footer>
            </div>
        </div>


    </body>
</html>
