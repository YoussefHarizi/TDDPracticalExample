<?php

// use Illuminate\Http\Request;

use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\TodoListController;
use Illuminate\Support\Facades\Route;


Route::get('/',HomeController::class);

Route::apiResource('todo-list',TodoListController::class);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
