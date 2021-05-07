@extends('templates.body')
@section('title', 'Хранилище')
@push('css')
    <link rel="stylesheet" href="{{asset('css/files.css')}}">
    <link rel="stylesheet" href="{{asset('css/dialog.css')}}">
@endpush
@push('script')
    <script src="{{asset('js/dialog.js')}}"></script>
    <script src="{{asset('js/files.js')}}"></script>
@endpush
@push('meta')
    <meta name="path" content="{{$path}}">
@endpush

@section('main_form')
    <div id="toolbar"></div>
    <div id="editor"></div>
    <div class="main_form_title">Хранилище</div>
    <div class="actions_files">
        <input class="file_search" type="text" placeholder="Поиск">
        <div class="action_files_btn"><img src="{{asset('img/files/update.svg')}}" alt="">Обновить</div>
        <div id="create_folder_btn" class="action_files_btn"><img src="{{asset('img/files/folder.svg')}}" alt="">Создать папку</div>
        <div id="upload_file_btn" class="action_files_btn"><img src="{{asset('img/files/upload.svg')}}" alt="">Загрузить</div>
        <div class="action_files_btn"><img src="{{asset('img/files/rename.svg')}}" alt="">Переименовать</div>
        <div class="action_files_btn"><img src="{{asset('img/files/paste.svg')}}" alt="">Вставить</div>
    </div>
    <div class="pathFolder">
        Путь: {{'/'.$path}}
    </div>
    {{--Create Folder Dialog--}}
    <div id="crt_folder_dlg">
        <div class="crt_folder_err"></div>
        <form>
            <input name="name" type="text" placeholder="Название">
            <input type="hidden" name="storage_name" value="{{$storageName}}">
            <input type="hidden" name="path" value="{{$path}}">
            <input id="submit_crt_folder" type="button" class="green_button" value="Создать">
        </form>
    </div>
    {{--Upload file--}}
    <div id="upload_file_dlg">
        <div class="upload_file_err"></div>
        <form id="upload_file_form">
            <input name="version_name" type="text" placeholder="Название версии">
            <div class="select_file_block">
                <input id="upload_file_input" name="file" type="file" hidden>
                <label for="upload_file_input" class="blue_button select_file_btn">Выбрать файл</label>
                <div id="file_name"></div>
            </div>
            <input type="hidden" name="storage_name" value="{{$storageName}}">
            <input type="hidden" name="path" value="{{$path}}">
            <input id="submit_upload_file" type="button" class="green_button" value="Загрузить">
        </form>
    </div>
    <table>
        <tr>
            <td width="3%"></td><td>Имя</td><td>Размер</td><td>Дата создания</td><td>Создатель</td>
        </tr>
        @php($iterationLoop = 1)
        @if($path !== null)
        @php($iterationLoop++)
        <tr>
            <td></td>
            <td><a class="folderName" href="{{route($storage, ['path' => $parent])}}"><img class="type_file_img" src="{{asset('img/folder_type.svg')}}">..</a></td>
            <td>--</td>
            <td>--</td>
            <td>--</td>
        </tr>
        @endif
        @foreach($folders as $folder)
            @php($userData = $folder->userData()->sole())
            <tr {{++$iterationLoop%2 ? 'class=odd_table_line' : ''}}>
                <td><div class="options_file"><img src="{{asset('img/icon_table_options.svg')}}"></div></td>
                <td><a class="folderName" href="{{route($storage, ['path' => $path.$folder->name.'/'])}}"><img class="type_file_img" src="{{asset('img/folder_type.svg')}}">{{$folder->name}}</a></td>
                <td>--</td>
                <td>{{$folder->created_at}}</td>
                <td>{{$userData->surname.' '.$userData->name.' '.$userData->patronymic}}</td>
            </tr>
        @endforeach
        @foreach($files as $file)
            @php($userData = $file->userData()->sole())
            <tr {{++$iterationLoop%2 ? 'class=odd_table_line' : ''}}>
                <td><div class="options_file"><img src="{{asset('img/icon_table_options.svg')}}"></div></td>
                <td><a class="folderName" href="{{route('file', ['file' => $file->hash_name])}}"><img class="type_file_img" src="{{asset('img/file_type.svg')}}">{{$file->name}}</a></td>
                <td>{{round($file->size/1024, 1)}} Кб</td>
                <td>{{$file->created_at}}</td>
                <td>{{$userData->surname.' '.$userData->name.' '.$userData->patronymic}}</td>
            </tr>
        @endforeach
    </table>
@endsection
