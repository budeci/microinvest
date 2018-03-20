@extends('layout')

@section('content')
    <div class="container">
        <div class="main bg-white">
            @include('aplication.partials.info')
            @if(session()->has('success'))
                <div class="row">
                    <div class="col">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" data-dismiss="alert" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-check" aria-hidden="true"></i>
                            {{trans('app.thx')}}                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <legend class="text-center">{{trans('app.statusApps')}}</legend><br>
                    <div class="table-responsive">
                        <table class="table table-hover agreement">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>{{trans('app.data')}}</th>
                                    <th>{{trans('app.nameClient')}}</th>
                                    <th width="100">{{trans('app.sumaContract')}}</th>
                                    <th width="140">{{trans('app.scopCredit')}}</th>
                                    <th width="120">{{trans('app.limitApproved')}}</th>
                                    <th width="150">{{trans('app.comment')}}</th>
                                    <th>{{trans('app.statusApp')}}</th>
                                    <th>{{trans('app.dealer')}}</th>
                                    <th width="100">{{trans('app.files')}}</th>
                                    <th>{{trans('app.faq')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($apps as $item)
                                    <?php
                                        $loading = '';
                                        $status = '';
                                        $ico = '';
                                        $statusText = '';
                                    ?>
                                    
                                    @if($item->applicationStateCode == '0')
                                        <?php
                                            $status = 'warning';
                                            $ico    = '<i class="text-warning fa fa-spinner fa-pulse fa-fw" aria-hidden="true"></i>';
                                            $loading = 'loading';
                                            $statusText = trans('app.appStatePending');
                                        ?>
                                    @elseif($item->applicationStateCode == '1')
                                        <?php
                                            $status = 'success';
                                            $ico    = '<i class="text-success fa fa-check fa-fw" aria-hidden="true"></i>';
                                            $statusText = trans('app.appStateAccept');
                                        ?>
                                    @else
                                        <?php
                                            $status = 'danger';
                                            $ico    = '<i class="text-danger fa fa-ban fa-fw" aria-hidden="true"></i>';
                                            $statusText = trans('app.appStateDeclined');
                                        ?>
                                    @endif
                                    <?php $appFiles = array(); ?>
                                    @if(!empty((array)$item->applicationFileSet))
                                        @if(count($item->applicationFileSet->applicationFile) == 1)
                                            <?php $appFiles = array($item->applicationFileSet->applicationFile); ?>
                                        @else
                                            <?php $appFiles = $item->applicationFileSet->applicationFile; ?>
                                        @endif
                                    @endif
                                    <tr>
                                        <td>{!!$ico!!} <input class="{{$loading}}" data-state-code="{{$item->applicationStateCode}}" type="hidden" value="{{$item->id}}"></td>
                                        <td>{{$item->date}}</td>
                                        <td>{{$item->client->name}}</td>
                                        <td>{{$item->loanAmount}} {{config('app.currency.'.$item->loanCurrency)}}</td>
                                        <td><p class="showmore comment" data-show-lg="20" data-moretext=">>>" data-lesstext="<<<">{{$item->loanPurpose}}</p></td>
                                        <td> 
                                            @if($item->limitApproved)
                                                {{$item->limitApproved}} {{config('app.currency.'.$item->limitCurrency)}}
                                            @endif
                                        </td>
                                        <td><p class="showmore comment" data-show-lg="20" data-moretext=">>>" data-lesstext="<<<">{{$item->comment}}</p></td>
                                        <td><span class="btn btn-{{$status}} btn-block btn-sm">{{$statusText}}</span></td>
                                        <td>{{$item->dealer->name}}</td>
                                        <td>
                                            @foreach ($appFiles as $file)
                                                <a href="{{ route('get_app_file', ['name' => $file->name, 'id' => $item->id]) }}" title="{{$file->name}}" class="showmore file" data-show-lg="10" data-moretext="" data-lesstext="">{{$file->name}}</a><br>
                                            @endforeach
                                        </td>
                                        <td>
                                            <a href="{{ route('faq') }}" target="_blank" class="text-success"><i class="fa fa-question-circle-o fa-2x" aria-hidden="true"></i></a>                                        
                                        </td>    
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    {!!Html::script('/assets/plugins/jquery-ui/jquery-ui.min.js')!!}
    {!!Html::script('/assets/plugins/jquery-color/jquery.color.js')!!}
    @include('aplication.partials.js')
    {!!Html::script('/assets/plugins/plupload/js/plupload.full.min.js')!!}
    <script>
    $(document).ready( function(){
        if ($('.js-upload-files').length) {
            var uploader = new plupload.Uploader({
                runtimes : 'gears,html5,flash,silverlight',
                multi_selection: false,
                unique_names: true,
                browse_button : 'pickfiles', // you can pass an id...
                container: $('.js-upload-files'), // ... or DOM Element itself
                url : "{{route('upload_file')}}",
                chunk_size: '200kb',
                max_retries: 3,
                flash_swf_url : '/assets/plugins/plupload/js/Moxie.swf',
                silverlight_xap_url : '/assets/plugins/plupload/js/Moxie.xap',
                multipart: true,
                max_files: 5,
                headers: {
                    'X-CSRF-TOKEN': '{{csrf_token()}}'
                },
                
                filters : {
                    max_file_size : '10mb',
                    mime_types: [
                        {title : "Image files", extensions : "jpg,jpeg,png,pdf,doc,docx"},
                    ]
                },
                init: {
                    PostInit: function(up) {
                        console.log(up);
                        document.getElementById('filelist').innerHTML = '';
                        document.getElementById('uploadfiles').onclick = function() {
                            uploader.start();
                            return false;
                        };
                    },
                    FilesAdded: function(up, files) {
                        uploader.refresh();
                        if(up.files.length <= up.settings.max_files){
                            plupload.each(files, function(file) {
                                document.getElementById('filelist').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b> <a href="#" class="removeFile" >Delete</a></div>';
                            });
                            up.start();
                        }else{
                            alert('Cannot send more than ' + up.settings.max_files + ' file(s).'); 
                            return false;
                        }
                    },
                    FileUploaded: function(up, file) {
                        $('.btn-send-app').removeAttr('disabled');
                    },
                    BeforeUpload: function(up, file) {
                        up.settings.multipart_params = {fileid: file.id}
                    $('.btn-send-app').attr('disabled', true);
                    },
                    UploadProgress: function(up, file) {
                        $('#'+file.id+' b').html('<span>' + file.percent + "%</span>");
                        //document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = '<span>' + file.percent + "%</span>";
                    },
                    Error: function(up, err) {
                        console.log("\nError #" + err.code + ": " + err.message);
                        //document.getElementById('console').appendChild(document.createTextNode("\nError #" + err.code + ": " + err.message));
                    }
                }
            });
            uploader.init();
        }

        var inProcces = false, html = '', tr = '';
        setInterval(function(){

            if (!inProcces) {
                $.ajax({
                    url: "{{route("get_apps")}}",
                    method: 'POST',
                    //data:{appId:curent.val()},
                    beforeSend: function(){
                        inProcces = true;
                    },
                    success: function (response) {
                        //console.log(response);
                        $.each(response.result, function(index, app) {
                            var curentApp = $('input[value="'+app.id+'"]'), tr = '',files = '';

                            if (app.applicationStateCode != curentApp.data('state-code')) {

                                if(app.applicationStateCode == '0'){
                                    status = 'warning';
                                    color  = '#f0ad4e';
                                    ico    = '<i class="text-warning fa fa-spinner fa-pulse fa-fw" aria-hidden="true"></i>';
                                }else if(app.applicationStateCode == '1'){
                                    status = 'success';
                                    color  = '#5cb85c';
                                    ico    = '<i class="text-success fa fa-check fa-fw" aria-hidden="true"></i>';
                                }else{
                                    status = 'danger';
                                    color  = '#c9302c';
                                    ico    = '<i class="text-danger fa fa-ban fa-fw" aria-hidden="true"></i>';
                                }
                                appFiles = [];
                                if(app.applicationFileSet && app.applicationFileSet.applicationFile != undefined){
                                    if(app.applicationFileSet.applicationFile.length > 1){
                                        appFiles = app.applicationFileSet.applicationFile;
                                    }else{
                                        appFiles = new Array(app.applicationFileSet.applicationFile);
                                    }
                                }
                                var route = "{{ route('get_app_file') }}";
                                $.each(appFiles, function(index, file) {
                                    files += "<a href="+route+'/'+file.name+'/'+app.id+" title="+file.name+" class='showmore file' data-show-lg='10' data-moretext='' data-lesstext=''>"+file.name+"</a><br>";
                                });
                                html = "<td>"+ico+"<input type='hidden' data-state-code="+app.applicationStateCode+" value="+app.id+"></td>"+
                                        "<td>"+app.date+"</td>"+
                                        "<td>"+app.client.name+"</td>"+
                                        "<td>"+app.loanAmount+" "+app.loanCurrencyCode+"</td>"+
                                        "<td><p class='showmore comment' data-show-lg='20' data-moretext='>>>' data-lesstext='<<<'>"+app.loanPurpose+"</p></td>"+
                                        "<td><p class='showmore comment' data-show-lg='20' data-moretext='>>>' data-lesstext='<<<'>"+app.comment+"</p></td>"+
                                        "<td><span class='btn btn-"+status+" btn-block btn-sm'>"+app.applicationStateCode+"</span></td>"+
                                        "<td>"+app.dealer.name+"</td>"+
                                        "<td>"+files+"</td>";

                                var tr = curentApp.parents('tr').html(html).animate({
                                    backgroundColor: color,
                                    color: "#fff"
                                }, 1500).addClass('animation-color');

                                showMore(tr.find('.showmore'));

                                setTimeout(function(){
                                        $('tr.animation-color').animate({
                                            backgroundColor: "#fff",
                                            color: "#292b2c"
                                        }, 1500);

                                }, 3000);

                            }
                        });
                    }
                }).done(function( msg ) {
                    inProcces = false;
                    
                });
            }

        },30000);
    });
    </script>
@endsection