@extends('auth.layout')

@section('content')
    <div class="display-table authentification">
        <div class="td">
            <h1>{{$meta->getMeta('resend_confirmation_email_title')}}</h1>
            <p>{{$meta->getMeta('resend_email_text_title')}}</p>
            @if(\Session::has('success'))
                <div>
                    <p>{{ Session::get('success') }}</p>
                </div>
            @endif
            <form action="{{ route('resend_verify_email') }}" class="form styled3 row" method="POST">
                <div class="col s12">
                    <input type="submit" value="{{$meta->getMeta('resend_email_submit')}}" class="btn btn_base btn_submit full_width">
                </div>
            </form>
        </div>
    </div>
@endsection