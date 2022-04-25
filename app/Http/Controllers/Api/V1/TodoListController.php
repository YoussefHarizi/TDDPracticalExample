<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TodoListRequest;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index()
    {
        return auth()->user()->todo_lists;

    }

    public function show(TodoList $todo_list)
    {
        return response($todo_list);
    }

    public function store(TodoListRequest $request)
    {
        return auth()->user()->todo_lists()->create($request->validated());
       
    }

    public function destroy(TodoList $todo_list)
    {
        $todo_list->delete();
        return response('',204);
    }

    public function update(TodoList $todo_list,TodoListRequest $request)
    {
        
        $todo_list->update($request->all());
        return response($todo_list);
    }
}
