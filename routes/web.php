<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


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

Route::get('/',[UserController::class,'index'])->name('home');
// Route::get('/register',[UserController::class,'register'])->name('register');
Route::get('/register',[AuthManager::class,'register'])->name('register');
Route::post('/registerPost',[AuthManager::class,'registerPost'])->name('register.post');
Route::get('/login',[AuthManager::class,'login'])->name('login');
Route::post('/loginPost',[AuthManager::class,'loginPost'])->name('login.post');
Route::get('/logout',[AuthManager::class,'logout'])->name('logout');
Route::get('/profile',[UserController::class,'profile'])->name('profile');
Route::get('/editProfile',[UserController::class,'editProfile'])->name('edit.profile');
