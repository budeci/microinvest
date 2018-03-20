@extends('auth.layout')
@section('content')
    <div class="display-table  authentification">
        <div class="td">
           @include('auth.register_form')
        </div>
    </div>
@endsection