<?php

// use Illuminate\Http\Request;

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\HomeController;
use App\Http\Controllers\Api\V1\LabelController;
use App\Http\Controllers\Api\V1\ServiceController;
use App\Http\Controllers\Api\V1\TaskController;
use App\Http\Controllers\Api\V1\TodoListController;
use Illuminate\Support\Facades\Route;


Route::get('/',HomeController::class);

Route::post('/register',[AuthController::class,'register'])->name('user.register');
Route::post('/login',[AuthController::class,'login'])->name('user.login');


Route::middleware('auth:sanctum')->group(function(){
    
    Route::apiResource('todo-list',TodoListController::class);
    Route::apiResource('todo-list.task',TaskController::class)
    ->except('show')
    ->shallow();

    Route::apiResource('label',LabelController::class);

    Route::get('google/connect/{service}',[ServiceController::class,'connect'])->name('service.connect');
    Route::post('google/callback',[ServiceController::class,'callback'])->name('service.callback');
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
