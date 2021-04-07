<!doctype html>
<html lang="{{App::getLocale()}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <script src="{{asset('js/library/jquery-3.5.1.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/font.css')}}">
    <link rel="stylesheet" href="{{asset('css/shared.css')}}">
    @stack('script')
    @stack('css')
    <title>@yield('title')</title>
</head>
<body>
    @yield('body-content')
</body>
</html>
