<div class=" display-table authentification">
    <div class="td">
        <h1>{{$meta->getMeta('login_form_title')}}</h1>
     
        <p class=" center">{{$meta->getMeta('login_form_subtitle')}}</p>
        <form action="{{ route('post_login') }}" class="form styled3" method="post">
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
                        <p class="left-align" style="margin-bottom: 25px;">
                            <input type="checkbox" id="check1">
                            <label for="check1">{{$meta->getMeta('login_form_login_automat')}}</label>
                            <br>
                        </p>
                        <input type="submit" value="{{$meta->getMeta('login_form_submit')}}" class="btn btn_base btn_submit full_width">
                    </div>
                </div>
                <div class="col s12">
                        <hr class="hr-text" data-content="OR">

                    <div class="input-field">
                        <a href="{{ route('social_auth', 'facebook') }}" class="btn btn_facebook full_width">
                            <i class="icon-facebook"></i>&nbsp;{{$meta->getMeta('login_form_with_facebook')}}
                        </a>
                        <a href="#" class="btn btn_gplus full_width">
                            <i class="icon-google-plus"></i>&nbsp;{{$meta->getMeta('login_form_with_google')}}
                        </a>
                    </div>
                </div>
                <div class="response"></div>
            {!! csrf_field() !!}
        </form>
    </div>
</div>

