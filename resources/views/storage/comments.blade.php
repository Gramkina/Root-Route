@extends('templates.body')
@section('title', 'Комментарии к файлу "'.$file->name.'"')

@push('css')
    <link rel="stylesheet" href="{{asset('css/comments.css')}}">
@endpush
@push('script')
    <script src="{{asset('js/comment.js')}}"></script>
@endpush

@section('main_form')
    @include('templates.back_button', ['back_link' => url()->previous()])
    <div class="main_form_title">Комментарии к файлу "{{$file->name}}"</div>
    <form id="your_comment_form">
        @csrf
        <input name="file_hash_name" type="hidden" value="{{$file->hash_name}}">
        <textarea name="comment" placeholder="Введите текст комментария..."></textarea>
        <input id="add_comment_btn" type="button" class="green_button" value="Комментировать">
    </form>
    <div class="count_comments">Комментариев: {{count($comments)}}</div>
    @foreach($comments as $comment)
        @php($user = $comment->getUserData()->sole())
        <div class="comment_main_block">
            <div class="comment_avatar"><img src="{{asset('img/default_img_user.svg')}}"></div>
            <div class="comment_main_content">
                <div class="comment_title">{{$user->name.' '.$user->surname}} · {{$comment->created_at}}</div>
                <div class="comment_text">{{$comment->comment}}</div>
                <div class="comment_answer_btn">Ответить</div>
            </div>
        </div>
    @endforeach

@endsection
