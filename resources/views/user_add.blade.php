@extends('templates.body')
@section('title', 'Добавить пользователя')
@push('css')
    <link rel="stylesheet" href="{{asset('css/addUser.css')}}">
@endpush
@push('script')
    <script src="{{asset('js/addUser.js')}}"></script>
@endpush

@section('main_form')
    @include('templates.back_button', ['back_link' => url()->previous()])
    <div class="main_form_title">Добавить нового пользователя</div>
    <form>
        @method('POST')
        <div class="text_black">Выберите роль нового пользователя</div>
        <div class="select_role text_black"><input id="admin_role" name="role" value="admin" type="radio"><label for="admin_role">Администратор</label></div>
        <div class="select_role text_black"><input id="user_role" name="role" value="user" type="radio"><label for="user_role">Пользователь</label></div>
        <div class="error_block">
            <ul>
            </ul>
        </div>
        <div class="success_block">
            <img src="{{asset('img/green_check.svg')}}"><div class="success_message"></div>
        </div>
        <div id="form_user" hidden>
            <div class="text_black">Укажите личные данные пользователя</div>
            <input type="text" name="surname" placeholder="Фамилия">
            <div class="text_black s">Обязательное поле</div>
            <input type="text" name="name" placeholder="Имя">
            <div class="text_black s">Обязательное поле</div>
            <input type="text" name="patronymic" placeholder="Отчество">
            <div class="text_black s">Обязательное поле</div>
            <input type="text" name="department" placeholder="Отдел">
            <div class="text_black s">Обязательное поле</div>
            <input type="text" name="position" placeholder="Должность">
            <div class="text_black s">Обязательное поле</div>
            <input type="email" name="email" placeholder="Электронная почта">
            <div class="text_black s">Обязательное поле</div>
            <div class="text_black finish_text">После нажатия кнопки на указанный адерс электронной почты будет отправлено письмо с приглашением</div>
            <input class="green_button add_user_btn" type="button" value="Добавить пользователя">
        </div>
        <div id="form_admin" hidden>
            <div class="text_black">Укажите авторизационные данные для администратора</div>
            <input type="text" name="login" placeholder="Логин">
            <div class="text_black s">Обязательное поле</div>
            <input type="password" name="password" placeholder="Пароль">
            <div class="text_black s">Обязательное поле</div>
            <input class="green_button add_user_btn" type="button" value="Добавить администратора">
        </div>
    </form>
@endsection
