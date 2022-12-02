<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
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
Route::get('/', [AuthController::class, 'login']);
Route::post('/', [AuthController::class, 'authenticate'])->middleware('guest');
Route::get('/logout',[AuthController::class,'logout']);
Route::get('/register', [AuthController::class, 'register'])->middleware('guest');
Route::post('/register', [AuthController::class, 'storeregister'])->middleware('guest');
Route::get('/forget-password', [AuthController::class, 'showForgetPasswordForm'])->name('forget.password.get')->middleware('guest');
Route::post('/forget-password', [AuthController::class, 'submitForgetPasswordForm'])->name('forget.password.post')->middleware('guest');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('/reset-password/{token}', [AuthController::class, 'submitResetPasswordForm'])->name('reset.password.post');

// Dashboard Admin
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin-dashboard')->middleware('admin');

// Mark read notification
Route::post('/mark-as-read', [AdminController::class, 'markNotif'])->name('markNotif');

// Dashboard User
Route::get('/dashboard', [FormController::class, 'formList'])->name('dashboard');

// Admin CRUD User
Route::get('/admin/user', [AdminController::class, 'index'])->name('user')->middleware('admin');
Route::get('/admin/user/pdf', [AdminController::class, 'pdf'])->middleware('admin');
Route::get('/admin/user/create', [AdminController::class, 'create'])->middleware('admin');
Route::post('/admin/user', [AdminController::class, 'store'])->middleware('admin');
Route::get('/admin/user/{id}/edit', [AdminController::class, 'edit'])->middleware('admin');
Route::post('/admin/user/{id}', [AdminController::class, 'update'])->middleware('admin');
Route::delete('/admin/user/{id}', [AdminController::class, 'destroy'])->name('delUser')->middleware('admin');

// Form PDF
Route::get('/admin/form/pdf', [FormController::class, 'pdf'])->middleware('admin');
// Route::get('/admin/form/form-pdf/{id}', [FormController::class, 'formpdf'])->name('formpdf')->middleware('admin');
Route::get('/admin/form/form-pdf/{id}', [FormController::class, 'formpdf'])->name('formpdf')->middleware('admin');