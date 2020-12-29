<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DatatableController;
use App\Http\Controllers\PriorityController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\StatusController;
use App\Http\Livewire\TypeComponent;
use Illuminate\Support\Facades\Route;


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

Route::get('login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Route::get('register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class, 'register']);

Route::get('password/reset', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [App\Http\Controllers\Auth\ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [App\Http\Controllers\Auth\ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [App\Http\Controllers\Auth\ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'showConfirmForm'])->name('password.confirm');
Route::post('password/confirm', [App\Http\Controllers\Auth\ConfirmPasswordController::class, 'confirm']);

Route::get('email/verify', [App\Http\Controllers\Auth\VerificationController::class, 'show'])->name('verification.notice');
Route::get('email/verify/{id}/{hash}', [App\Http\Controllers\Auth\VerificationController::class, 'verify'])->name('verification.verify');
Route::post('email/resend', [App\Http\Controllers\Auth\VerificationController::class, 'resend'])->name('verification.resend');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Rutas mias */

/* Route::get('/type', TypeComponent::class); */

Route::resource('/type', TypeController::class)->names('type');

Route::resource('/status', StatusController::class)->names('status');

Route::resource('/priority', PriorityController::class)->names('priority');

Route::resource('/category', CategoryController::class)->names('category');

Route::resource('/class', ClassController::class)->names('class');



/* Datatables */

Route::get('datatable/priority', [DatatableController::class, 'priority'])->name('datatable.priority');

Route::get('datatable/status', [DatatableController::class, 'status'])->name('datatable.status');

Route::get('datatable/type', [DatatableController::class, 'type'])->name('datatable.types');
