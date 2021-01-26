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
        /* $usuario = User::with('departaments')->where('id', '=', $user->id)->get(); */

        foreach ($usuario as $user) {
            $this->usuario = $user;
            foreach ($user->departaments as $departament) {
                $this->departament = $departament;
            }
        }
        /* $this->grupos = Departament::has('groups')->where('id', '=', $this->departament->id)->get(); */
        $grupos = Departament::with('groups')->where('id', '=', $this->departament->id)->get();

        foreach ($grupos as $grupo) {
            $this->grupos = $grupo;
        }
        /* $this->departament = $this->usuario->departaments; */

        /* $this->departamento = Departament::find($this->usuario->departaments[0]->id); */

        /* foreach ($this->departamento->groups as $group) {
            $this->departament_group[] = $group->id;
        } */
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



   /* $this->user = User::where('id', "=", $user)->with('departaments')->get(); */
        /* $this->departament  = $this->user->departaments;
        $this->haber = $this->user->pivot->user_id;
        $this->haber = $user->pivot->departament_id; */

        /* foreach ($this->$user->departaments as $departament) {
        $this->user_departament[]         = $departament->id;
        $this->description[]  = $departament->id;
            $this->responsable[]  = $departament->id;
        } */

        /* $this->name         = $this->user->departaments->name;
        $this->description  = $this->user->departaments->description;
        $this->responsable  = $this->user->departaments->responsable; */
