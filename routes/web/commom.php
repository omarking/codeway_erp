<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
| ------------------------------------------------- - ------------------------
| Common web paths
| ------------------------------------------------- - ------------------------
|
| This is where the common web paths for the codeway system are registered.
| These RouteServiceProvider loads normal routes within a group that
| Contains the middleware group "web".
|
| These routes are very important
|
*/

Route::group(['middleware' => ['auth']], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    /* Route::get('profile/{' . Auth::user() . '}', [ProfileController::class, 'show'])->name('profile'); */
    Route::get('profile', [ProfileController::class, 'show'])->name('profile');
});
