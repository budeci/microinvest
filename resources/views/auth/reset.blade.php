@extends('auth.layout')
<div class=" display-table authentification">
    <div class="td">
        <h1>{{$meta->getMeta('reset_password_form')}}</h1>
        <p class=" center">{{$meta->getMeta('reset_password_form_subtitle')}}</p>
        <form class="form styled3 row" method="POST" action="{{ route('reset_password') }}">
            {!! csrf_field() !!}
            <input type="hidden" name="token" value="{{ $token->token }}">

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
                    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                </div>
            </div>

            <div class="col s12">
                <input type="submit" value="{{$meta->getMeta('reset_password_form_submit')}}" class="btn btn_base btn_submit full_width">
            </div>
        </form>
    </div>
</div>
