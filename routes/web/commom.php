<?php

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

});
