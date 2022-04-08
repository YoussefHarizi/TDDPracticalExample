<?php

// use Illuminate\Http\Request;

use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\TodoListController;
use Illuminate\Support\Facades\Route;


Route::get('/',HomeController::class);
Route::get('todo-list',[TodoListController::class,'index'])->name('todo-list.index');
Route::get('todo-list/{list}',[TodoListController::class,'show'])->name('todo-list.show');
Route::post('todo-list',[TodoListController::class,'store'])->name('todo-list.store');
Route::delete('todo-list/{list}',[TodoListController::class,'destroy'])->name('todo-list.destroy');
Route::patch('todo-list/{list}',[TodoListController::class,'update'])->name('todo-list.update');
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
