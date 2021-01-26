<?php

namespace App\Http\Livewire\User;

use App\Mail\MessageReceived;
use App\Models\Departament;
use App\Models\Profile;
use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Events\TransactionBeginning;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $user_id, $nameUser, $firstLastname, $secondLastname, $phone, $name, $email, $corporative, $password, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total, $role, $now, $user, $rool, $departament;

    public $user_profile, $avatar, $description, $facebook, $instagram, $github, $website, $other, $position;

    public $rules = [
        'nameUser'       => 'required|string|max:100',
        'firstLastname'  => 'required|string|max:100',
        'secondLastname' => 'required|string|max:100',
        'phone'          => 'required|numeric|min:10|max:15|size:10',
        'name'           => 'required|string|max:100|unique:users,name',
        'email'          => 'required|email:rfc,dns,strict,spoof|max:100|unique:users,email',
        'corporative'    => 'required|email|max:100|unique:users,corporative',
        'password'       => 'required|string|min:8|max:100',
        'role'           => 'required',
        'departament'    => 'required',
    ];

    /* protected $messages = [
        'description.required' => 'La descripción es requerida.',
        'description.unique' => 'La descripción ya esta en uso.',
    ]; */

    protected $queryString = [
        'search'  => ['except' => ''],
        'perPage' => ['except' => '10'],
    ];

    protected $validationAttributes = [
        'nameUser'       => 'nombre',
        'firstLastname'  => 'primer apellido',
        'secondLastname' => 'segundo apellido',
        'phone'          => 'telefono',
        'name'           => 'nombre de usuario',
        'email'          => 'email',
        'corporative'    => 'email corporativo',
        'password'       => 'contraseña',
        'role'           => 'rol',
        'departament'    => 'departamento',
    ];

    public function mount()
    {
        $this->total = count(User::all());
        $this->now = now();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'nameUser'       => 'required|string|max:100',
                'firstLastname'  => 'required|string|max:100',
                'secondLastname' => 'required|string|max:100',
                'phone'          => 'required|numeric',
                'name'           => 'required|string|max:100|unique:users,name',
                'email'          => 'required|email|max:100|unique:users,email',
                'corporative'    => 'required|email|max:100|unique:users,corporative',
                'password'       => 'required|string|min:8|max:100',
                'role'           => 'required',
                'departament'    => 'required',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'nameUser'       => 'required|string|max:100',
                'firstLastname'  => 'required|string|max:100',
                'secondLastname' => 'required|string|max:100',
                'phone'          => 'required|numeric',
                'name'           => 'required|string|max:100|unique:users,name,' . $this->user_id,
                'email'          => 'required|email|max:100|unique:users,email,' . $this->user_id,
                'corporative'    => 'required|email|max:100|unique:users,corporative,' . $this->user_id,
                'password'       => 'required|string|min:8|max:100',
                'role'           => 'required',
                'departament'    => 'required',
            ]);
        }
    }

    public function store()
    {
        $this->validate([
            'nameUser'       => 'required|string|max:100',
            'firstLastname'  => 'required|string|max:100',
            'secondLastname' => 'required|string|max:100',
            'phone'          => 'required|numeric',
            'name'           => 'required|string|max:100|unique:users,name',
            'email'          => 'required|email|max:100|unique:users,email',
            'corporative'    => 'required|email|max:100|unique:users,corporative',
            'password'       => 'required|string|min:8|max:100',
            'role'           => 'required',
            'departament'    => 'required',
        ]);
        $user = User::create([
            'nameUser'          => $this->nameUser,
            'firstLastname'     => $this->firstLastname,
            'secondLastname'    => $this->secondLastname,
            'phone'             => $this->phone,
            'name'              => $this->name,
            'email'             => $this->email,
            'corporative'       => $this->corporative,
            'password'          => Hash::make($this->password),
            'email_verified_at' => $this->now,
        ]);
        if ($this->role) {
            $user->roles()->sync($this->role);
        }
        if ($this->departament) {
            $user->departaments()->sync($this->departament);
        }
        Profile::create([
            'user_id' => $user->id,
        ]);
        /* Envio de email */
        /* Mail::to('admin@admin.com')->queue(new MessageReceived($user)); */
        session()->flash('message', 'Usuario creado correctamente.');
        $this->clean();
        $this->emit('userCreatedEvent');
    }

    public function show(User $user)
    {
        $this->user_id        = $user->id;
        $this->nameUser       = $user->nameUser;
        $this->firstLastname  = $user->firstLastname;
        $this->secondLastname = $user->secondLastname;
        $this->phone          = $user->phone;
        $this->name           = $user->name;
        $this->email          = $user->email;
        $this->corporative    = $user->corporative;
        $this->status         = $user->status;
        $this->created_at     = $user->created_at;
        $this->updated_at     = $user->updated_at;
        $this->user           = $user;

        if (isset($user->profile->id)) {
            $this->user_profile   = $user;
            $this->avatar         = $user->profile->avatar;
            $this->description    = $user->profile->description;
            if ($user->profile->facebook == "") {
                $this->facebook       = null;
            } else {
                $this->facebook       = $user->profile->facebook;
            }

            if ($user->profile->instagram == "") {
                $this->instagram       = null;
            } else {
                $this->instagram       = $user->profile->instagram;
            }

            if ($user->profile->github == "") {
                $this->github       = null;
            } else {
                $this->github       = $user->profile->github;
            }

            if ($user->profile->website == "") {
                $this->website       = null;
            } else {
                $this->website       = $user->profile->website;
            }

            if ($user->profile->other == "") {
                $this->other       = null;
            } else {
                $this->other       = $user->profile->other;
            }
            $this->position       = $user->profile->position_id;
        } else {
            $this->user_profile   = "nothing";
            $this->avatar         = "nothing";
            $this->description    = "nothing";
            $this->facebook       = null;
            $this->instagram      = null;
            $this->github         = null;
            $this->website        = null;
            $this->other          = null;
            $this->position       = "nothing";
        }

        if (isset($user->roles[0]->name)) {
            $this->role  = $user->roles[0]->name;
        } else {
            $this->role  = "Aún no se le ha asignado un rol";
        }

        if (isset($user->departaments[0]->name)) {
            $this->departament  = $user->departaments[0]->name;
        } else {
            $this->departament  = "Aún no se le ha asignado a un departamento";
        }
    }

    public function close()
    {
        $this->clean();
        $this->emit('userShowEvent');
    }

    public function edit(User $user)
    {
        $this->user_id        = $user->id;
        $this->nameUser       = $user->nameUser;
        $this->firstLastname  = $user->firstLastname;
        $this->secondLastname = $user->secondLastname;
        $this->phone          = $user->phone;
        $this->name           = $user->name;
        $this->email          = $user->email;
        $this->corporative    = $user->corporative;
        $this->status         = $user->status;
        $this->accion         = "update";
        $this->user           = $user;
        $this->user_profile   = $user;

        foreach ($user->roles as $role) {
            $this->role = $role->id;
        }

        foreach ($user->departaments as $departament) {
            $this->departament = $departament->id;
        }
    }

    public function update()
    {
        $this->validate([
            'nameUser'       => 'required|string|max:100',
            'firstLastname'  => 'required|string|max:100',
            'secondLastname' => 'required|string|max:100',
            'phone'          => 'required|numeric',
            'name'           => 'required|string|max:100|unique:users,name,' . $this->user_id,
            'email'          => 'required|email|max:100|unique:users,email,' . $this->user_id,
            'corporative'    => 'required|email|max:100|unique:users,corporative,' . $this->user_id,
            'role'           => 'required',
            'departament'    => 'required',
        ]);
        if ($this->user_id) {
            $user = User::find($this->user_id);
            $user->update([
                'nameUser'        => $this->nameUser,
                'firstLastname'   => $this->firstLastname,
                'secondLastname'  => $this->secondLastname,
                'phone'           => $this->phone,
                'name'            => $this->name,
                'email'           => $this->email,
                'corporative'     => $this->corporative,
                'status'          => $this->status,
            ]);
            if ($this->role) {
                $user->roles()->sync($this->role);
            }
            if ($this->departament) {
                $user->departaments()->sync($this->departament);
            }
            session()->flash('message', 'Usuario actualizado correctamente.');
            $this->clean();
            $this->emit('userUpdatedEvent');
        }
    }

    public function delete(User $user)
    {
        $this->user_id         = $user->id;
        $this->nameUser        = $user->nameUser;
        $this->firstLastname   = $user->firstLastname;
        $this->secondLastname  = $user->secondLastname;
    }

    public function destroy()
    {
        User::find($this->user_id)->delete();
        session()->flash('message', 'Usuario eliminado correctamente.');
        $this->clean();
        $this->emit('userDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'user_id',
            'nameUser',
            'firstLastname',
            'secondLastname',
            'phone',
            'name',
            'email',
            'corporative',
            'password',
            'status',
            'accion',
            'user',
            'role',
            'rool',
            'created_at',
            'updated_at',
            'user_profile',
            'departament',
        ]);
        $this->mount();
    }

    public function clear()
    {
        $this->reset(['search', 'perPage', 'page']);
    }

    public function render()
    {
        $roless = Role::orderBy('name')->get();

        $departamentss = Departament::orderBy('name')->get();

        if ($this->search != '') {
            $this->page = 1;
        }
        if (isset(($this->total)) && ($this->perPage > $this->total) && ($this->page != 1)) {
            $this->reset(['perPage']);
        }

        return view(
            'livewire.user.user-component',
            [
                'users' => User::latest('id')
                    ->with('roles', 'profile', 'departaments')
                    ->where('nameUser', 'LIKE', "%{$this->search}%")
                    ->orWhere('firstLastname', 'LIKE', "%{$this->search}%")
                    ->orWhere('secondLastname', 'LIKE', "%{$this->search}%")
                    ->orWhere('phone', 'LIKE', "%{$this->search}%")
                    ->orWhere('name', 'LIKE', "%{$this->search}%")
                    ->orWhere('email', 'LIKE', "%{$this->search}%")
                    ->orWhere('corporative', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ],
            compact('roless', 'departamentss')
        );
    }
}
