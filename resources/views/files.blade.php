@extends('templates.body')
@section('title', 'Хранилище')
@push('css')
    <link rel="stylesheet" href="{{asset('css/files.css')}}">
@endpush
@push('script')
    <script src="{{asset('js/files.js')}}"></script>
    <meta name="path" content="{{$path}}">
@endpush

@section('main_form')
    <div class="main_form_title">Хранилище</div>
    <div class="actions_files">
        <input class="file_search" type="text" placeholder="Поиск">
        <div class="action_files_btn"><img src="{{asset('img/files/update.svg')}}" alt="">Обновить</div>
        <div id="create_folder_btn" class="action_files_btn"><img src="{{asset('img/files/folder.svg')}}" alt="">Создать папку</div>
        <input id="uploadFile" type="file" hidden>
        <label for="uploadFile" class="action_files_btn"><img src="{{asset('img/files/upload.svg')}}" alt="">Загрузить</label>
        <div class="action_files_btn"><img src="{{asset('img/files/rename.svg')}}" alt="">Переименовать</div>
        <div class="action_files_btn"><img src="{{asset('img/files/paste.svg')}}" alt="">Вставить</div>
    </div>
    <div class="pathFolder">
        Путь: {{'/'.$path}}
    </div>
    <div class="blk_scr_dlg">
        <div class="crt_folder_dialog">
            <form>
                <div class="dlg_title">Введите название папки<img class="dlg_close_btn" src="{{asset('img/close.svg')}}"></div>
                <div class="crt_folder_err"></div>
                <input name="name" type="text" placeholder="Название">
                <input type="hidden" name="path" value="{{$path}}">
                <input id="submit_crt_folder" type="button" class="green_button" value="Создать">
            </form>
        </div>
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
            <td><a class="folderName" href="{{route('files', ['path' => $parent])}}"><img class="type_file_img" src="{{asset('img/folder_type.svg')}}">..</a></td>
            <td>--</td>
            <td>--</td>
            <td>--</td>
        </tr>
        @endif
        @foreach($folders as $folder)
            @php($userData = $folder->userData()->sole())
            <tr {{++$iterationLoop%2 ? 'class=odd_table_line' : ''}}>
                <td><div class="options_file"><img src="{{asset('img/icon_table_options.svg')}}"></div></td>
                <td><a class="folderName" href="{{route('files', ['path' => $path.$folder->name.'/'])}}"><img class="type_file_img" src="{{asset('img/folder_type.svg')}}">{{$folder->name}}</a></td>
                <td>--</td>
                <td>{{$folder->created_at}}</td>
                <td>{{$userData->surname.' '.$userData->name.' '.$userData->patronymic}}</td>
            </tr>
        @endforeach
        @foreach($files as $file)
            @php($userData = $file->userData()->sole())
            <tr {{++$iterationLoop%2 ? 'class=odd_table_line' : ''}}>
                <td><div class="options_file"><img src="{{asset('img/icon_table_options.svg')}}"></div></td>
                <td><a class="folderName" href=""><img class="type_file_img" src="{{asset('img/file_type.svg')}}">{{$file->name}}</a></td>
                <td>{{round($file->size/1024, 1)}} Кб</td>
                <td>{{$file->created_at}}</td>
                <td>{{$userData->surname.' '.$userData->name.' '.$userData->patronymic}}</td>
            </tr>
        @endforeach
    </table>
@endsection
