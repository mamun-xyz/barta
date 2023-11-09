<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\UpdateProfileController;
use App\Http\Controllers\HomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'Home']);

Route::get('/register', [RegisterController::class, 'Register']);
Route::post('/register', [RegisterController::class, 'StoreRegister'])->name('register.store');

Route::get('/login', [LoginController::class, 'Login'])->name('login');
Route::post('/login-post', [LoginController::class, 'LoginPost'])->name('login.post');
Route::get('logout', [LoginController::class, 'Logout'])->name('logout');

Route::get('/profile/{id}', [ProfileController::class, 'Profile']);
Route::get('/profile/edit/{id}', [EditProfileController::class, 'EditProfile']);
Route::post('/profile/edit-post/{id}', [UpdateProfileController::class, 'UpdateInfo']);

