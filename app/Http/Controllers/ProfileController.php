<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{

    /* Retorna la vista donde se vera el perfil del usuario */
    public function show(/* User $user */)
    {
        Gate::authorize('haveaccess', 'profile.index');

        return view('profile.index');
    }

    /* Retorna la vista donde se vera el departamento del usuario */
    public function departament(/* User $user */)
    {
        Gate::authorize('haveaccess', 'profile.index');
        
        return view('profile.departament');
    }
}
