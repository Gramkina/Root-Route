@extends('templates.body')
@section('title', 'Задание '.$tasks[0]->name)
@push('css')
    <link rel="stylesheet" href="{{asset('css/task.css')}}">
@endpush
@push('script')
@endpush
@push('meta')
@endpush

@section('main_form')
    <div class="main_form_title">Задание "{{$tasks[0]->sharedName}}"</div>
    <div class="shared_desc"><img src="{{asset('img/tasks/icon_description.svg')}}">Общее описание задания</div>
    <div class="desc_block">
        <textarea readonly>{{$tasks[0]->sharedDescription}}</textarea>
    </div>
    <object type="image/svg+xml" data="{{asset('img/tasks/gant.svg')}}"></object>
    @foreach($tasks as $task)
        @php
            $executor = $task->getExecutor()->sole();
            $customer = $task->getCustomer()->sole();
            $files = json_decode($task->files);
        @endphp
        <div class="task_block">
            <div class="title_task"><img src="{{asset('img/tasks/task_type_1.svg')}}">{{$task->name}}</div>
            <div class="task_info">
                <div class="info_task"><b>Тип задания:</b> {{$task->type}}</div>
                <div class="info_task"><b>Заказчик:</b> {{$customer->surname.' '.$customer->name.' '.$customer->patronymic}}</div>
                <div class="info_task"><b>Исполнитель:</b> {{$executor->surname.' '.$executor->name.' '.$executor->patronymic}}</div>
                <div class="info_task"><b>Описание задания:</b> {{$task->description}}</div>
                <div class="info_task"><b>Дата начала задания:</b> {{$task->start_date}}</div>
                <div class="info_task"><b>Дата окончания задания:</b> {{$task->finish_date}}</div>
                <div class="info_task"><b>Статус задания:</b> {{$task->status}}</div>
                <div class="documents_title"><img src="{{asset('img/tasks/icon_documents.svg')}}">Документы</div>
                <table>
                    <tr>
                        <td>Название</td>
                        <td>Размер</td>
                    </tr>
                    @foreach($files as $file)
                        @php($fileData = \App\Models\Files::getFileByHashName($file))
                        <tr>
                            <td class="fileName"><a href="{{route('file', ['file' => $fileData->hash_name])}}">{{$fileData->name}}</a></td>
                            <td>{{$fileData->size}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    @endforeach
@endsection
