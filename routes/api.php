<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Api\TodoController;
use App\Http\Controllers\Api\SurveyController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\Auth\PasswordController;
use App\Http\Controllers\Api\Auth\AuthenticationController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('login', [AuthenticationController::class, 'login'])->name('login');
Route::post('signup', [AuthenticationController::class, 'signup']);
Route::post('logout', [AuthenticationController::class, 'logout'])->middleware(['auth:api']);
Route::get('me', [AuthenticationController::class, 'me'])->middleware(['auth:api']);

Route::apiResource('survey', SurveyController::class)->middleware(['auth:api']);
Route::apiResource('profile', ProfileController::class)->middleware(['auth:api']);
Route::put('password', [PasswordController::class, 'update'])->middleware(['auth:api']);

Route::group(['prefix' => 'todo', 'middleware' => ['auth:api']], function () {
    Route::get('list', [TodoController::class, 'index']);
    Route::post('create', [TodoController::class, 'store']);
    Route::get('show/{todo}', [TodoController::class, 'show']);
    Route::match(['put', 'patch'], 'update/{todo}', [TodoController::class, 'update']);
    Route::delete('delete/{todo}', [TodoController::class, 'destroy']);
});

Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index']);
    // Route::post('add', [UserController::class, 'add']);
    // Route::post('update', [UserController::class, 'update']);
});
