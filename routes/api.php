<?php

use App\Http\Controllers\Api\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Route::apiResource('todos', TodoController::class);
Route::group(['prefix' => 'todo'], function () {
    Route::get('list', [TodoController::class, 'index']);
    Route::post('create', [TodoController::class, 'store']);
    Route::get('view/{todo}', [TodoController::class, 'show']);
    Route::match(['put', 'patch'], 'update/{todo}', [TodoController::class, 'update']);
    Route::delete('delete/{todo}', [TodoController::class, 'destroy']);
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index']);
    // Route::post('add', [UserController::class, 'add']);
    // Route::post('update', [UserController::class, 'update']);
});
