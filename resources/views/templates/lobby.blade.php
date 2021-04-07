@extends('templates.main')
@push('css')
    <link rel="stylesheet" href="{{asset('css/lobby.css')}}">
@endpush

@section('body-content')
    <div class="block-login">
        <div class="language-login">
            @include('templates.language')
        </div>
        <object type="image/svg+xml" data="{{asset('img/logo.svg')}}" class="logo-login">logo.SVG</object>
        <div>Root Route</div>
        @yield('lobby-content')
    </div>
@endsection
