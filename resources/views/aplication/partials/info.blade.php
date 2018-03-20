<div class="row">
    <div class="col-sm-4">
        <ul class="info">
            <li>
                {{trans('app.tel')}} <strong class="text-danger">+373 (22) 801 701</strong>
            <li>
            <li>{{trans('app.email')}} <strong class="text-danger">credit@microinvest.md</strong></li>
        </ul>
    </div>
    <div class="col-sm-4">
        <h3 class="text-center">{{ isset($title) ? $title : '' }}</h3>
    </div>
    <div class="col-sm-4">
        <ul class="orar">
            <li>{{trans('app.monday')}} – {{trans('app.friday')}} 08:00 – 19:00;</li>
            <li>{{trans('app.saturday')}} – {{trans('app.sunday')}} 09:00 – 18:00;</li>
        </ul>
    </div>
</div>