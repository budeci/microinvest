
            <h1>{!!$meta->getMeta('register_account')!!}</h1>
            <p>{!!$meta->getMeta('label_register_account')!!}</p>
            <form action="{{ route('post_register') }}" class="form styled3 
            {{ (request()->route()->getName() == 'get_register') ? "row" : ""}}" data-authtype="register" 
                method="post" data-action='{{ route('auth_modal_register') }}'>
                @include('partials.errors.list')
                 <div class="col s12">
                        <div class="input-field">
                            <input type="text" name="firstname" required placeholder="{!!$meta->getMeta('firstname')!!}" value="{{ old('firstname') }}">
                        </div>
                    </div>
                     <div class="col s12">
                        <div class="input-field">
                            <input type="text" name="lastname" required placeholder="{!!$meta->getMeta('lastname')!!}" value="{{ old('lastname') }}">
                        </div>
                    </div>
                     <div class="col s12">
                        <div class="input-field">
                        <input type="email" name="email" required placeholder="Ex: maria@gmail.com" value="{{ old('email') }}">
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field register_form_phone">
                            <input type="tel" required name="phone" placeholder="XXXXXXXX"
                                   value="{{ old('phone') }}" length="8">
                            <span class="country_code_register">+373</span>
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field">
                            <input type="password" required name="password" placeholder="{!!$meta->getMeta('enter_password')!!}">
                        </div>
                    </div>
                    <div class="col s12">
                        <div class="input-field">
                            <input type="password" required name="password_confirmation" placeholder="{!!$meta->getMeta('password_confirmation')!!}">
                        </div>
                    </div>
                    <div class="col s12">
                        <input type="submit" value="{!!$meta->getMeta('create_account')!!}" class="btn btn_base btn_submit full_width auth_register_ajax">
                        <div class="input-field">
                            <a href="{{ route('social_auth', 'facebook') }}" class="btn btn_facebook full_width">
                                <i class="icon-facebook"></i>&nbsp;{!!$meta->getMeta('login_fb')!!}
                            </a>
                            <a style="display: none;" href="#" class="btn btn_gplus full_width">
                                <i class="icon-google-plus"></i>&nbsp;{!!$meta->getMeta('login_gplus')!!}
                            </a>
                            <p class="center">{!!$meta->getMeta('am_deja_account')!!} <a href="{{ route('get_login') }}" class="c_base
                            ">{!!$meta->getMeta('login_to_account')!!}</a></p>
                        </div>
                    </div>
                {!! csrf_field() !!}
            </form>