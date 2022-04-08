<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\TodoList;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    public function index()
    {
        $lists=TodoList::all();
        return response($lists);
    }

    public function show(TodoList $list)
    {
        return response($list);
    }

    public function store(Request $request)
    {
        $todo=$request->validate([
            'name'=>'required'
        ]);
        $list=TodoList::create($todo);
        return $list;
    }

    public function destroy(TodoList $list)
    {
        $list->delete();
        return response('',204);
    }

    public function update(TodoList $list,Request $request)
    {
        $todo=$request->validate([
            'name'=>'required'
        ]);
        $list->update($todo);
        return response($list);
    }
}
