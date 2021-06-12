<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Tasks;
use Illuminate\Http\Request;

class TaskController extends Controller{

    public function __invoke($task){
        $tasks = Tasks::where(['group' => $task])->get();
        return view('task.task', ['tasks' => $tasks]);
    }

}
