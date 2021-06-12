@extends('templates.body')
@section('title', 'Добавление задачи')
@push('css')
    <link rel="stylesheet" href="{{asset('css/task_add.css')}}">
@endpush
@push('script')
    <script src="{{asset('js/addtask.js')}}"></script>
@endpush
@push('meta')
@endpush

@section('main_form')
    <div class="main_form_title">Добавление задачи</div>
    <input id="sharedName" type="text" name="sharedName" placeholder="Общее название задач">
    <textarea id="sharedDescription" name="sharedDescription" placeholder="Общее описание задач"></textarea>
    <div class="task_block">
        <form id="form0">
            <div class="title_task"><img src="{{asset('img/tasks/task_type_1.svg')}}">Подзадача 1</div>
            <input type="text" name="taskName" placeholder="Название задачи">
            <textarea name="taskDescription" placeholder="Описание задачи"></textarea>
            <div class="title_field">Тип задачи</div>
            <select form="form0" name="type">
                <option selected disabled>Выберите тип задачи</option>
                <option value="Запрос">Запрос</option>
                <option value="Запрос на подпись">Запрос на подпись</option>
                <option value="Информация">Информация</option>
            </select>
            <div class="title_field">Дата начала задания</div>
            <input name="start_date" type="date">
            <div class="title_field">Дата окончания задания</div>
            <input name="finish_date" type="date">
            <div class="title_field">Исполнитель задания</div>
            <select form="form0" id="executorList" name="executor">
                <option selected disabled>Выберите исполнителя</option>
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->surname.' '.$user->name.' '.$user->patronymic}}</option>
                @endforeach
            </select>
            <div class="title_field">Выберите документы</div>
            <select name="files" form="form0" multiple="files">
                @foreach($files as $file)
                    <option value="{{$file->hash_name}}">{{$file->name}}</option>
                @endforeach
            </select>
        </form>
    </div>
    <div class="add_new_task">+ Добавить подзадачу</div>
    <input id="add_task" type="button" class="green_button add_task_btn" value="Добавить задание">
@endsection
