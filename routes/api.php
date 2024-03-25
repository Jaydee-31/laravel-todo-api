<?php

use App\Http\Controllers\Api\Auth\AuthenticationController;
use App\Http\Controllers\Api\SurveyController;
use App\Http\Controllers\Api\TodoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('login', [AuthenticationController::class, 'login']);
Route::post('signup', [AuthenticationController::class, 'signup']);
Route::post('logout', [AuthenticationController::class, 'logout'])->middleware(['auth:api']);

Route::apiResource('survey', SurveyController::class)->middleware(['auth:api']);

Route::group(['prefix' => 'todo', 'middleware' => ['auth:api']], function () {
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
