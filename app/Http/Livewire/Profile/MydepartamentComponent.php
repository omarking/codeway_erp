<?php

namespace App\Http\Livewire\Profile;

use App\Models\Departament;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class MydepartamentComponent extends Component
{
    public $departament, $name = [], $description = [], $responsable = [];

    public $user, $user_departament;

    public $grupos, $group, $departamento, $usuario;

    public $departament_group = [];


    public function mount()
    {
        $user = Auth::user();
        $usuario = User::with('departaments')->where('id', '=', $user->id)->get();
        foreach ($usuario as $user) {
            $this->usuario = $user;
            foreach ($user->departaments as $departament) {
                $this->departament = $departament;
            }
        }
        $grupos = Departament::with('groups')->where('id', '=', $this->departament->id)->get();
        foreach ($grupos as $grupo) {
            $this->grupos = $grupo;
        }
    }

    public function render()
    {
        $departaments = Departament::all();
        $groupss      = Group::all();
        return view(
            'livewire.profile.mydepartament-component',
            [
                'users' => User::latest('id')->get()
            ],
            compact('departaments', 'groupss')
        );
    }
}
