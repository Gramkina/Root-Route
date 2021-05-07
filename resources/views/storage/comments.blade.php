@extends('templates.body')
@section('title', 'Файл '.$file->name.' - Предпросмотр')

@push('css')
@endpush
@push('script')
@endpush

@section('main_form')
    @include('templates.back_button', ['back_link' => url()->previous()])
@endsection
