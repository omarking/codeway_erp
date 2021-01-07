<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class GroupComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $group_id, $name, $description, $responsable, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total;

    public $rules = [
        'name'         => 'required|string|max:200|unique:groups,name',
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
        $this->total = count(Group::all());
        $this->responsable = Auth::user()->name;
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'name'         => 'required|string|max:200|unique:groups,name',
                'description'  => 'required|string',
                'responsable'  => 'required|string',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'name'         => 'required|string|max:200|unique:groups,name,' . $this->group_id,
                'description'  => 'required|string',
                'responsable'  => 'required|string',
            ]);
        }
    }

    public function store()
    {
        $validateData = $this->validate([
            'name'         => 'required|string|max:200|unique:groups,name',
            'description'  => 'required|string',
            'responsable'  => 'required|string',
        ]);
        Group::create($validateData);
        session()->flash('message', 'Grupo creado correctamente.');
        $this->clean();
        $this->emit('groupCreatedEvent');
    }

    public function show(Group $group)
    {
        $this->group_id     = $group->id;
        $this->name         = $group->name;
        $this->description  = $group->description;
        $this->responsable  = $group->responsable;
        $this->status       = $group->status;
        $this->created_at   = $group->created_at;
        $this->updated_at   = $group->updated_at;
    }

    public function close()
    {
        $this->clean();
        $this->emit('groupShowEvent');
    }

    public function edit(Group $group)
    {
        $this->group_id     = $group->id;
        $this->name         = $group->name;
        $this->description  = $group->description;
        $this->status       = $group->status;
        $this->accion       = "update";
    }

    public function update()
    {
        $this->validate([
            'name'         => 'required|string|max:200|unique:groups,name,' . $this->group_id,
            'description'  => 'required|string',
            'responsable'  => 'required|string',
        ]);
        if ($this->group_id) {
            $groups = Group::find($this->group_id);
            $groups->update([
                'name'          => $this->name,
                'description'   => $this->description,
                'responsable'   => Auth::user()->name,
                'status'        => $this->status,
            ]);
            session()->flash('message', 'Grupo actualizado correctamente.');
            $this->clean();
            $this->emit('groupUpdatedEvent');
        }
    }

    public function delete(Group $group)
    {
        $this->group_id     = $group->id;
        $this->name         = $group->name;
    }

    public function destroy()
    {
        Group::find($this->group_id)->delete();
        session()->flash('message', 'Grupo eliminado correctamente.');
        $this->clean();
        $this->emit('groupDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'group_id',
            'name',
            'description',
            'responsable',
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
        return view(
            'livewire.group.group-component',
            ['groups' => Group::latest('id')
                ->where('id', 'LIKE', "%{$this->search}%")
                ->orWhere('name', 'LIKE', "%{$this->search}%")
                ->orWhere('description', 'LIKE', "%{$this->search}%")
                ->orWhere('responsable', 'LIKE', "%{$this->search}%")
                ->paginate($this->perPage)
            ]
        );
    }
}