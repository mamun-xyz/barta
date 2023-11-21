<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\UpdateProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;




Route::get('/', [HomeController::class, 'Home']);

Route::get('/register', [RegisterController::class, 'Register']);
Route::post('/register', [RegisterController::class, 'StoreRegister'])->name('register.store');

Route::get('/login', [LoginController::class, 'Login'])->name('login');
Route::post('/login-post', [LoginController::class, 'LoginPost'])->name('login.post');
Route::get('logout', [LoginController::class, 'Logout'])->name('logout');

Route::get('/profile/{uuid}', [ProfileController::class, 'Profile']);
Route::get('/profile/edit/{uuid}', [EditProfileController::class, 'EditProfile'])->middleware('valid.editor');
Route::post('/profile/edit-post/{uuid}', [UpdateProfileController::class, 'UpdateInfo']);

Route::post('/post/store/{uuid}', [PostController::class, 'StorePost']);
Route::get('/single-post/{uuid}', [PostController::class, 'SinglePost']);
Route::get('/edit-post/{uuid}', [PostController::class, 'EditPost'])->middleware('valid.user');
Route::post('/edit-post/store/{uuid}', [PostController::class, 'StoreEditPost']);
Route::get('/delete-post/{uuid}', [PostController::class, 'DeletePost'])->middleware('valid.user');

