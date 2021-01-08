<?php

namespace App\Http\Livewire\Type;

use App\Models\Task;
use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class TypeComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $type_id, $description, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total, $task, $type;

    public $rules = [
        'description'  => 'required|string|max:100|unique:types,description',
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
        'description' => 'descripción',
    ];

    public function mount()
    {
        $this->total = count(Type::all());
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'description' => 'required|max:100|unique:types,description',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'description' => 'required|max:100|unique:types,description,' . $this->type_id,
            ]);
        }
    }

    public function store()
    {
        $validateData = $this->validate([
            'description' => 'required|max:100|unique:types,description',
        ]);
        Type::create($validateData);
        session()->flash('message', 'Tipo creado correctamente.');
        $this->clean();
        $this->emit('typesCreatedEvent');
    }

    public function show(Type $type)
    {
        $this->type_id      = $type->id;
        $this->description  = $type->description;
        $this->status       = $type->status;
        $this->created_at   = $type->created_at;
        $this->updated_at   = $type->updated_at;
        $this->$type        = $type;
    }

    public function close()
    {
        $this->clean();
        $this->emit('typesShowEvent');
    }

    public function edit(Type $type)
    {
        $this->type_id      = $type->id;
        $this->description  = $type->description;
        $this->status       = $type->status;
        $this->accion       = "update";
    }

    public function update()
    {
        $this->validate([
            'description' => 'required|max:100|unique:types,description,' . $this->type_id,
        ]);
        if ($this->type_id) {
            $clase = Type::find($this->type_id);
            $clase->update([
                'description'   => $this->description,
                'status'        => $this->status,
            ]);
            session()->flash('message', 'Tipo actualizado correctamente.');
            $this->clean();
            $this->emit('typesUpdatedEvent');
        }
    }

    public function delete(Type $type)
    {
        $this->type_id      = $type->id;
        $this->description  = $type->description;
        $this->status       = $type->status;
    }

    public function destroy()
    {
        Type::find($this->type_id)->delete();
        session()->flash('message', 'Tipo eliminado correctamente.');
        $this->clean();
        $this->emit('typesDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'type_id',
            'description',
            'status',
            'accion',
            'task',
            'type',
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
        $tareas = Task::orderBy('name')->get();

        if ($this->search != '') {
            $this->page = 1;
        }
        if (isset(($this->total)) && ($this->perPage > $this->total) && ($this->page != 1)) {
            $this->reset(['perPage']);
        }
        
        return view(
            'livewire.type.type-component',
            ['types' => Type::latest('id')
                ->where('id', 'LIKE', "%{$this->search}%")
                ->orWhere('description', 'LIKE', "%{$this->search}%")
                ->orWhere('status', 'LIKE', "%{$this->search}%")
                ->paginate($this->perPage)
            ],
            compact('tareas')
        );
    }
}
