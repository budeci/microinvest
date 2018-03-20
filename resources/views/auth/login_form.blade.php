<div class=" display-table authentification">
    <div class="td">
        <h1>{{$meta->getMeta('login_form_title')}}</h1>
        <p class=" center">{{$meta->getMeta('login_form_subtitle')}}</p>
        <form action="{{ route('post_login') }}" data-authtype="login" class="form styled3 
            {{(request()->route()->getName() == 'get_login') || (request()->route()->getName() == 'reset_password_token') ? "row" : ''}} "
            method="post" data-action="{{ route('auth_modal_login') }}">
              @include('partials.errors.list')
                <div class="col s12">
                    <div class="input-field">
                        <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <input type="password" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="col s12">
                    <div class="input-field">
                        <p class="left-align autologin" style="margin: 0 0 20px 0;">
                            <input type="checkbox" id="check1" name="remember">
                            <label for="check1">{{$meta->getMeta('login_form_login_automat')}}</label>
                            <br>
                        </p>
                        <input type="submit" value="{{$meta->getMeta('login_form_submit')}}" class="btn btn_base btn_submit full_width
                            auth_submit_ajax ">
                    </div>
                </div>
                <div class="col s12">
                        <!-- <hr class="hr-text" data-content="OR"> -->
                    <div class="input-field">
                        <a href="{{ route('social_auth', 'facebook') }}" class="btn btn_facebook full_width">
                            <i class="icon-facebook"></i>&nbsp;{{$meta->getMeta('login_form_with_facebook')}}
                        </a>
                        <a style="display: none;" href="#" class="btn btn_gplus full_width">
                            <i class="icon-google-plus"></i>&nbsp;{{$meta->getMeta('login_form_with_google')}}
                        </a>
                        <p>{{$meta->getMeta('login_form_missing_password')}}<a href="{{ route('get_recover') }}" class="c_base">{{$meta->getMeta('login_form_restore')}}</a></p>
                        @if(request()->route()->getName() == 'get_login') 
                                <p>{{$meta->getMeta('login_form_dont_have_account')}} <a href="{{ route('get_register') }}" class="c_base">{{$meta->getMeta('login_form_make_account')}}</a></p>
                        @endif
                    </div>
                </div>
            {!! csrf_field() !!}
        </form>
    </div>
</div>