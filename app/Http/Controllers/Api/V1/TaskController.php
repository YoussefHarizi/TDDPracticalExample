<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TodoList;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TaskController extends Controller
{
    public function index(TodoList $todoList)
    {
        return Task::where('todo_list_id',$todoList->id)->get();
    }

    public function store(Request $request,TodoList $todoList)
    {
        $request['todo_list_id']=$todoList->id;
        return Task::create($request->all());
    }

    public function update(Task $task,Request $request)
    {
        $task->update($request->all());
        return $task;
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response('',Response::HTTP_NO_CONTENT);
    }
}
