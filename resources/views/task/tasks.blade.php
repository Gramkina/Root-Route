@extends('templates.body')
@section('title', 'Список заданий')
@push('css')
    <link rel="stylesheet" href="{{asset('css/tasks.css')}}">
@endpush
@push('script')
    <script src="{{asset('js/task.js')}}"></script>
@endpush
@push('meta')
@endpush

@section('main_form')
    <div class="main_form_title">Список заданий</div>
    <div class="main_div_tasks">
        <div class="tasks_left">
            <div class="actions_tasks">
                <input class="task_search" type="text" placeholder="Поиск">
                <a href="{{route('task.add')}}" class="action_task_btn"><img src="{{asset('img/files/update.svg')}}" alt="">Создать новое задание</a>
            </div>
            <div class="tasks_list">
                @foreach($tasks as $task)
                    <div class="task_main_div" ref="{{route('task.task', ['task' => $task->group])}}"  desc="{{$task->description}}">
                        <div class="task_type_img"><img src="{{asset('img/tasks/task_type_1.svg')}}"></div>
                        <div class="task_info">
                            <div class="task_up">
                                <div class="task_name">{{$task->name}}</div>
                                <div class="task_date">До {{$task->finish_date}}</div>
                            </div>
                            <div class="task_down">
                                <div class="task_description_list">{{$task->description}}</div>
                                <div class="task_status">В процессе</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="tasks_right">
            <div class="description"><img src="{{asset('img/tasks/icon_description.svg')}}">Краткое описание</div>
            <div class="task_description_title">Описание</div>
            <textarea class="task_description" readonly></textarea>
            <a href="" class="blue_button detailed_btn">Подробнее</a>
        </div>
    </div>
@endsection
