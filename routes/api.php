<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);
    Route::put('/users/{user}',[UserController::class,'update']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);
    Route::get('/users/{user}', [UserController::class, 'show']);
});