@extends('emails.layout')

@section('subject')
    {{$meta->getMeta('reset_password_email_subject')}}
@endsection

@section('message')
{{$meta->getMeta('reset_password_email_message')}}
@stop

@section('link_text')
    {{$meta->getMeta('reset_password_link')}}
@stop

@section('link')
    {{ route('reset_password_token', [ 'token' => $token ]) }}
@stop
