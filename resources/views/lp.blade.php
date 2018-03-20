<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TopCredit</title>
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,500,700,900,100,300italic,400italic,500italic,700italic'
          rel='stylesheet' type='text/css'>
    {!!Html::style('/assets/lp/css/bootstrap.min.css')!!}
    {!!Html::style('/assets/lp/style/style.css')!!}
    {!!Html::style('/assets/lp/style/custom.css')!!}
    {!!Html::style('/assets/plugins/qtip/jquery.qtip.min.css')!!}
    {!!Html::style('/assets/plugins/toastr/toastr.min.css')!!}
</head>

<body>
<section class="first_section" id="home">
    <img class="img-responsive logo_first" src="/assets/lp/images/logo.png" alt="">
    <div class="first_login">
        @if($authCheck)
            <a title="{{$authDealerName}}" href="{{route('standart')}}"><img src="/assets/lp/images/logare.png"
                                                                                   alt="">{{$authDealerName}}</a>
        @else
            <a href="{{route('get_login')}}"><img src="/assets/lp/images/logare.png" alt="">{!! $meta->getMeta('login_partner') !!}</a>
        @endif
    </div>

    <div class="first_calcul" style="display: none;">
        <a href=""><img src="/assets/lp/images/calculator.png" alt="">{!! $meta->getMeta('calculator_link') !!}</a>
    </div>
    <div class="first_color"></div>
    <div class="first_block">
        <div class="first_block_inner">
            <span><a href="tel:067256006"><img src="" alt=""><img src="/assets/lp/images/ic1_2.png" alt="">{!! settings()->getOption('support::mobile') !!}</a></span>
            <span class="hidden-xs"><img src="/assets/lp/images/ic1_3.png" alt="">{!! settings()->getOption('support::home') !!}</span>
            <span class="hidden-xs"><img src="/assets/lp/images/ic1_4.png" alt="">{!! settings()->getOption('admin::email') !!}</span>
        </div>
    </div>
    <!-- Bara fixa -->
    <div class="bar_head">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-2 col-xs-6">
                    <a href="#home"><img class="img-responsive bar_head_logo" src="/assets/lp/images/logo_bar.png" alt=""></a>
                </div>
                <div class="col-sm-4">

                    @if($authCheck)
                        <a class="bar_head_logare hidden-xs" title="{{$authDealerName}}"
                           href="{{route('standart')}}"><img src="/assets/lp/images/51.png"
                                                                   alt="">{{$authDealerName}}</a>
                    @else
                        <a class="bar_head_logare hidden-xs" href="{{route('get_login')}}"><img
                                    src="/assets/lp/images/51.png" alt="">{!! $meta->getMeta('login_partner') !!}</a>
                    @endif
                </div>
                <div class="col-sm-4">
                    <a class="bar_head_calcul hidden-xs" href="{{route('standart')}}"><img
                                src="/assets/lp/images/53.png" alt="">{!! $meta->getMeta('calculator_link') !!}</a>
                </div>
                <div class="col-sm-2 col-xs-6">
                    <span class="bar_head_phone"><a href="tel:{!! settings()->getOption('support::mobile') !!}"></a><img src="/assets/lp/images/54.png"
                                                                                        alt="">{!! settings()->getOption('support::mobile') !!}</span>
                </div>
            </div>
        </div>
    </div>
    <!-- end bara fixa -->

    <div class="container">
        <div class="row first_contain">
            <div class="col-md-7 col-sm-5">
                <img class="first_img" src="/assets/lp/images/1.png" alt="">
                <div class="first_title">
                    <h3>{!! $meta->getMeta('header_title') !!}</h3>
                    <!-- <h4>de consum pentru</h4>
                <h5>Produsele sau Afacerea ta</h5> -->
                </div>
            </div>
            <div class="col-md-5 col-sm-7">
                <div class="first_contacts_color"></div>
                <div class="first_contacts_form">
                    <h3>{!! $meta->getMeta('top_form_title') !!}</h3>
                    <h4>{!! $meta->getMeta('top_form_subtitle') !!}</h4>
                    <form action="{{route('sendFormEmail')}}" method="POST" enctype="multipart/form-data"
                          class="lp-form">
                        <div class="first_inp">
                            <input type="text" name="name" placeholder="Nume Prenume" required>
                            <img src="/assets/lp/images/ic_1.png" alt="">
                        </div>
                        <div class="first_inp">
                            <input type="email" name="email" placeholder="Email" required>
                            <img src="/assets/lp/images/ic_2.png" alt="">
                        </div>
                        <div class="first_inp">
                            <input type="tel" name="phone" placeholder="Telefon" required>
                            <img src="/assets/lp/images/ic_3.png" alt="">
                        </div>
                        <div class="checkbox_text" id="div1" style="height:20px; overflow:hidden; cursor: pointer;">
                            <input type="checkbox" required id="c1" name="c1" value="true"
                                   onclick="showMe('div1','c1')">
                            <label for="c1">
                                {!! $meta->getMeta('accept_first') !!}
                            </label>
                        </div>
                        <br>
                        <div class="checkbox_text" id="div2" style="height:20px; overflow:hidden;cursor: pointer;">
                            <input type="checkbox" required id="c2" name="c2" value="true"
                                   onclick="showMe('div2','c2')">
                            <label for="c2">
                                {!! $meta->getMeta('accept_last') !!}
                            </label>
                        </div>
                        <div class="first_file">
                            <div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
                            <div id="container-file" class="container-file">
                                <a id="pickfiles" class="pickfiles" href="javascript:;">{!! $meta->getMeta('place_buletin') !!}</a>
                                <input type="text" name="file-count" class="file-count" id="input-pickfiles"
                                       data-child="pickfiles" value="" required data-count="0">
                                <!-- <input id="pickfiles" multiple="multiple" type="file" id="exampleInputFile"> -->

                                <a id="uploadfiles" href="javascript:;" style="display: none;">[Upload files]</a>
                            </div>
                        </div>
                        {!! csrf_field() !!}
                        <input type="submit" class="btn-send-form" value="Trimite acum">
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="textblock">
    <div class="container">
        <h3>{!! $meta->getMeta('who_we_are_title') !!}</h3>
        <div class="textblock_contain">
            <p>{!! $meta->getMeta('who_we_are_content') !!}</p>
            <div class="row">
                <div class="col-sm-4">
                    {!! $meta->getMeta('who_we_are_info') !!}
                </div>
                <div class="col-sm-offset-4 col-sm-4">
                    <h5>{!! $meta->getMeta('who_we_are_call') !!}</h5>
                    <a href="" data-toggle="modal" data-target="#myModal">{!! $meta->getMeta('who_we_are_button') !!}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="about">
    <div class="container">
        <h3>{!! $meta->getMeta('why_us_title') !!}</h3>
        <img src="/assets/lp/images/border12.png" alt="">
        <div class="row about_block_marg">
            <div class="col-sm-6">
                <div class="about_block">
                    <img src="/assets/lp/images/aboutic_1.png" alt="">
                    <p>{!! $meta->getMeta('why_us_step_1') !!} </p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="about_block">
                    <img src="/assets/lp/images/aboutic2.png" alt="">
                    <p>{!! $meta->getMeta('why_us_step_2') !!}</p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="about_block">
                    <img src="/assets/lp/images/aboutic3.png" alt="">
                    <p>{!! $meta->getMeta('why_us_step_3') !!}</p>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="about_block">
                    <img src="/assets/lp/images/aboutic4.png" alt="">
                    <p>{!! $meta->getMeta('why_us_step_4') !!}</p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="credit">
    <div class="container">
        <h3>{!! $meta->getMeta('conditions_title') !!}</h3>
        <img class="credit_img" src="/assets/lp/images/border12.png" alt="">
        <div class="row">
            @foreach($conditions as $item)
            <div class="col-sm-6">
                <div class="credit_block">
                    <img src="{{$item->image}}" alt="">
                    <h3> {{$item->title}} </h3>
                    <h4>{{$item->subtitle}}</h4>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<section class="credit_benefis">
    <div class="container">
        <h3>{!! $meta->getMeta('benefits_title') !!}</h3>
        <img class="benefis_img" src="/assets/lp/images/border12.png" alt="">
        <div class="row">

            <div class="col-sm-offset-1 col-sm-2">
                <img class="img-responsive" src="/assets/lp/images/icon8_1.png" alt="">
                <span>{!! $meta->getMeta('benefits_step_1') !!}</span>
            </div>
            <div class="col-sm-2">
                <img class="img-responsive credit_arrow hidden-xs" src="/assets/lp/images/arrow_1.png" alt="">
            </div>
            <div class="col-sm-2">
                <img class="img-responsive" src="/assets/lp/images/icon82.png" alt="">
                <span>{!! $meta->getMeta('benefits_step_2') !!}</span>
            </div>
            <div class="col-sm-2">
                <img class="img-responsive credit_arrow hidden-xs" src="/assets/lp/images/arrow_1.png" alt="">
            </div>
            <div class="col-sm-2">
                <img class="img-responsive" src="/assets/lp/images/icon83.png" alt="">
                <span>{!! $meta->getMeta('benefits_step_3') !!}</span>
            </div>
            <div class="col-sm-2">
                <img class="img-responsive" src="/assets/lp/images/icon84.png" alt="">
                <span>{!! $meta->getMeta('benefits_step_4') !!}</span>
            </div>
            <div class="col-sm-2">
                <img class="img-responsive credit_arrow hidden-xs" src="/assets/lp/images/arrow_2.png" alt="">
            </div>
            <div class="col-sm-2">
                <img class="img-responsive" src="/assets/lp/images/icon85.png" alt="">
                <span>{!! $meta->getMeta('benefits_step_5') !!}</span>
            </div>
            <div class="col-sm-2">
                <img class="img-responsive credit_arrow hidden-xs" src="/assets/lp/images/arrow_2.png" alt="">
            </div>
        </div>
        <a href="" data-toggle="modal" data-target="#myModal">{!! $meta->getMeta('benefits_button') !!}</a>
    </div>
</section>
<section class="partners">
    <div class="container">
        <h3>{!! $meta->getMeta('benefits_button') !!}</h3>
        <img src="/assets/lp/images/border12.png" alt="">
        <div class="partners_block">
            {!! $meta->getMeta('partners_body') !!}
        </div>
        <h4>{!! $meta->getMeta('partners_img_title') !!}</h4>
        <div class="row">
            @foreach($partners as $item)
                <div class="col-sm-2 col-xs-6">
                    <img class="img-responsive" src="{!! $item->image !!}" alt="">
                </div>
            @endforeach
        </div>
    </div>
</section>
<section class="faq">
    <div class="container">
        <h3>{!! $meta->getMeta('questions_title') !!}</h3>
        <img src="/assets/lp/images/border12.png" alt="">
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php $i=1; ?>
            @foreach($questions as $item)
                <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading{{$item->id}}">
                        <h4 class="panel-title">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$item->id}}"
                               aria-expanded="@if($i == 1)true @else false @endif" aria-controls="collapseOne">
                                <i class="more-less glyphicon glyphicon-plus"></i>
                                {{$item->title}}
                            </a>
                        </h4>
                    </div>
                    <div id="collapse{{$item->id}}" class="panel-collapse collapse @if($i == 1)in @endif" role="tabpanel" aria-labelledby="heading{{$item->id}}">
                        <div class="panel-body">
                            {!! $item->body !!}
                        </div>
                    </div>
                </div>
                <?php $i++; ?>
            @endforeach
        </div>
    </div>
</section>
<div id="map" style="width:100%;height:500px;"></div>
<section class="last_section">
    <div class="container">
        <img src="/assets/lp/images/logo2.png" alt="">
        <div class="row">
            <div class="col-sm-4">
                <h3>{{$meta->getMeta('footer_adress')}}</h3>
                <span><img src="/assets/lp/images/4_1.png" alt="">{!! settings()->getOption('support::adress') !!}</span>
            </div>
            <div class="col-sm-4">
                <h3>{{$meta->getMeta('footer_contacts')}}</h3>
                <span><img src="/assets/lp/images/4_2.png" alt="">{!! settings()->getOption('support::home') !!}</span>
                <span><img src="/assets/lp/images/4_2.png" alt="">{!! settings()->getOption('support::mobile') !!}</span>
            </div>
            <div class="col-sm-4">
                <h3>{{$meta->getMeta('footer_program')}}</h3>
                <span>{!! settings()->getOption('support::program') !!}</span>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-5">
                <h3>{{$meta->getMeta('footer_banc')}}</h3>
                <span>{!! settings()->getOption('support::banc') !!}</span>
            </div>
            <div class="col-sm-offset-3 col-sm-3">
                <span><img src="/assets/lp/images/4_4.png" alt="">{!! settings()->getOption('admin::email') !!}</span>
                <ul class="last_social">
                    <li><a href="{!! settings()->getOption('support::facebook') !!}" target="_blank"><img
                                    src="/assets/lp/images/ic_f.png" alt=""></a></li>
                    <li><a href="{!! settings()->getOption('support::linkedin') !!}" target="_blank"><img
                                    src="/assets/lp/images/l.png" alt=""></a></li>
                    <li><a href="{!! settings()->getOption('support::viber') !!}" target="_blank"><img src="/assets/lp/images/v.png" alt=""></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="last_about">
        <div class="container">
            <a href="http://marsala.md/" target="_blank"><span>Built with <img src="/assets/lp/images/heart.png" alt="">
                    by
           <img src="/assets/lp/images/marsala.png" alt="WeAreMarsala" style="margin-left:-15px;"></span></a>
        </div>
    </div>
</section>
<footer>
</footer>
<!-- Modal -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="first_contacts_color"></div>
                <div class="first_contacts_form">
                    <h3>{!! $meta->getMeta('modal_title') !!}</h3>
                    <span><img src="/assets/lp/images/ic_phone.png" alt="">{!! settings()->getOption('support::mobile') !!}</span>
                    <span><img src="/assets/lp/images/ic_pin.png" alt="">{!! settings()->getOption('admin::email') !!}</span>
                    {!! $meta->getMeta('modal_info') !!}
                    <form method="POST">
                        {{csrf_field()}}
                        <div class="first_inp">
                            <input type="text" name="name" placeholder="Nume Prenume" required>
                            <img src="/assets/lp/images/ic_1.png" alt="">
                        </div>
                        <div class="first_inp">
                            <input type="text" name="email" placeholder="Email" required>
                            <img src="/assets/lp/images/ic_2.png" alt="">
                        </div>
                        <div class="first_inp">
                            <input type="text" name="phone" placeholder="Telefon" required>
                            <img src="/assets/lp/images/ic_3.png" alt="">
                        </div>
                        <input class="send_contact_form" type="submit" value="{!! $meta->getMeta('modal_button') !!}">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end modal -->
<script type="text/javascript" src="/assets/lp/js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="/assets/lp/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/assets/lp/js/main-scripts.js"></script>

{!!Html::script('/assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}
{!!Html::script('/assets/plugins/jquery-validation/dist/additional-methods.min.js')!!}
<script src='/assets/plugins/jquery-validation/src/localization/messages_{{App::getLocale()}}.js'
        type="text/javascript"></script>
{!!Html::script('/assets/plugins/qtip/jquery.qtip.min.js')!!}
{!!Html::script('/assets/plugins/plupload/js/plupload.full.min.js')!!}
{!!Html::script('/assets/plugins/toastr/toastr.min.js')!!}
{!!Html::script('/assets/plugins/loading-overlay/src/loadingoverlay.min.js')!!}

<script>
    $('.send_contact_form').click(function(e){
        e.preventDefault();
        var $this = $(this).parents('form');
       var form = $(this).parents('form').serialize();
        $.ajax({
           method:'POST',
            url: '{{route('send_modal_data')}}',
            data:form,
            dataType: 'json',
            success : function(data) {
                if (data.error) {
                    $.each(data.error, function( key, value ) {
                        $this.find('input[name='+value+']').css('border','1px solid red');
                    });
                } else {
                    $('#myModal').modal('hide');
                    toastr.success('Mesajul a fost trimis!');
                }
            }
        });


    });
</script>

<script>

    $(document).ready(function () {
        var uploader = new plupload.Uploader({
            runtimes: 'gears,html5,flash,silverlight',
            multi_selection: false,
            unique_names: true,
            browse_button: 'pickfiles', // you can pass an id...
            container: document.getElementById('container-file'), // ... or DOM Element itself
            url: "{{route('upload_form_file')}}",
            chunk_size: '200kb',
            max_retries: 3,
            flash_swf_url: '/assets/plugins/plupload/js/Moxie.swf',
            silverlight_xap_url: '/assets/plugins/plupload/js/Moxie.xap',
            multipart: true,
            max_files: 3,
            headers: {
                'X-CSRF-TOKEN': '{{csrf_token()}}'
            },

            filters: {
                max_file_size: '10mb',
                mime_types: [
                    {title: "Image files", extensions: "jpg,jpeg,png,pdf,doc,docx"},
                ]
            },
            init: {
                PostInit: function () {
                    document.getElementById('filelist').innerHTML = '';
                    document.getElementById('uploadfiles').onclick = function () {
                        uploader.start();
                        return false;
                    };
                },
                FilesAdded: function (up, files) {
                    uploader.refresh();
                    if (up.files.length <= up.settings.max_files) {
                        $('#input-pickfiles').val(up.files.length).valid();
                        plupload.each(files, function (file) {
                            document.getElementById('filelist').innerHTML += '<div id="' + file.id + '" data-name="">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b> <a href="#" class="removeFile" >Delete</a></div>';
                        });
                        up.start();
                    } else {
                        alert('Cannot send more than ' + up.settings.max_files + ' file(s).');
                        return false;
                    }
                },
                FileUploaded: function (up, file) {
                    $('.btn-send-form').removeAttr('disabled');
                    $('#' + file.id).attr('data-name', file.target_name);
                },
                BeforeUpload: function (up, file) {
                    up.settings.multipart_params = {fileid: file.id}
                    $('.btn-send-form').attr('disabled', true);
                },
                UploadProgress: function (up, file) {
                    $('#' + file.id + ' b').html('<span>' + file.percent + "%</span>");
                    //document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                },
                Error: function (up, err) {
                    console.log("\nError #" + err.code + ": " + err.message);
                    //document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
                }
            }
        });
        uploader.init();

        if (($(".lp-form").length != 0)) {
            var form = $(".lp-form");
            var validator = form.validate({
                onkeyup: true,
                errorClass: 'error',
                validClass: 'valid',
                debug: false,
                onsubmit: true,
                onfocusout: false,
                onkeyup: function (element) {
                    $(element).valid()
                },
                errorPlacement: function (error, element) {
                    // Set positioning based on the elements position in the form
                    var elem = $(element);
                    if ($(elem).hasClass('file-count')) elem = $('.pickfiles');

                    //console.log(elem);
                    // Check we have a valid error message
                    if (!error.is(':empty')) {
                        // Apply the tooltip only if it isn't valid
                        elem.filter(':not(.valid)').qtip({
                            overwrite: true,
                            content: error,
                            position: {
                                my: 'left top',
                                at: 'right bottom',
                                viewport: $(window),
                                adjust: {
                                    method: 'shift none'
                                }
                            },
                            show: {
                                event: 'click focus mouseenter',
                                ready: true,
                                solo: true,
                            },
                            hide: {
                                event: 'mouseleave',
                                ready: true,
                                solo: true,
                            },
                            style: {
                                classes: 'qtip-red qtip-shadow' // Make it red... the classic error colour!
                            }
                        }) // If we have a tooltip on this element already, just update its content
                                .qtip('option', 'content.text', error);
                    } // If the error is empty, remove the qTip
                    else {
                        elem.qtip('destroy');
                    }
                },
                success: $.noop,
                submitHandler: function (form) {
                    //if (!inProcces) {
                    $.ajax({
                        data: $(form).serialize(),
                        url: "{{route("send_form_email")}}",
                        method: 'POST',
                        beforeSend: function () {
                            inProcces = true;
                            $.LoadingOverlay("show");
                        },
                        success: function (response) {
                            $(form)[0].reset();
                            $('#filelist > div').remove();
                            toastr.success('Cererea a fost expediata cu succes!');
                            console.log(response);
                            uploader.splice();
                            uploader.refresh();
                            /*if (response.clientFound) {
                             $('#name').val(response.result.name);
                             $('#surname').val(response.result.surname);
                             $('#phoneCell').val(response.result.phoneCell);
                             $('#loanLimitSum').val(response.result.loanLimitSum).parents('div.row').show();
                             }*/
                        }
                    }).done(function (msg) {
                        $.LoadingOverlay("hide");
                        inProcces = false;
                    });
                    //}
                    return false;
                }
            });
        }

        var inProcces = false;
        $("body").delegate(".removeFile", "click", function (e) {
            e.preventDefault();
            var name = $(this).parent().data('name');
            var id = $(this).parent().attr('id');
            if (!inProcces && name != '') {
                $.ajax({
                    data: {name: name, id: id},
                    url: "{{route("remove_form_file")}}",
                    method: 'POST',
                    beforeSend: function () {
                        inProcces = true;
                    },
                    success: function (response) {
                        console.log(response);
                        //Materialize.toast('Success', 2000, 'green');
                    }
                }).done(function (msg) {
                    inProcces = false;
                });
            }
            uploader.removeFile(uploader.getFile(id));
            //uploader.splice(id,1);
            uploader.refresh();
            var count_file = uploader.files.length;
            $('.file-count').val(count_file == 0 ? '' : count_file).valid();
            $('#' + id).remove();
        });
    });

    function myMap() {
        var mapCanvas = document.getElementById("map");
        var myCenter = new google.maps.LatLng(47.0385524, 28.881771);
        var mapOptions = {
            center: myCenter,
            zoom: 17,
            navigationControl: false,
            mapTypeControl: false,
            scaleControl: false,
            draggable: true,
            scrollwheel: false
        };
        var map = new google.maps.Map(mapCanvas, mapOptions);
        var marker = new google.maps.Marker({
            position: myCenter,
            animation: google.maps.Animation.BOUNCE
        });
        marker.setMap(map);
    }
</script>
<script>
    function showMe(box, id) {
        var chboxs = document.getElementsByName(id);
        var vis = "20px";
        for (var i = 0; i < chboxs.length; i++) {
            if (chboxs[i].checked) {
                vis = "auto";
                break;
            }
        }
        document.getElementById(box).style.height = vis;
    }

</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBlgmKQKmSjXm0XxCGu0UM5Hf59sQydmRY&callback=myMap"></script>
<!-- BEGIN JIVOSITE CODE {literal} -->
<script type='text/javascript'>
    (function () {
        var widget_id = 'M8vmNFVQFr';
        var d = document;
        var w = window;

        function l() {
            var s = document.createElement('script');
            s.type = 'text/javascript';
            s.async = true;
            s.src = '//code.jivosite.com/script/geo-widget/' + widget_id;
            var ss = document.getElementsByTagName('script')[0];
            ss.parentNode.insertBefore(s, ss);
        }

        if (d.readyState == 'complete') {
            l();
        } else {
            if (w.attachEvent) {
                w.attachEvent('onload', l);
            } else {
                w.addEventListener('load', l, false);
            }
        }
    })();</script>
<!-- {/literal} END JIVOSITE CODE -->

</html>
