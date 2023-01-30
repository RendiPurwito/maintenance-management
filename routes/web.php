<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use jazmy\FormBuilder\Controllers\FormController;
use jazmy\FormBuilder\Controllers\SubmissionController;

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
Route::get('/admin/user', [AdminController::class, 'index'])->name('user.index')->middleware('admin');
Route::get('/admin/user/pdf', [AdminController::class, 'pdf'])->middleware('admin');
Route::get('/admin/user/create', [AdminController::class, 'create'])->middleware('admin');
Route::post('/admin/user', [AdminController::class, 'store'])->middleware('admin');
Route::get('/admin/user/{id}/edit', [AdminController::class, 'edit'])->middleware('admin');
Route::post('/admin/user/{id}', [AdminController::class, 'update'])->middleware('admin');
Route::delete('/admin/user/{id}', [AdminController::class, 'destroy'])->name('delUser')->middleware('admin');

// Print
Route::get('/form-builder/forms/pdf/{id}', [FormController::class, 'pdf'])->name('formpdf')->middleware('admin');
Route::get('/admin/submission/pdf/{id}', [SubmissionController::class, 'pdf'])->middleware('admin');

// Restore Data
Route::get('/admin/user/restore/{id}', [AdminController::class, 'restore'])->name('user.restore');
Route::get('/admin/user/restore_all', [AdminController::class, 'restore_all'])->name('user.restore_all');

Route::get('/form-builder/forms/restore/{id}', [FormController::class, 'restore'])->name('form.restore');
Route::get('/form-builder/forms/restore_all', [FormController::class, 'restore_all'])->name('form.restore_all');

Route::get('/form-builder/forms/submissions/restore/{id}', [SubmissionController::class, 'restore'])->name('submission.restore');
Route::get('/form-builder/forms/submissions/restore_all', [SubmissionController::class, 'restore_all'])->name('submission.restore_all');