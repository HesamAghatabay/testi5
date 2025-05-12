<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
Route::post('register', [UserController::class, 'register'])->name('register');
Route::post('sendverify', [UserController::class, 'sendverify']);
Route::middleware('auth:api')->get('/user', [UserController::class, 'user']);
Route::middleware('auth:api')->resource('category', CategoryController::class);
Route::middleware('auth:api')->resource('post', PostController::class);
Route::middleware('auth:api')->post('post/{id}/like', function (Request $request, $id) {
    $post = post::find($id);
    $user = $request->user();
    $post->likes()->sync(['user_id']);
    return response()->json(['status' => true]);
});
Route::middleware('auth:api')->post('post/{id}/unlike', function (Request $request, $id) {
    $post = post::find($id);
    $user = $request->user();
    $post->likes()->detach(['user_id']);
    return response()->json(['status' => true]);
});
