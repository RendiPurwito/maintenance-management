<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});

// Admin User
Route::get('/admin/user', [UserController::class, 'index'])->name('user');
Route::get('/admin/user/create', [UserController::class, 'create']);
Route::post('/admin/user', [UserController::class, 'store']);
Route::get('/admin/user/{id}/edit', [UserController::class, 'edit']);
Route::post('/admin/user/{id}', [UserController::class, 'update']);
Route::get('/admin/user/{id}', [UserController::class, 'destroy']);

