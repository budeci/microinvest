<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0" />
    <!-- IE6-10 -->
    <link rel="shortcut icon" href="/favicon.ico">
    <!-- other browsers -->
    <link rel="icon" href="/favicon.ico">
    @include('partials.shares.shares_social')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('partials.assets.css')
</head>

<body>

    @include('partials.header.index')
    @include('partials.header.language-bar')
    @include('notification.notification')

    @yield('content')

    @include('partials.footer.index')
    <!-- Scripts -->
    @include('partials.assets.js')
</body>
</html>