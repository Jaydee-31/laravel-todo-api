<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::group(['prefix' => 'users'], function () {
    Route::get('/', [UserController::class, 'index']);
    // Route::post('add', [UserController::class, 'add']);
    // Route::post('update', [UserController::class, 'update']);

    // Route::post('/create_product', [UserController::class, 'createProduct']);
});
