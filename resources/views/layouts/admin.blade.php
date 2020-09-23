<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>

        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="description" content="multikart">
        <meta name="keywords" content="multikart">
        <meta name="author" content="multikart">
        <!--Google font-->
        <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Arvan Challenge</title>

        <!-- Fonts -->
        <link rel="dns-prefetch" href="//fonts.gstatic.com">

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet" media="screen" id="color">

    </head>
    <body>
        <div id="app">
            <navbar></navbar>
            <router-view></router-view>
        </div>
        <script src="{{ asset('js/app.js') }}" defer></script>
    </body>
</html>
