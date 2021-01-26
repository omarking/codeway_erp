<?php

namespace App\Http\Livewire\Profile;

use App\Models\Category;
use App\Models\Clas;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MiprojectsComponent extends Component
{
    public $usuario, $proyectos, $user;

    public function mount()
    {
        $this->user = Auth::user();

        $this->usuario   = User::with('projects')->where('id', '=', $this->user->id)->get();

        $this->proyectos = Project::with('users')->get();
    }

    public function render()
    {
        return view('livewire.profile.miprojects-component');
    }
}
