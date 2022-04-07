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
        $list=TodoList::create($request->all());
        return $list;
    }
}
