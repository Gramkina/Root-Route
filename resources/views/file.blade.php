@extends('templates.body')
@section('title', 'Файл '.$file->name.' - Предпросмотр')

@push('css')
    <link rel="stylesheet" href="{{asset('css/file.css')}}">
    <link rel="stylesheet" href="{{asset('css/dialog.css')}}">
@endpush
@push('script')
    <script src="{{asset('js/dialog.js')}}"></script>
    <script src="{{asset('js/file.js')}}"></script>
    <script src="{{asset('js/convertDocx.js')}}"></script>
@endpush
@push('meta')
    <meta name="current_file_hash_name" content="{{$file->hash_name}}">
@endpush

@section('main_form')
    @include('templates.back_button', ['back_link' => url()->previous()])
    <div class="main_form_title">Файл "{{$file->name}}" - Предпросмотр</div>
    <div class="info_file">
        <div class="version_file">
            <div class="current_version">Текущая версия: {{$file->version_name}}</div>
            <div class="this_version">Сделать данную версию актуальной</div>
        </div>
        <div class="actions_file">
            <a download="{{$file->name}}" href="{{route('download_file', ['file' => $file->hash_name])}}" class="action_file_btn"><img src="{{asset('img/files/download.svg')}}" alt="">Скачать</a>
            <div id="select-ver-btn" class="action_file_btn"><img src="{{asset('img/files/file.svg')}}" alt="">Выбрать версию файла</div>
            <div id="add_ver_btn" class="action_file_btn"><img src="{{asset('img/files/upload.svg')}}" alt="">Загрузить новую версию</div>
            <a href="{{route('edit_file', ['file' => $file->hash_name])}}" class="action_file_btn"><img src="{{asset('img/files/edit_file.svg')}}" alt="">Редактировать</a>
            <a href="{{route('comments', ['file' => $file->hash_name])}}" class="action_file_btn"><img src="{{asset('img/files/comment.svg')}}" alt="">Комментировать</a>
        </div>
    </div>
    {{--Select Version File Dialog--}}
    <div id="select-ver-dlg">
        <table>
            <tr>
                <td></td>
                <td>Версия</td>
                <td>Размер</td>
                <td>Дата создания</td>
                <td>Создатель</td>
                <td>Статус</td>
            </tr>
            @foreach($allFileVersion as $file)
                @php($userData = $file->userData()->sole())
                <tr>
                    <td><div class="options_file"><img src="{{asset('img/icon_table_options.svg')}}"></div></td>
                    <td><a href="{{route('file', ['file' => $file->hash_name])}}">{{$file->version_name}}</a></td>
                    <td>{{round($file->size/1024, 1)}} Кб</td>
                    <td>{{$file->created_at}}</td>
                    <td>{{$userData->surname.' '.$userData->name.' '.$userData->patronymic}}</td>
                    <td>{{$file->version_status}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    {{-- Add New Version File Dialog --}}
    <div id="add_version_dlg">
        <div class="add_version_err"></div>
        <form id="add_ver_form">
            @csrf
            <input name="version_name" type="text" placeholder="Название версии">
            <div class="select_file_block">
                <input id="add_ver_file_input" name="file" type="file" hidden>
                <label for="add_ver_file_input" class="blue_button select_file_btn">Выбрать файл</label>
                <div id="file_name"></div>
            </div>
            <input type="hidden" name="hash_name" value="{{$file->hash_name}}">
            <input id="submit_add_ver" type="button" class="green_button" value="Добавить">
        </form>
    </div>
    <input type="hidden" value="{{$fileBase64}}" id="fileBase64">
    <div class="editor-container">
        <div id="editor"></div>
    </div>
@endsection
