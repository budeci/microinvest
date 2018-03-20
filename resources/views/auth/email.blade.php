@extends('auth.layout')

@section('content')
    <div class="display-table authentification">
        <div class="td">
            <h1>{{$meta->getMeta('email_restore_enterEmail')}}</h1>
            <p>{{$meta->getMeta('email_restore_enterEmailText')}}</p>
            <form method="post" action="{{ route('post_social_auth_email', ['provider' => $social->provider, 'social' => $social->provider_id]) }}"
                  class="form styled3 row">
                <div class="col s12">
                    <div class="input-field">
                        <span class="label">{{$meta->getMeta('restore_email_input_text')}}</span>
                        @include('partials.errors.list')
                        <input type="email" placeholder="Email" name="email">
                    </div>
                </div>

                <div class="col s12">
                    <input type="submit" value="{{$meta->getMeta('restore_email_submit')}}" class="btn btn_base btn_submit full_width">
                </div>
                {!! csrf_field() !!}
            </form>
        </div>
    </div>
@endsection