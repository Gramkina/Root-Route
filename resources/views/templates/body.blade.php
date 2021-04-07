@extends('templates.main')

@push('css')
    <link rel="stylesheet" href="{{asset('css/body/body.css')}}">
@endpush
@push('script')
    <script src="{{asset('js/body.js')}}"></script>
@endpush

@section('body-content')
    <div class="header">
        <input class="global_search" type="text" placeholder="Поиск по приложению">
        <div class="auth_block">
            <div class="auth_block_user_info">
                <img src="{{asset('img/default_img_user.svg')}}">{{\Illuminate\Support\Facades\Auth::user()->login}}
            </div>
            <img class="notification_button" src="{{asset('img/notification_icon.svg')}}">
            <img class="logout_button" src="{{asset('img/logout_icon.svg')}}">
        </div>
    </div>
    <div class="main-content">
        <div class="navigation_menu">
            @include('templates.navigation_menu')
        </div>
        <div class="main-form">
            @yield('main_form')
        </div>
    </div>
@endsection
