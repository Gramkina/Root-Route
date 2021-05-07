@extends('templates.body')
@section('title', 'Файл '.$file->name.' - Редактирование')

@push('css')
    <link rel="stylesheet" href="{{asset('css/fileEdit.css')}}">
@endpush
@push('script')
    <script src="{{asset('js/convertDocxEdit.js')}}"></script>
@endpush
@push('meta')
    <meta name="current_file_hash_name" content="{{$file->hash_name}}">
@endpush

@section('main_form')
    @include('templates.back_button', ['back_link' => url()->previous()])
    <div class="main_form_title">Файл "{{$file->name}}" - Редактирование</div>
    <div class="info_edit_file">
        <div class="version_name">Версия файла: {{$file->version_name}}</div>
        <div id="save_edit_btn" class="green_button save_btn">Сохранить изменения</div>
    </div>
    <input type="hidden" value="{{$fileBase64}}" id="fileBase64">
    <div class="editor-container">
        <div id="editor"></div>
    </div>
@endsection
