<?php

namespace App\Http\Livewire\Departament;

use App\Models\Departament;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class DepartamentComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $departament_id, $name, $description, $responsable, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total;

    public $departament_group = [], $group = [], $departamento;

    public $rules = [
        'name'         => 'required|string|max:200|unique:departaments,name',
        'description'  => 'required|string',
        'responsable'  => 'required|string',
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
        'responsable'   => 'responsable',
    ];

    public function mount()
    {
        $this->total = count(Departament::all());
        $this->responsable = Auth::user()->name;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'name'         => 'required|string|max:200|unique:departaments,name',
                'description'  => 'required|string',
                'responsable'  => 'required|string',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'name'         => 'required|string|max:200|unique:departaments,name,' . $this->departament_id,
                'description'  => 'required|string',
                'responsable'  => 'required|string',
            ]);
        }
    }

    public function store()
    {
        $this->validate([
            'name'         => 'required|string|max:200|unique:departaments,name',
            'description'  => 'required|string',
            'responsable'  => 'required|string',
        ]);
        $departament = Departament::create([
            'name'          => $this->name,
            'description'   => $this->description,
            'responsable'   => Auth::user()->name,
        ]);
        $departament->groups()->sync($this->group);
        session()->flash('message', 'Departamento creado correctamente.');
        $this->clean();
        $this->emit('departamentCreatedEvent');
    }

    public function show(Departament $departament)
    {
        $this->departament_id     = $departament->id;
        $this->name               = $departament->name;
        $this->description        = $departament->description;
        $this->responsable        = $departament->responsable;
        $this->status             = $departament->status;
        $this->created_at         = $departament->created_at;
        $this->updated_at         = $departament->updated_at;
        $this->departamento       = $departament;

        foreach ($departament->groups as $group) {
            $this->departament_group[] = $group->id;
        }
    }

    public function close()
    {
        $this->clean();
        $this->emit('departamentShowEvent');
    }

    public function edit(Departament $departament)
    {
        $this->departament_id     = $departament->id;
        $this->name               = $departament->name;
        $this->description        = $departament->description;
        $this->status             = $departament->status;
        $this->accion             = "update";

        foreach ($departament->groups as $group) {
            $this->group[] = $group->id;
        }
    }

    public function update()
    {
        $this->validate([
            'name'         => 'required|string|max:200|unique:departaments,name,' . $this->departament_id,
            'description'  => 'required|string',
            'responsable'  => 'required|string',
        ]);
        if ($this->departament_id) {
            $departaments = Departament::find($this->departament_id);
            $departaments->update([
                'name'          => $this->name,
                'description'   => $this->description,
                'responsable'   => Auth::user()->name,
                'status'        => $this->status,
            ]);
            $departaments->groups()->sync($this->group);
            session()->flash('message', 'Departamento actualizado correctamente.');
            $this->clean();
            $this->emit('departamentUpdatedEvent');
        }
    }

    public function limpia()
    {
        $this->reset(['group']);
    }

    public function delete(Departament $departament)
    {
        $this->departament_id     = $departament->id;
        $this->name               = $departament->name;
    }

    public function destroy()
    {
        Departament::find($this->departament_id)->delete();
        session()->flash('message', 'Departamento eliminado correctamente.');
        $this->clean();
        $this->emit('departamentDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'departament_id',
            'name',
            'description',
            'responsable',
            'status',
            'accion',
            'created_at',
            'updated_at',
            'departament_group',
            'group',
            'departamento',
        ]);
        $this->mount();
    }

    public function clear()
    {
        $this->reset(['search', 'perPage', 'page']);
    }

    public function render()
    {
        $groups = Group::all();

        if ($this->search != '') {
            $this->page = 1;
        }
        if (isset(($this->total)) && ($this->perPage > $this->total) && ($this->page != 1)) {
            $this->reset(['perPage']);
        }

        return view(
            'livewire.departament.departament-component',
            [
                'departaments' => Departament::latest('id')
                    ->with('groups')
                    ->where('name', 'LIKE', "%{$this->search}%")
                    ->orWhere('description', 'LIKE', "%{$this->search}%")
                    ->orWhere('responsable', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ],
            compact('groups')
        );
    }
}
