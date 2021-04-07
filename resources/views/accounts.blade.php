@extends('templates.body')
@section('title', 'Аккаунты')
@push('css')
    <link rel="stylesheet" href="{{asset('css/invites.css')}}">
@endpush
@push('script')
    <script src="{{asset('js/invites.js')}}"></script>
@endpush

@section('main_form')
    <div class="main_form_title">Аккаунты</div>
    <div class="text_black">Введите данные связанные с пользователями для поиска (например, имя)</div>
    <input class="search_invites" type="text" placeholder="Поиск">
    <div>
        <input type="checkbox" id="adv_search" hidden>
        <label for="adv_search" class="text_blue adv_search">Расширенный поиск</label>
        <div class="adv_search_block">
{{--            Отображать только активные приглашения--}}
        </div>
    </div>
    <a href="{{route('users.add')}}" class="btn_add_user green_button" type="button">+ Добавить нового пользователя</a>
    <table class="result_search">
        <tr>
            <td></td>
            <td></td>
            <td>ID</td>
            <td>Логин</td>
            <td>Роль</td>
            <td>Фамилия</td>
            <td>Имя</td>
            <td>Отчество</td>
            <td>Дата создания</td>
            <td>Дата последнего обновления</td>
        </tr>
        @foreach($accounts as $account)
            <tr {{$loop->odd ? '' : 'class=odd_table_line'}}>
                @php($userData = $account->role == 'user' ? $account->userData()->sole() : null)
                <td><input type="checkbox"></td>
                <td>
                    <img class="context_menu_btn" src="{{asset('img/icon_table_options.svg')}}">
                    @include('templates.context_menu', ['contextMenuElements' => json_decode(\Illuminate\Support\Facades\Storage::disk('local')->get('context_menu_invites.json')), 'data' => isset($userData) ? $userData->id : '-'])
                </td>
                <td>{{$account->id}}</td>
                <td>{{$account->login}}</td>
                <td>{{$account->role}}</td>
                <td>{{isset($userData) ? $userData->surname : '-'}}</td>
                <td>{{isset($userData) ? $userData->name : '-'}}</td>
                <td>{{isset($userData) ? $userData->patronymic : '-'}}</td>
                <td>{{$account->created_at}}</td>
                <td>{{$account->updated_at}}</td>
            </tr>
        @endforeach
    </table>
    <div class="delete_element_block">
        <div>
            <input type="checkbox" id="select_all">
            <label class="text_black" for="select_all">Отметить все</label>
        </div>
        <input class="delete_elements_btn red_button" type="button" value="Удалить отмеченное">
    </div>
    <div class="table_page">
        @if($page != 1)
            <a href="{{route('accounts.index', ['page' => $page-1])}}" id="prevPage" class="quad table_page_element_button"><img src="{{asset('img/table_page_arrow_left.svg')}}"></a>
        @endif
        <div class="quad table_page_element">{{$page}}</div>
        @if($pageCount > $page)
            <a href="{{route('accounts.index', ['page' => $page+1])}}" class="quad table_page_element_button"><img src="{{asset('img/table_page_arrow_right.svg')}}"></a>
        @endif
    </div>
@endsection
