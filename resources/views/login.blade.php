@extends('templates.lobby')
@section('title', trans('login.title_login'))
@push('css')
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
@endpush
@push('script')
    <script src="{{asset('js/login.js')}}"></script>
@endpush

@section('lobby-content')
    <div class="welcome-title">@lang('login.welcome')</div>
    <div class="error_block"></div>
    <form>
        <input type="text" placeholder="@lang('login.login')" class="input-login" name="login">
        <input type="password" placeholder="@lang('login.password')" class="input-login" name="password">
        <input type="button" name="btn-login" class="btn-login green_button" value="@lang('login.log_in')">
    </form>
@endsection
