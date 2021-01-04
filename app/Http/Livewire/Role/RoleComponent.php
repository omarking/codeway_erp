<?php

namespace App\Http\Livewire\Role;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class RoleComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $role_id, $name, $slug, $description, $full_access, $responsable, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total;

    public $role, $permission = [];

    public $rules = [
        'name'         => 'required|string|max:100|unique:roles,name',
        'slug'         => 'required|string|max:100|unique:roles,slug',
        'description'  => 'required|string',
        'resposanble'  => 'required|string',
        'full-access'  => 'required|in:yes,no',
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
        'name'          => 'nombre',
        'slug'          => 'slug',
        'description'   => 'descripción',
        'resposanble'   => 'responsable',
        'full-access'    => 'acceso total',
    ];

    public function mount()
    {
        $this->total = count(Role::all());
        $this->responsable = Auth::user()->name;
        $this->full_access = null;
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'name'         => 'required|string|max:100|unique:roles,name',
                'slug'         => 'required|string|max:100|unique:roles,slug',
                'description'  => 'required|string',
                'responsable'  => 'required|string',
                'full-access'  => 'required|in:yes,no',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'name'         => 'required|string|max:100|unique:roles,name,' . $this->role_id,
                'slug'         => 'required|string|max:100|unique:roles,slug,' . $this->role_id,
                'description'  => 'required|string',
                'responsable'  => 'required|string',
                'full-access'  => 'required|in:yes,no',
            ]);
        }
    }

    public function store()
    {
        $validateData = $this->validate([
            'name'         => 'required|string|max:100|unique:roles,name',
            'slug'         => 'required|string|max:100|unique:roles,slug',
            'description'  => 'required|string',
            'responsable'  => 'required|string',
            'full-access'  => 'required|in:yes,no',
        ]);

        $this->role = Role::create($validateData);

        return $this->role;
        /* $role->get('permissions'); */

        /* $role->permissions()->sync($request->get('permission')); */

        session()->flash('message', 'Rol creado correctamente.');
        $this->clean();
        $this->emit('roleCreatedEvent');
    }

    public function show(Role $role)
    {
        $this->role_id      = $role->id;
        $this->name         = $role->name;
        $this->slug         = $role->slug;
        $this->description  = $role->description;
        $this->responsable  = $role->responsable;
        $this->full_access  = $role->full_access;
        $this->status       = $role->status;
        $this->created_at   = $role->created_at;
        $this->updated_at   = $role->updated_at;
    }

    public function close()
    {
        $this->clean();
        $this->emit('roleShowEvent');
    }

    public function edit(Role $role)
    {
        $this->role_id      = $role->id;
        $this->name         = $role->name;
        $this->slug         = $role->slug;
        $this->description  = $role->description;
        $this->responsable  = $role->responsable;
        $this->full_access  = $role->full_access;
        $this->status       = $role->status;
        $this->accion       = "update";
    }

    public function update()
    {
        $this->validate([
            'name'         => 'required|string|max:100|unique:roles,name,' . $this->role_id,
            'slug'         => 'required|string|max:100|unique:roles,slug,' . $this->role_id,
            'description'  => 'required|string',
            'responsable'  => 'required|string',
            'full-access'  => 'required|in:yes,no',
        ]);
        if ($this->role_id) {
            $permissions = Role::find($this->role_id);
            $permissions->update([
                'name'          => $this->name,
                'slug'          => $this->slug,
                'description'   => $this->description,
                'responsable'   => $this->responsable,
                'full-access'   => $this->full_access,
                'status'        => $this->status,
            ]);
            session()->flash('message', 'Rol actualizado correctamente.');
            $this->clean();
            $this->emit('roleUpdatedEvent');
        }
    }

    public function delete(Role $role)
    {
        $this->role_id   = $role->id;
        $this->name      = $role->name;
    }

    public function destroy()
    {
        Role::find($this->role_id)->delete();
        session()->flash('message', 'Rol eliminado correctamente.');
        $this->clean();
        $this->emit('roleDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'role_id',
            'name',
            'slug',
            'description',
            'responsable',
            'full_access',
            'status',
            'accion',
            'created_at',
            'updated_at',
        ]);
        $this->responsable = Auth::user()->name;
    }

    public function clear()
    {
        $this->reset(['search', 'perPage', 'page']);
    }

    public function render()
    {
        $permissions = Permission::get();
        return view(
            'livewire.role.role-component',
            [
                'roles' => Role::where('id', 'LIKE', "%{$this->search}%")
                    ->orWhere('name', 'LIKE', "%{$this->search}%")
                    ->orWhere('slug', 'LIKE', "%{$this->search}%")
                    ->orWhere('description', 'LIKE', "%{$this->search}%")
                    ->orWhere('responsable', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ],
            compact('permissions')
        );
    }
}
