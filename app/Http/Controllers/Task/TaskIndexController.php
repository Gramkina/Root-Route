<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use App\Models\UserData;
use Illuminate\Http\Request;

class TaskIndexController extends Controller{

    public function indexMyTask(){
        $tasks = Tasks::where(['customer' => UserData::getUserDataCurrentUser()->id])->get();
        return view('task.tasks', ['tasks' => $tasks]);
    }

    public function indexToMeTask(){
        $tasks = Tasks::where(['executor' => UserData::getUserDataCurrentUser()->id])->get();
        return view('task.task_tome', ['tasks' => $tasks]);
    }

}
