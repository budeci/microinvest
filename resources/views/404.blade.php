<html lang="en" style="height:100%">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">
    <title>Page not found!</title>
    {!!Html::style('/assets/css/404.css')!!}
    {!!Html::style('/assets/css/normalize.css')!!}
</head>
<body style="height:100%">
<div class="page_404 display-table">
    <div class="td">
        <img src="/assets/images/404.png" height="206" width="201">
        <h1 style="color:#424242;">
            @if($e->getMessage())
                {!! $e->getMessage() !!}
            @else
                Ooops! Se pare că pagina nu mai există.
            @endif
        </h1>
        <h4><a href="/"><i class="icon-"></i>&nbsp;Go home!</a></h4>
    </div>
</div>
<div style="clear: both;"></div>
</body>
</html>