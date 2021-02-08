<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{

    /* Retorna la vista donde se vera el perfil del usuario */
    public function show(/* User $user */)
    {
        return view('profile.index');
    }

    /* Retorna la vista donde se vera el departamento del usuario */
    public function departament(/* User $user */)
    {
        return view('profile.departament');
    }

    /* Retorna la vista donde se veran los eventos del usuario */
    public function event(/* User $user */)
    {
        return view('profile.event');
    }
}
