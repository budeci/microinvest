<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Microinvest</title>
        {!!Html::style('/assets/plugins/font-awesome/css/font-awesome.min.css')!!}
        {!!Html::style('/assets/plugins/bootstrap/dist/css/bootstrap.min.css')!!}
        {!!Html::style('/assets/plugins/tether/dist/css/tether.min.css')!!}
        {!!Html::style('/assets/plugins/toastr/toastr.min.css')!!}
        {!!Html::style('/assets/css/auth.css')!!}

        @yield('css')
    </head>

    <body>
        @include('notification.notification')

        @yield('content')

        
        {!!Html::script('/assets/plugins/jquery/dist/jquery.js')!!}
        {!!Html::script('/assets/plugins/tether/dist/js/tether.min.js')!!}
        {!!Html::script('/assets/plugins/bootstrap/dist/js/bootstrap.min.js')!!}
        {!!Html::script('/assets/plugins/toastr/toastr.min.js')!!}
        @yield('js')
    </body>

</html>