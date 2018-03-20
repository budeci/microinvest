<div id="modal" class="auth_modal modal modal_tabs">
    <div class="modal-content">
       <ul class="tabs" >
           <li class="tab"><a class="active" href="#logare">{{$meta->getMeta('modal_auth_login')}}</a></li>
           <li class="tab"><a  href="#register">{{$meta->getMeta('modal_auth_register')}}</a></li>
       </ul> 
        <div id="logare" class="col s12 tab_content">
            <div class="row">
                <div class="content_tab">
                    @include('auth.login_form')
                </div>
            </div>
        </div>
        <div id="register" class="col s12 tab_content">
            <div class="row">
                @include('auth.register_form') 
            </div>
            <br>
        </div>
    </div>
</div>
