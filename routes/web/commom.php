<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Models\User;
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

Route::get('veamos', function () {

    $user = User::find(1);
    /* $user = User::with('roles', 'groups')->where('id', '=', 1)->get(); */

    return $user->havePermission('category.index');
});

Route::group(['middleware' => ['auth']], function () {

    Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('dashboard', [App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');

    Route::get('profile', [ProfileController::class, 'show'])->name('profile');

    Route::get('mydepartament', [ProfileController::class, 'departament'])->name('mydepartament');

    Route::get('myevent', [ProfileController::class, 'event'])->name('myevent');

    Route::get('project/{project}', [ProjectController::class, 'show'])->name('project.show');
});
