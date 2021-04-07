@extends('templates.lobby')
@section('title', trans('registration.title'))
@push('css')
    <link rel="stylesheet" href="{{asset('css/registration.css')}}">
@endpush
@push('script')
    <script src="{{asset('js/registration.js')}}"></script>
@endpush

@section('lobby-content')
    <div class="welcome-text">@lang('registration.hello'), {{$invite->userData()->value('name')}}</div>
    <div class="guide-text">@lang('registration.guide')</div>
    <div class="error_block"></div>
    <form>
        <input type="text" name="invite" value="{{$invite->code}}" hidden>
        <input type="text" placeholder="@lang('registration.login')" class="input-login" name="login">
        <input type="password" placeholder="@lang('registration.password')" class="input-login" name="password">
        <input type="password" placeholder="@lang('registration.password_again')" class="input-login" name="password_again">
        <input type="button" class="btn-login green_button" value="@lang('registration.registration')">
    </form>
@endsection
