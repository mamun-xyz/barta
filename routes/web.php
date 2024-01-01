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
use App\Http\Controllers\SearchController;

// Home Routes
Route::get('/', [HomeController::class, 'Home']);

// Search Routes
Route::get('/search', [SearchController::class, 'Search']);

// Profile Routes
Route::get('/profile/{user_uuid}', [ProfileController::class, 'Profile']);
Route::get('/profile/edit/{user_uuid}', [EditProfileController::class, 'EditProfile'])->middleware('valid.editor');
Route::post('/profile/edit-store/{user_uuid}', [UpdateProfileController::class, 'UpdateInfo']);

// Post Routes
Route::post('/post/store/{user_uuid}', [PostController::class, 'StorePost']);
Route::get('/single-post/{post_uuid}', [PostController::class, 'SinglePost']);
Route::get('/edit-post/{post_uuid}', [PostController::class, 'EditPost']);
Route::post('/edit-post/store/{post_uuid}', [PostController::class, 'StoreEditPost']);
Route::get('/delete-post/{post_uuid}', [PostController::class, 'DeletePost']);

// Comment Routes
Route::post('/store-comment/{post_id}', [CommentController::class, 'StoreComment']);
Route::get('/update-comment/{comment_id}', [CommentController::class, 'UpdateComment']);
Route::post('/store-update-comment/{comment_id}', [CommentController::class, 'StoreUpdateComment']);
Route::get('/delete-comment/{comment_id}', [CommentController::class, 'DeleteComment']);




