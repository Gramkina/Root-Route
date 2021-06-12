<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Models\Files;
use App\Models\Tasks;
use App\Models\UserData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TaskAddController extends Controller{

    public function index(Request $request){
        $users = UserData::all();
        $files = Files::where(['storage' => Auth::user()->login])->get();
        return view('task.task_add', ['users' => $users, 'files' => $files]);
    }

    public function addTask(Request $request){
        $tasks = $request['data'];
        $sharedName = $request['sharedName'];
        $sharedDescription = $request['sharedDescription'];
        DB::transaction(function () use($tasks, $sharedName, $sharedDescription){
            $group = Str::uuid();
            foreach($tasks as $task){
                $executor = UserData::where(['id' => $task['executor']])->firstOrFail();
                $taskM = new Tasks();
                $taskM->add($task['type'], $executor, $task['start_date'], $task['finish_date'], $task['taskName'], $task['taskDescription'], $group, $sharedName, $sharedDescription, json_encode($task['files']));
            }
        });
        return 1;
    }

}
