<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
Route::post('register', [UserController::class, 'register'])->name('register');
Route::post('sendverify', [UserController::class, 'sendverify']);
Route::middleware('auth:api')->resource('category', CategoryController::class);
