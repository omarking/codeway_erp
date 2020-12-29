<?php

namespace App\Http\Livewire\Type;

use App\Models\Type;
use Livewire\Component;
use Livewire\WithPagination;

class TypeComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $description, $status, $type_id, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total;

    public $rules = [
        'description'  => 'required|string|min:4|max:100|unique:types,description',
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
                'description' => 'required|min:4|max:100|unique:types,description',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'description' => 'required|min:4|max:100|unique:types,description,' . $this->type_id,
            ]);
        }
    }

    public function store()
    {
        $validateData = $this->validate([
            'description' => 'required|min:4|max:100|unique:types,description',
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
            'description' => 'required|min:4|max:100|unique:types,description,' . $this->type_id,
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
        $this->reset(['description', 'status', 'type_id', 'accion', 'created_at', 'updated_at',]);
    }

    public function clear()
    {
        $this->reset(['search', 'perPage', 'page']);
    }

    public function render()
    {
        return view(
            'livewire.type.type-component',
            ['types' => Type::where('description', 'LIKE', "%{$this->search}%")
                ->orWhere('id', 'LIKE', "%{$this->search}%")
                ->orWhere('status', 'LIKE', "%{$this->search}%")
                ->paginate($this->perPage)]
        );
    }
}
