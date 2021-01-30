<?php

namespace App\Http\Livewire\Profile;

use App\Models\Departament;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Psy\Exception\BreakException;

class MydepartamentComponent extends Component
{
    public $departament, $component, $value;

    public $user, $user_departament;

    public $grupos, $group, $departamento, $usuario;

    public $departament_group = [];



    public function mount()
    {
        $user = Auth::user();
        $this->component = null;
        $usuario = User::with('departaments', 'groups')->where('id', '=', $user->id)->get();
        foreach ($usuario as $user) {
            $this->usuario = $user;
            foreach ($user->departaments as $departament) {
                $this->departament = $departament;
            }
            foreach ($user->groups as $group) {
                $this->group = $group;
            }
        }
        $grupos = Departament::with('groups')->where('id', '=', $this->departament->id)->get();
        foreach ($grupos as $grupo) {
            $this->grupos = $grupo;
        }
    }

    public function send($component)
    {
        /* $this->emitTo('comment.comment-component', 'veamos'); */
        /* $this->emit('postAdded', $component); */
        /* $this->emitUp('postAdded', $component); */
        if (isset($component)) {
            $this->component = $component;
            $this->value = $component;
        }else{
            $this->component = null;
        }
    }

    public function render()
    {
        $departaments = Departament::all();
        $groupss      = Group::all();
        $this->component = $this->value;
        return view(
            'livewire.profile.mydepartament-component',
            [
                'users' => User::latest('id')->get()
            ],
            compact('departaments', 'groupss')
        );
    }
}
