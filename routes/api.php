<?php

// use Illuminate\Http\Request;

use App\Http\Controllers\Api\V1\HomeController;
use Illuminate\Support\Facades\Route;


Route::get('/',HomeController::class);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
