<?php

use App\Http\Controllers\OkrController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/greeting', function () {
    return 'Hello World';
});

Route::apiResource('users', UserController::class);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::get('/test', function () {
    return response()->json(['message' => 'Hello World!'], 200);
});


//Route::apiResource('okr', OkrController::class);
//Route::Post('/okr', [OkrController::class, 'store']);
