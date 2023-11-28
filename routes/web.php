<?php

require __DIR__.'/auth.php';

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\UpdateProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;


Route::get('/', [HomeController::class, 'Home']);

Route::get('/profile/{uuid}', [ProfileController::class, 'Profile']);
Route::get('/profile/edit/{uuid}', [EditProfileController::class, 'EditProfile'])->middleware('valid.editor');
Route::post('/profile/edit-post/{uuid}', [UpdateProfileController::class, 'UpdateInfo']);

Route::post('/post/store/{uuid}', [PostController::class, 'StorePost']);
Route::get('/single-post/{uuid}', [PostController::class, 'SinglePost']);
Route::get('/edit-post/{uuid}', [PostController::class, 'EditPost']);
Route::post('/edit-post/store/{uuid}', [PostController::class, 'StoreEditPost']);
Route::get('/delete-post/{uuid}', [PostController::class, 'DeletePost']);

Route::post('/store-comment/{post_id}', [CommentController::class, 'StoreComment']);
Route::get('/update-comment/{comment_id}', [CommentController::class, 'UpdateComment']);
Route::post('/store-update-comment/{comment_id}', [CommentController::class, 'StoreUpdateComment']);
Route::get('/delete-comment/{comment_id}', [CommentController::class, 'DeleteComment']);




