@extends('layout')

@section('content')
    <div class="container">
        <div class="main bg-white">
            @php ($title = trans('app.creditAuto'))
            @include('aplication.partials.info')
            @if(session()->has('success'))
                <div class="row">
                    <div class="col">
                        <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" data-dismiss="alert" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <i class="fa fa-check" aria-hidden="true"></i>
                            {{trans('app.thx')}}
                        </div>
                    </div>
                </div>
            @endif
            @include('notification.errors.list')

            <div class="row">
                <div class="col-md-12">
                    <form action="{{route('app_credit_auto_post')}}" method="POST" id="form-aplication-dealer" class="form-aplication-dealer" enctype="multipart/form-data">
                        <div class="js-calc-payment">                        
                            <div class="row">
                                <div class="col-md-12">
                                    <legend>{{trans('app.calcRata')}}</legend>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>{{trans('app.loanProductID')}} <span class="text-danger">*</span></label>
                                    <select name="app[loanProductID]" required class="js-product form-control custom-select">
                                        @foreach($loanProduct as $item)
                                            <option {{ old('app.loanProductID') ? 'selected' : '' }} value="{{ $item['id'] }}">{{ $item['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>{{trans('app.fullPrice')}} <span class="text-danger">*</span></label>
                                    <input value="{{ old('app.totalCost') }}" id="totalCost" name="app[loanPurposeRows][totalCost]" type="number" data-translate="{{trans('app.max')}} {sum}" data-placeholder="{{trans('app.max')}} 100000 " placeholder="{{trans('app.max')}} 100000 {{trans('app.euro')}}" class="js-amount form-control" required min="2000" max="100000" data-currency="{{trans('app.euro')}}" data-min="2000" data-max="100000">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>{{trans('app.currency')}}:<span class="text-danger">*</span></label>
                                    <select name="app[currency]" class="js-currency form-control custom-select currency-calc" required>
                                        @foreach(Config::get('app.currency') as $key => $item)
                                            <option {{ old('calc.currency') ? 'selected' : '' }} value="{{ $key }}">{{ $item }}</option>
                                        @endforeach
                                    </select>
                               </div>
                                {!! csrf_field() !!}
                            </div>
                            <div class="row">
                                <div class="col-md-3 form-group">
                                    <label>{{trans('app.clientContribution')}}:</label>
                                    <input value="{{ old('app.clientContribution') }}" name="app[loanPurposeRows][clientContribution]" type="number" placeholder="{{trans('app.euro')}}" class="js-currency-placeholder js-contribution form-control" required min="0" max="500000">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>{{trans('app.sumCredit')}}:</label>
                                    <input value="" name="" type="number" placeholder="{{trans('app.euro')}}" readonly class="js-sum-credit js-currency-placeholder form-control" min="0" max="500000">
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>{{trans('app.term')}} <span class="text-danger">*</span></label>
                                    <input value="{{ old('app.creditTerm') }}" name="app[creditTerm]" type="number" class="js-term form-control" data-translate="{{trans('app.max')}} {term} {{trans('app.months')}}" placeholder="{{trans('app.max')}} 60 {{trans('app.months')}}" required min="3" max="60" data-min="3" data-max="60">
                                </div>  
                                <div class="col-md-3 form-group">
                                    <label class="calc-label">&nbsp;</label>
                                    <button data-action="{{route('getPaymentSchedule')}}" type="button" class="js-btn-calc-payment btn btn-success btn-calc btn-block" data-loading-text="<i class='fa fa-spinner fa-spin '></i>">{{trans('app.calcRata')}}</button>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="payment-schedule-response">
                            <div class="col js-schendule-error" style="display: none;">
                                <h5 class="text-danger">{{trans('app.checkParams')}}</h5>
                            </div>

                            <div class="col js-schendule-success" style="display: none;">
                                <h5>{{trans('app.paymentMonthly')}}</h5>
                                <div class="js-schendule table-responsive schendule">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <!-- <th>#</th> -->
                                                <th>{{trans('app.termen')}}</th>
                                                <th>{{trans('app.rateMonthly')}}</th>
                                                <!-- <th>Costul creditului</th> -->
                                                <th>{{trans('app.totalAmount')}}</th>
                                                <th title="{{trans('app.effectiveRate')}}">{{trans('app.dae')}}</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <legend>{{trans('app.infoSolicitant')}}</legend>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>{{trans('app.idnp')}} <span class="text-danger">*</span></label>
                                <input autocomplete="off" value="{{ old('app.idno') }}" name="app[idno]" id="idno" type="text" placeholder="" class="not-found form-control" required minlength="13" maxlength="13">
                            </div>
<!--                             <div class="col-md-2 form-group">
    <label>Data Nasteșterii:</label>
    <div class='input-group date' id='datetimepicker'>
        <input value="{{ old('app.birthDate') }}" type="text" class="form-control" name="app[birthDate]" readonly required>
        <span class="input-group-addon">
            <i class="fa fa-calendar" aria-hidden="true"></i>
        </span>
    </div>
</div> -->
                            <div class="col-md-3 form-group" style="display: none;">
                                <label style="visibility: hidden;">Verifică</label>
                                <button id="check-dealer" data-loading-text="Loading..." type="button" class="btn btn-success btn-block" autocomplete="off">Verifică</button>
                            </div>

                            <div class="col-md-3 form-group">
                                <label>{{trans('app.name')}} <span class="text-danger">*</span></label>
                                <input value="{{ old('app.name') }}" id="name" name="app[name]" type="text" placeholder="" class="not-found form-control" required minlength="3" maxlength="30">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{trans('app.surname')}} <span class="text-danger">*</span></label>
                                <input value="{{ old('app.surname') }}" id="surname" name="app[surname]" type="text" placeholder="" class="not-found form-control" required minlength="3" maxlength="30">
                            </div>
{{--                              <div class="col-md-3 form-group">
                                <label>{{trans('app.patronymic')}} <span class="text-danger">*</span></label>
                                <input value="{{ old('app.Patronymic') }}" id="surname" name="app[Patronymic]" type="text" placeholder="" class="not-found form-control" required minlength="3" maxlength="30">
                            </div>  --}}
                            <div class="col-md-3 form-group">
                                <label>{{trans('app.gsm')}} <span class="text-danger">*</span></label>
                                <input value="{{ old('app.phoneCell') }}" id="phoneCell" name="app[phoneCell]" type="text" placeholder="" class="not-found form-control" required minlength="6" maxlength="13">
                            </div>
{{--                              <div class="col-md-3 form-group">
                                <label>{{trans('app.fix')}}</label>
                                <input value="{{ old('app.phoneHome') }}" id="phoneHome" name="app[phoneHome]" type="text" placeholder="" class="not-found form-control" minlength="6" maxlength="13">
                            </div>  --}}
                        </div>
                        <div class="row" style="display: none;">
                            <div class="col-md-3 form-group">
                                <label>{{trans('app.limitCredit')}}:</label>
                                <span style="display: none;" class="help-block small text-danger" style="font-size: 9px;"><em>{{trans('app.limitCredit')}}</em></span>
                                <div class="input-group">
                                    <input value="" id="loanLimitSum" type="text" readonly placeholder="" class="not-found form-control">
                                    <span class="js-currency-limit-sum input-group-addon">EUR</span>
                                </div>
                            </div>
                        </div>
                        <div class="row js-alert" id="js-result-client-error" id="js-alert" style="display: none;">
                            <div class="col-xs-7">
                                <div class="alert alert-sm alert-danger alert-dismissible" role="alert">
                                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> Nu există informație despre solicitant, completați datele mai jos.
                                </div>
                            </div>
                        </div>
                        <div class="row js-alert result-client" id="js-result-client-success" style="display: none;">
                            <div class="col-xs-7">
                                <div class="alert alert-sm alert-success alert-dismissible" role="alert">
                                    <button type="button" class="close" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <span class="glyphicon glyphicon-ok" aria-hidden="true"></span><a href="">Ion Ion</a>
                                </div>
                            </div>
                        </div>
                        <legend>{{trans('app.scopCredit')}}</legend>
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>{{trans('app.linkAnunt')}}</label>
                                <textarea value="{{ old('app.partnerComment') }}" name="app[partnerComment]" placeholder="" rows="3" class="form-control" minlength="3" maxlength="1000"></textarea>
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{trans('app.branch')}}: <span class="text-danger">*</span></label>
                                <select name="app[branchID]" required class="form-control">
                                    @foreach($getBranch as $branch)
                                        <option {{ old('app.branchID') ? 'selected' : '' }} value="{{ $branch->id }}">{{ $branch->name != '' ? $branch->name : $branch->address }}</option>
                                    @endforeach
                                </select>
                            </div>
{{--                              
                            <div class="col-md-3 form-group">
                                <label>{{trans('app.loanPurpose')}} <span class="text-danger">*</span></label>
                                <input value="{{ old('app.loanPurpose') }}" name="app[loanPurposeRows][loanPurpose]" type="text" placeholder="" class="form-control" required minlength="3" maxlength="100">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{trans('app.brand')}}:</label>
                                <input value="{{ old('app.Brand') }}" name="app[Brand]" type="text" placeholder="" class="form-control" minlength="3" maxlength="100">
                            </div>
                           
                            <div class="col-md-3 form-group">
                                <label>{{trans('app.model')}}:</label>
                                <input value="{{ old('app.Model') }}" name="app[Model]" type="text" placeholder="" class="form-control" minlength="3" maxlength="100">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{trans('app.yearAuto')}}:</label>
                                <input value="{{ old('app.YearOfManufacture') }}" name="app[YearOfManufacture]" type="number" placeholder="" class="form-control" minlength="3" maxlength="100">
                            </div>
--}}
                        </div>

                        <legend class="guarantor guarantor-none">Datele fidejusorilor</legend>
                        <div class="row guarantor guarantor-none">
                            <div class="col-md-3 form-group">
                                <label>Fidejusor IDNP:</label>
                                <input autocomplete="off" value="{{ old('app.guarantorIDNO') }}" name="app[guarantorIDNO]" type="text" placeholder="" class="form-control" required minlength="13" maxlength="13">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Fidejusor Nume:</label>
                                <input value="{{ old('app.guarantorName') }}"  name="app[guarantorName]" type="text" placeholder="" class="form-control" required minlength="3" maxlength="30">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Fidejusor Prenume:</label>
                                <input value="{{ old('app.guarantorSurname') }}" name="app[guarantorSurname]" type="text" placeholder="" class="form-control" required minlength="3" maxlength="30">
                            </div>
                        </div>
                        <legend>{{trans('app.infoPersContact')}}</legend>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label>{{trans('app.contactFirst')}}</label>
                                <input value="{{ old('app.contactFirst') }}" name="app[contactFirst]" type="text" placeholder="" class="form-control" minlength="3" maxlength="30">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>{{trans('app.contactLast')}}</label>
                                <input value="{{ old('app.contactLast') }}" name="app[contactLast]" type="text" placeholder="" class="form-control" minlength="3" maxlength="30">
                            </div>
{{--                              <div class="col-md-3 form-group">
                                <label>{{trans('app.patronymic')}}:</label>
                                <input value="{{ old('app.contactPatronymic') }}" name="app[contactPatronymic]" type="text" placeholder="" class="form-control" minlength="3" maxlength="30">
                            </div>  --}}
                            <div class="col-md-3 form-group">
                                <label>{{trans('app.gsm')}}</label>
                                <input value="{{ old('app.contactPhoneCell') }}" name="app[contactPhoneCell]" type="text" placeholder="" class="form-control" minlength="6" maxlength="13">
                            </div>
{{--                              <div class="col-md-3 form-group">
                                <label>{{trans('app.fix')}}</label>
                                <input value="{{ old('app.contactPhoneHome') }}" name="app[contactPhoneHome]" type="text" placeholder="" class="form-control" minlength="6" maxlength="13">
                            </div>  --}}
                            {{--  <div class="col-md-3 form-group">
                                <label>{{trans('app.partnerComment')}}</label>
                                <textarea value="{{ old('app.partnerComment') }}" name="app[partnerComment]" placeholder="" rows="3" class="form-control" minlength="3" maxlength="1000"></textarea>
                            </div>  --}}
                        </div>
                        <legend style="display: none;">Informații de contact Consultant</legend>
                        <div class="row" style="display: none;">
                            <div class="col-md-3 form-group">
                                <label>Nume:</label>
                                <input value="{{ old('app.nameC') }}" type="text" placeholder="" class="form-control" minlength="3" maxlength="30">
                            </div>
                            <div class="col-md-3 form-group">
                                <label>Telefon:</label>
                                <input value="{{ old('app.phoneC') }}" type="text" placeholder="" class="form-control" minlength="6" maxlength="10" disabled>
                            </div>
                        </div>
{{--                          <legend>{{trans('app.other')}}</legend>
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <div class="form-check">
                                    <label>{{trans('app.pep')}}:</label><br>
                                    <label class="form-check-label">
                                        <input {{ old('app.PEP') == 'true' ? 'checked' : '' }} class="form-check-input" type="radio" name="app[PEP]" value="true">
                                        {{trans('app.yes')}}
                                    </label>
                                    <label class="form-check-label">
                                        <input {{ old('app.PEP') == 'false' ? 'checked' : '' }} class="form-check-input" type="radio" name="app[PEP]" value="false">
                                        {{trans('app.not')}}
                                    </label>
                                </div>
                            </div>
                        </div>  --}}
                        <legend>{{trans('app.infoBuletin')}}</legend>
                        <div class="row">
                            <div class="col">
                                <!-- <input type="file" id="exampleInputFile">
                                <p class="help-block small">Incarcăţi copia buletinului de indentitate – max. 10 MB/fişier. -->
                                    <!--<br>
                                    Atenție! Vă rugăm să încărcați fotocopia buletinul de identitate scanată de pe original, nu de pe xerocopia originalului.
                                </p> -->

                                <div id="filelist">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
                                <div id="container">
                                    <a id="pickfiles" class="btn btn-success btn-sm pickfiles" href="javascript:;">{{trans('app.addFile')}}</a>
                                    <input type="text" name="file-count" class="file-count" id="input-pickfiles" data-child="pickfiles" value="" required data-count="0">
                                    <!-- <input id="pickfiles" multiple="multiple" type="file" id="exampleInputFile"> -->

                                    <a id="uploadfiles" href="javascript:;" style="display: none;">[Upload files]</a>
                                </div>
                                <p class="help-block small">{{trans('app.infoFile')}}</p>
                                <pre id="console" style="display: none;"></pre>

                            </div>
                        </div>
                        <legend>{{trans('app.tehPasport')}}</legend>
                        <div class="row">
                            <div class="col">
                                <div id="filelist-tehPasport">Your browser doesn't have Flash, Silverlight or HTML5 support.</div>
                                <div id="container-tehPasport">
                                    <a id="pickfiles-tehPasport" class="btn btn-success btn-sm pickfiles-tehPasport" href="javascript:;">{{trans('app.addFile')}}</a>
                                    <input type="text" name="file-count-tehPasport" class="file-count-tehPasport" id="input-pickfiles-tehPasport" data-child="pickfiles" value="" required data-count="0">
                                    <!-- <input id="pickfiles" multiple="multiple" type="file" id="exampleInputFile"> -->

                                    <a id="uploadfiles-tehPasport" href="javascript:;" style="display: none;">[Upload files]</a>
                                </div>
                                <p class="help-block small">{{trans('app.infoFileTehPasport')}}</p>
                                <pre id="console-tehPasport" style="display: none;"></pre>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <p class="bg-warning general-info help-block small showmore" data-show-lg="200" data-show-sm="100" data-show-xs="50"  data-moretext=">>> mai multe" data-lesstext="<<< mai puțin">{{trans('app.infoForApp')}}</p>
                                <div class="checkbox conditions small">
                                    <label>
                                        <input {{ old('app.agreementPDprocessing') ? 'checked' : '' }} name="app[agreementPDprocessing]" type="checkbox" required value="true"><span class="help-block showmore" data-show-lg="193" data-show-sm="100" data-show-xs="50"  data-moretext=">>> mai multe" data-lesstext="<<< mai puțin">{{trans('app.agreementPDprocessing')}}</span>
                                    </label>
                                </div>
                                <div class="checkbox conditions small">
                                    <label>
                                        <input {{ old('app.agreementPDstorage') ? 'checked' : '' }} name="app[agreementPDstorage]" type="checkbox" required value="true"><span class="help-block showmore" data-show-lg="195" data-show-sm="100" data-show-xs="50" data-moretext=">>> mai multe" data-lesstext="<<< mai puțin">{{trans('app.agreementPDstorage')}}</span>
                                    </label>
                                </div>
                                <div class="checkbox conditions small">
                                    <label>
                                        <input {{ old('app.agreementCreditHistoryAccess') ? 'checked' : '' }} name="app[agreementCreditHistoryAccess]" type="checkbox" required value="true"><span class="help-block showmore" data-show-lg="195" data-show-sm="100" data-show-xs="50" data-moretext=">>> mai multe" data-lesstext="<<< mai puțin">{{trans('app.agreementCreditHistoryAccess')}}</span>
                                    </label>
                                </div>
                                <div class="checkbox conditions small">
                                    <label>
                                        <input {{ old('app.agreementCreditHistorySending') ? 'checked' : '' }} name="app[agreementCreditHistorySending]" type="checkbox" required value="true"><span class="help-block showmore" data-show-lg="195" data-show-sm="100" data-show-xs="50" data-moretext=">>> mai multe" data-lesstext="<<< mai puțin">{{trans('app.agreementCreditHistorySending')}}</span>
                                    </label>
                                </div>
                                <!--
                                <div class="checkbox conditions small">
                                    <div class="radio-condition">
                                        <label>
                                            <input name="app[creditHistoryCheckAgreement]" id="creditHistoryCheckAgreement" value="true" type="checkbox">Da</label>
                                        <br>
                                        <label>
                                            <input value="" type="checkbox">Nu</label>
                                    </div>
                                    <label for="creditHistoryCheckAgreement" class="help-block showmore" data-show-lg="400" data-show-sm="100" data-show-xs="50"  data-moretext=">>> mai multe" data-lesstext="<<< mai puțin">Îmi exprim acordul ca ÎM OMF MICROINVEST S.R.L. să acceseze informația despre istoria mea creditară, conținută în baza de date a biroului istoriilor de credit ÎM ”Biroul de Credit ” S.R.L.</label>
                                </div>
                                <div class="checkbox conditions small">
                                    <div class="radio-condition">
                                        <label>
                                            <input  name="app[creditHistoryReportingAgreement]" id="creditHistoryReportingAgreement" value="true" type="checkbox">Da</label>
                                        <br>
                                        <label>
                                            <input value="" type="checkbox">Nu</label>
                                    </div>
                                    <label for="agreementCreditHistorySending" class="help-block showmore" data-show-lg="400" data-show-sm="100" data-show-xs="50"  data-moretext=">>> mai multe" data-lesstext="<<< mai puțin">Îmi exprim acordul ca ÎM OMF MICROINVEST S.R.L., să prezinte informații despre faptul solicitării creditului sau despre obligațiile mele financiare, ce decurg din contractul de credit încheiat cu aceasta, către biroul istoriilor de credit ÎM ”Birou de credit” S.R.L., în scopul formării istoriei de credit, conținutul căreia este stabilit de art.5 din Legea nr.122-XVI din 29 mai 2008 ”Privind birourile istoriilor de credit.</label>
                                </div>
                                -->
                                <p class="bg-warning general-info help-block small showmore" data-show-lg="200" data-show-sm="100" data-show-xs="50"  data-moretext=">>> mai multe" data-lesstext="<<< mai puțin">{{trans('app.companyInfoApp')}}</p>
                            </div>
                        </div>
                        <input name="app[applicationType]" type="hidden" value="1">
                        <input name="app[sendEmail]" type="hidden" value="1">
                        <input name="app[sendEmailTest]" type="hidden" value="1">
                        <input name="app[loanProductName]" type="hidden" value="" class="js-loanProductName">
                        <input name="app[loanPurposeRows][loanPurpose]" type="hidden" value="" class="">
                        <p class="text-center btn-send">
                            <button type="submit" class="btn btn-success btn-send-app">{{trans('app.sendApp')}}</button>
                        </p>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@section('css')
    {!!Html::style('/assets/plugins/qtip/jquery.qtip.min.css')!!}
@endsection

@section('js')
    {!!Html::script('/assets/plugins/enquire/dist/enquire.min.js')!!}
    {!!Html::script('/assets/plugins/jquery-validation/dist/jquery.validate.min.js')!!}
    {!!Html::script('/assets/plugins/jquery-validation/dist/additional-methods.min.js')!!}
    <script src='/assets/plugins/jquery-validation/src/localization/messages_{{App::getLocale()}}.js' type="text/javascript"></script>
    {!!Html::script('/assets/plugins/qtip/jquery.qtip.min.js')!!}
    {!!Html::script('/assets/plugins/plupload/js/plupload.full.min.js')!!}
    <script>
    $(document).ready( function(){
        var uploader = new plupload.Uploader({
            runtimes : 'gears,html5,flash,silverlight',
            multi_selection: false,
            unique_names: true,
            browse_button : 'pickfiles', // you can pass an id...
            container: document.getElementById('container'), // ... or DOM Element itself
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
                PostInit: function() {
                    document.getElementById('filelist').innerHTML = '';
                    document.getElementById('uploadfiles').onclick = function() {
                        uploader.start();
                        return false;
                    };
                },
                FilesAdded: function(up, files) {
                    uploader.refresh();
                    if(up.files.length <= up.settings.max_files){
                        $('#input-pickfiles').val(up.files.length).valid();
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
        var uploader2 = new plupload.Uploader({
            runtimes : 'gears,html5,flash,silverlight',
            multi_selection: false,
            unique_names: true,
            browse_button : 'pickfiles-tehPasport', // you can pass an id...
            container: document.getElementById('container-tehPasport'), // ... or DOM Element itself
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
                PostInit: function() {
                    document.getElementById('filelist-tehPasport').innerHTML = '';
                    document.getElementById('uploadfiles-tehPasport').onclick = function() {
                        uploader2.start();
                        return false;
                    };
                },
                FilesAdded: function(up, files) {
                    uploader2.refresh();
                    if(up.files.length <= up.settings.max_files){
                        $('#input-pickfiles-tehPasport').val(up.files.length).valid();
                        plupload.each(files, function(file) {
                            document.getElementById('filelist-tehPasport').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b> <a href="#" class="removeFile removeFileTehPasport" >Delete</a></div>';
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
        uploader2.init();
        var appCurrency = <?= json_encode(Config::get('app.currency')) ?>; 
        var products = <?= json_encode($loanProduct) ?>; 
        if (($("#form-aplication-dealer").length != 0)) {
            var appDealer = $("#form-aplication-dealer");
            var validator = appDealer.validate({
                onkeyup: false,
                errorClass: 'error',
                validClass: 'valid',
                errorPlacement: function (error, element) {
                    // Set positioning based on the elements position in the form
                    var elem = $(element);
                    if ($(elem).hasClass('file-count')) elem = $('.pickfiles');
                    if ($(elem).hasClass('file-count-tehPasport')) elem = $('.pickfiles-tehPasport');

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
                submitHandler:function(form){
                   $('body').LoadingOverlay("show");
                   form.submit();
                }
            });
        }
        $.validator.addClassRules({
            "file-count": {
              documents: true
            }
        });
        $.validator.addClassRules({
            "file-count-tehPasport": {
              documentsTehPasport: true
            }
        });
        $.validator.addMethod("documents", function(value, element) {
            return uploader.files.length;
        }, "Nu ați atașat nici un document");

        $.validator.addMethod("documentsTehPasport", function(value, element) {
            return uploader2.files.length;
        }, "Nu ați atașat nici un document");

/*        $.validator.addClassRules({
            pickfiles: {
              documents: true,
            }
        });*/
/*        $('#pickfiles').rules("add", {
           documents: true,
           required: true
        });*/

        /*$('.pickfiles').each(function () {
            $(this).rules('add', {
                documents: true,
            });
        });*/
        $('.js-currency').change(function(event) {
            const c = $("option:selected", this).text();
            $.each($('[data-placeholder]'), function(i, item){
                $(item).attr('placeholder', $(item).data('placeholder') + c);
            });
            $('.js-currency-placeholder').attr('placeholder', c);
            var currencyID = $(this).val();
            var productID = $('.js-product').val();
            initNewValidation(productID, currencyID);
        });
        var inProcces = false;
        $('.js-btn-calc-payment').click(function(event) {
            event.preventDefault();
            var $this = $(this),
                product = $('.js-product'),
                amount = $('.js-amount'),
                term = $('.js-term'),
                currency = $('.js-currency'),
                contribution = $('.js-contribution'),
                sumCredit = $('.js-sum-credit'),
                html = '',
                currencyDefault = 'MDL',
                obj = {
                    calc:
                    {
                        currency: currency.val(),
                        loanProductID: product.val(),
                        amount: sumCredit.val(),
                        term: term.val()
                    }
                };
                validProduct = validator.element(product);
                validAmount = validator.element(amount);
                validTerm = validator.element(term);
                validcontribution = validator.element(contribution);

                if (validProduct && validAmount && validTerm && validcontribution && !inProcces) {
                    $.ajax({
                        url: $this.data('action'),
                        data: obj,
                        method: 'POST',
                        beforeSend: function(){
                            inProcces = true;
                            $this.button('loading');
                            $(".js-schendule-success, .js-schendule-error").hide();
                            // $(".btn-calc-payment-schedule").attr('disabled', true);
                            $(".js-calc-payment").LoadingOverlay("show");
                        },
                        success: function (data) {
                            if (data.respons) {
                                $.each(data.result, function(index, item) {
                                    var currency = appCurrency[item.currency];

                                    if (item.useScale) {
                                        html += "<tr>"
                                                    +"<td class='js-term-calc'>"+item.term+"</td>"
                                                    +"<td>{{trans('app.dala')}} "+item.mounthlyPaymentMIN+" {{trans('app.panala')}} "+item.mounthlyPayment+" "+currency+"</td>"
                                                    +"<td>{{trans('app.dala')}} "+item.totalAmountMIN+" {{trans('app.panala')}} "+item.totalAmount+" "+currency+"</td>"
                                                    +"<td>{{trans('app.dala')}} "+item.IRRMIN+" {{trans('app.panala')}} "+item.IRR+" %</td>"
                                                +"</tr>";
                                    } else{
                                        html += "<tr>"
                                                    +"<td class='js-term-calc'>"+item.term+"</td>"
                                                    +"<td>"+item.mounthlyPayment+" "+currency+"</td>"
                                                    +"<td>"+item.totalAmount+" "+currency+"</td>"
                                                    +"<td>"+item.IRR+" %</td>"
                                                +"</tr>";
                                    } 
                                });
                                $("#payment-schedule-response table tbody").html(html);
                                $(".js-schendule-success").fadeIn();
                            } else {
                                $(".js-schendule-error").fadeIn();
                            }

                            $(".js-calc-payment").LoadingOverlay("hide", true);
                        }
                    }).done(function( msg ) {
                        inProcces = false;
                        $this.button('reset');
                    });
                }
        });

        $(".js-schendule").delegate( "tbody tr", "click", function() {
            var term = $(this).find('.js-term-calc').text();
            $('.js-term').val(term);
            $(".js-schendule").find('tr').removeClass('selected');
            $(this).addClass('selected');
        });

        $("body").delegate(".removeFile", "click", function(e){
            e.preventDefault();
            var id = $(this).parent().attr('id');
            if (!inProcces) {
                $.ajax({
                    data: { fileId: id },
                    url: "{{route("remove_file")}}",
                    method: 'POST',
                    beforeSend: function(){
                        inProcces = true;
                    },
                    success: function (response) {
                        console.log(response);
                        //Materialize.toast('Success', 2000, 'green');
                    }
                }).done(function( msg ) {
                    inProcces = false;
                });
            }
            if ($(this).hasClass('removeFileTehPasport')) {
                uploader2.removeFile(uploader2.getFile(id));
                //uploader.splice(id,1);
                uploader2.refresh();
                var count_file = uploader2.files.length;
                $('.file-count-tehPasport').val(count_file == 0 ? '' : count_file).valid();
            } else {
                uploader.removeFile(uploader.getFile(id));
                //uploader.splice(id,1);
                uploader.refresh();
                var count_file = uploader.files.length;
                $('.file-count').val(count_file == 0 ? '' : count_file).valid();
            }
            $('#'+id).remove();
        });

       /* $('.form-aplication-dealer').submit(function(e) {
            //e.preventDefault();
            //uploader.start();
            //return false;
        }); */

        /*$('#totalCost').on('blur change keyup', function (event) {
            if (parseInt($(this).val()) > 30000) {
                $('.guarantor').removeClass('guarantor-none');
            }else{
                $('.guarantor').addClass('guarantor-none');
            }
        });
        if ('{{old('app.totalCost')}}' > 30000) {
            $('#totalCost').change();
        }*/
        $('#idno').on('keyup', function (event) {
            var idno = $(this).val();
            if (!inProcces && idno != '' && (idno.length == 13)) {
                $.ajax({
                    data: { idno: idno },
                    url: "{{route("getClientData")}}",
                    method: 'POST',
                    beforeSend: function(){
                        inProcces = true;
                    },
                    success: function (resp) {
                        if (resp.success) {
                            $('#name').val(resp.result.name);
                            $('#surname').val(resp.result.surname);
                            $('#phoneCell').val(resp.result.PhoneNumber);
                            $('#loanLimitSum').val(resp.result.Limit).closest('div.row').show();
                            $('.js-currency-limit-sum').text(appCurrency[resp.result.limitCurrency]);
                        } 
                        /*else {
                            $('#name').val('');
                            $('#surname').val('');
                            $('#phoneCell').val('');
                            $('#loanLimitSum').val('').closest('div.row').hide();
                        }*/
                    }

                }).done(function( msg ) {
                    inProcces = false;
                });
            }
        });
        $('.js-amount, .js-contribution').on('keyup', function (e) {
            var amount = parseFloat($('.js-amount').val());
            var contribution = parseFloat($('.js-contribution').val());
            var sumCredit = $('.js-sum-credit');
            if (!isNaN(amount) && !isNaN(contribution)) {
                sumCredit.val(amount-contribution);
            } else {
                sumCredit.val('');
            }
        });
        $('.js-product').on('change.productName', function (event) {
            $('.js-loanProductName').val($(this).find('option:selected').text());
            var productID = $(this).val();
            var currencyID = $('.js-currency').val();
            initNewValidation(productID, currencyID);
        });
        function initNewValidation(productID, currencyID){
            var amount = $('.js-amount');
            var term = $('.js-term');
            var currency = amount.data('currency');
            if (products[productID]['limit'][currencyID]) {
                currency = appCurrency[currencyID];
                var amountMin =  products[productID]['limit'][currencyID]['amountMin'];
                var amountMax =  products[productID]['limit'][currencyID]['amountMax'];
                var termMin =  products[productID]['limit'][currencyID]['termMin'];
                var termMax =  products[productID]['limit'][currencyID]['termMax'];
                var placeholderAmount = amount.data('translate').replace(/({sum})/g, amountMax);
                var placeholderTerm = term.data('translate').replace(/({term})/g, termMax);
                amount.attr('min', amountMin)
                .attr('max', amountMax);
                term.attr('min', termMin)
                .attr('max', termMax);
            } else{
                var placeholderAmount = amount.data('translate').replace(/({sum})/g, amount.data('max'));
                var placeholderTerm = term.data('translate').replace(/({term})/g, term.data('max'));
            } 
            amount.attr('placeholder', placeholderAmount+ ' ' +currency);            
            term.attr('placeholder', placeholderTerm);            
        }
        $('.js-product').change();
    });
    </script>
    @include('aplication.partials.js')
@endsection
