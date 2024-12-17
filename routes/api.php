<?php

use App\Http\Controllers\OkrController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/users', UserController::class);
Route::get('/roles', [UserController::class, 'getRole']);
Route::get('/user-latest-post/{id}', [UserController::class, 'getLatestPostByUser']);
Route::get('/user-oldest-post/{id}', [UserController::class, 'getOldestPostByUser']);
Route::get('/country/{id}', [UserController::class, 'getCountryById']);
Route::get('/user-post/{id}', [UserController::class, 'getUserPost']);
Route::get('/get-image-by-user/{id}', [UserController::class, 'getImagesByUser']);
Route::get('/get-image-by-post/{id}', [UserController::class, 'getImagesByPost']);

Route::post('/add-new-post', [UserController::class, 'addNewPostToUser']);
Route::delete('/user/{id}', [UserController::class, 'deleteUser']);
Route::apiResource('/okr',  OkrController::class);


//Route::get($uri, $callback);
//Route::post($uri, $callback);
//Route::put($uri, $callback);
//Route::patch($uri, $callback);
//Route::delete($uri, $callback);
//Route::options($uri, $callback);


//Route::get('/user/{id}', function (string $id) {
//    return 'User '.$id;
//});
