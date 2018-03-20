@extends('auth.layout')

@section('content')
    <div class=" display-table  authentification">
        <div class="td">
            <h1>{{$meta->getMeta('auth_restore_password_title')}}</h1>
            <p>{{$meta->getMeta('auth_restore_password_subtitle')}}</p>
            <form action="{{ route('password_recover_send_email') }}" method="post" class="form styled3 row">
                <div class="col s12">
                    <div class="input-field">
                        <span class="label">{{$meta->getMeta('password_recover_labeltext')}}</span>
                        <input type="email" placeholder="Ex: maria@gmail.com" name="email" value="{{ old('email') }}">
                    </div>
                </div>
                <div class="col s12">
                    <input type="submit" value="{{$meta->getMeta('auth_restore_password_send')}}" class="btn btn_base btn_submit full_width">
                </div>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
@endsection