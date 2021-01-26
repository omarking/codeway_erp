<?php

namespace App\Http\Livewire\Permission;

use App\Models\Permission;
use Livewire\Component;
use Livewire\WithPagination;

class PermissionComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $permission_id, $name, $description, $slug, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total;

    public $rules = [
        'name'         => 'required|string|max:100|unique:permissions,name',
        'slug'         => 'required|string|max:100|unique:permissions,slug',
        'description'  => 'required|string',
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
        'description'   => 'descripción',
        'slug'          => 'slug',
    ];

    public function mount()
    {
        $this->total = count(Permission::all());
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'name'         => 'required|string|max:100|unique:permissions,name',
                'slug'         => 'required|string|max:100|unique:permissions,slug',
                'description'  => 'required|string',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'name'         => 'required|string|max:100|unique:permissions,name,' . $this->permission_id,
                'slug'         => 'required|string|max:100|unique:permissions,slug,' . $this->permission_id,
                'description'  => 'required|string',
            ]);
        }
    }

    public function store()
    {
        $this->validate([
            'name'         => 'required|string|max:100|unique:permissions,name',
            'slug'         => 'required|string|max:100|unique:permissions,slug',
            'description'  => 'required|string',
        ]);
        Permission::create([
            'name'          => $this->name,
            /* 'slug'          => $this->slug, */
            'description'   => $this->description,
        ]);
        session()->flash('message', 'Permiso creado correctamente.');
        $this->clean();
        $this->emit('permissionCreatedEvent');
    }

    public function show(Permission $permission)
    {
        $this->permission_id    = $permission->id;
        $this->name             = $permission->name;
        $this->slug             = $permission->slug;
        $this->description      = $permission->description;
        $this->status           = $permission->status;
        $this->created_at       = $permission->created_at;
        $this->updated_at       = $permission->updated_at;
    }

    public function close()
    {
        $this->clean();
        $this->emit('permissionShowEvent');
    }

    public function edit(Permission $permission)
    {
        $this->permission_id    = $permission->id;
        $this->name             = $permission->name;
        $this->slug             = $permission->slug;
        $this->description      = $permission->description;
        $this->status           = $permission->status;
        $this->accion           = "update";
    }

    public function update()
    {
        $this->validate([
            'name'         => 'required|string|max:100|unique:permissions,name,' . $this->permission_id,
            'slug'         => 'required|string|max:100|unique:permissions,slug,' . $this->permission_id,
            'description'  => 'required|string',
        ]);
        if ($this->permission_id) {
            $permissions = Permission::find($this->permission_id);
            $permissions->update([
                'name'          => $this->name,
                /* 'slug'          => $this->slug, */
                'description'   => $this->description,
                'status'        => $this->status,
            ]);
            session()->flash('message', 'Permiso actualizado correctamente.');
            $this->clean();
            $this->emit('permissionUpdatedEvent');
        }
    }

    public function delete(Permission $permissions)
    {
        $this->permission_id    = $permissions->id;
        $this->name             = $permissions->name;
    }

    public function destroy()
    {
        Permission::find($this->permission_id)->delete();
        session()->flash('message', 'Permiso eliminado correctamente.');
        $this->clean();
        $this->emit('permissionDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'permission_id',
            'name',
            'slug',
            'description',
            'status',
            'accion',
            'created_at',
            'updated_at',
        ]);
        $this->mount();
    }

    public function clear()
    {
        $this->reset(['search', 'perPage', 'page']);
    }

    public function render()
    {
        if ($this->search != '') {
            $this->page = 1;
        }
        if (isset(($this->total)) && ($this->perPage > $this->total) && ($this->page != 1)) {
            $this->reset(['perPage']);
        }

        return view(
            'livewire.permission.permission-component',
            [
                'permissions' => Permission::latest('id')
                    ->where('name', 'LIKE', "%{$this->search}%")
                    ->orWhere('slug', 'LIKE', "%{$this->search}%")
                    ->orWhere('description', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ]
        );
    }
}
