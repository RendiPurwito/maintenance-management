<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use jazmy\FormBuilder\Controllers\FormController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Auth
Route::get('/', [LoginController::class, 'login']);
Route::post('/', [LoginController::class, 'authenticate'])->middleware('guest');
Route::get('/logout',[LoginController::class,'logout']);
Route::get('/register', [LoginController::class, 'register'])->middleware('guest');
Route::post('/register', [LoginController::class, 'storeregister'])->middleware('guest');

// Dashboard Admin
Route::get('/admin', function(){
    return view('admin.dashboard');
})->name('admin-dashboard')->middleware('admin');

// Dashboard User
Route::get('/dashboard', [FormController::class, 'formList'])->name('dashboard');

// Admin CRUD User
Route::get('/admin/user', [UserController::class, 'index'])->name('user')->middleware('admin');
Route::get('/admin/user/create', [UserController::class, 'create'])->middleware('admin');
Route::post('/admin/user', [UserController::class, 'store'])->middleware('admin');
Route::get('/admin/user/{id}/edit', [UserController::class, 'edit'])->middleware('admin');
Route::post('/admin/user/{id}', [UserController::class, 'update'])->middleware('admin');
Route::get('/admin/user/{id}', [UserController::class, 'destroy'])->middleware('admin');

