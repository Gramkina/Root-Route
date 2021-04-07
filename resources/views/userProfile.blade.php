@extends('templates.body')
@section('title', 'Профиль пользователя')

@section('main_form')
    @include('templates.back_button', ['back_link' => url()->previous()])
    <div class="main_form_title">{{$userData->surname.' '.$userData->name.' '.$userData->patronymic}}</div>
@endsection
