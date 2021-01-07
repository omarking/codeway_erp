<?php

namespace App\Http\Livewire\User;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class UserComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $user_id, $nameUser, $firstLastname, $secondLastname, $phone, $name, $email, $corporative, $password, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total, $role, $now, $user, $rool, $pag, $per, $busca;

    public $rules = [
        'nameUser'       => 'required|string|max:100',
        'firstLastname'  => 'required|string|max:100',
        'secondLastname' => 'required|string|max:100',
        'phone'          => 'required|numeric',
        'name'           => 'required|string|max:100|unique:users,name',
        'email'          => 'required|email|max:100|unique:users,email',
        'corporative'    => 'required|email|max:100|unique:users,corporative',
        'password'       => 'required|string|min:8|max:100',
        'role'           => 'required',
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
    ];

    public function mount()
    {
        $this->total = count(User::all());
        $this->now = now();
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

        if (isset($user->roles[0]->name)) {
            $this->role  = $user->roles[0]->name;
        } else {
            $this->role  = "Aún no se asigna un rol";
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
        /* $this->password       = $user->password; */
        $this->status         = $user->status;
        $this->accion         = "update";
        $this->user           = $user;

        if (isset($user->roles[0]->name)) {
            $this->rool  = $user->roles[0]->name;
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
            /* 'password'       => 'required|string|min:8|max:100', */
            'role'           => 'required',
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
                /* 'password'        => Hash::make($this->password), */
                'status'          => $this->status,
            ]);
            if ($this->role) {
                $user->roles()->sync($this->role);
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
            'role',
            'rool',
            'pag',
            'created_at',
            'updated_at',
        ]);
        $this->mount();
    }

    public function clear()
    {
        $this->reset(['search', 'perPage', 'page', 'pag']);
    }

    public function render()
    {
        $roless = Role::orderBy('name')->get();

        if ($this->search != '') {
            $this->pag = $this->page;
            $this->page = 1;
        }
        if ($this->page != 1) {
            $this->pag = $this->perPage;
        }

        return view(
            'livewire.user.user-component',
            [
                'users' => User::latest('id')
                    ->with('roles')
                    ->where('id', 'LIKE', "%{$this->search}%")
                    ->orWhere('nameUser', 'LIKE', "%{$this->search}%")
                    ->orWhere('firstLastname', 'LIKE', "%{$this->search}%")
                    ->orWhere('secondLastname', 'LIKE', "%{$this->search}%")
                    ->orWhere('phone', 'LIKE', "%{$this->search}%")
                    ->orWhere('name', 'LIKE', "%{$this->search}%")
                    ->orWhere('email', 'LIKE', "%{$this->search}%")
                    ->orWhere('corporative', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ],
            compact('roless')
        );
    }
}
