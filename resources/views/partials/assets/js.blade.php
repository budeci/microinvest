{!!Html::script('/assets/plugins/jquery/dist/jquery.js')!!}
{!!Html::script('https://code.jquery.com/jquery-migrate-3.0.0.min.js')!!}
{!!Html::script('/assets/plugins/tether/dist/js/tether.min.js')!!}
{!!Html::script('/assets/plugins/bootstrap/dist/js/bootstrap.min.js')!!}
{!!Html::script('/assets/plugins/toastr/toastr.min.js')!!}
{!!Html::script('/assets/plugins/loading-overlay/src/loadingoverlay.min.js')!!}
{!!Html::script('/assets/plugins/moment/min/moment-with-locales.min.js')!!}
{!!Html::script('/assets/plugins/datetimepicker/build/js/bootstrap-datetimepicker.min.js')!!}

<!-- End of initialize other plugins -->
@yield('js')
@yield('script')
{!!Html::script('/assets/js/main-scripts.js')!!}
