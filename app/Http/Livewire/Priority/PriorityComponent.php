<?php

namespace App\Http\Livewire\Priority;

use App\Models\Priority;
use Livewire\Component;
use Livewire\WithPagination;

class PriorityComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $description, $status, $priority_id, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total;

    public $rules = [
        'description'  => 'required|string|min:4|max:100|unique:priorities,description',
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
        $this->total = count(Priority::all());
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'description' => 'required|min:4|max:100|unique:priorities,description',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'description' => 'required|min:4|max:100|unique:priorities,description,' . $this->priority_id,
            ]);
        }
    }

    public function store()
    {
        $validateData = $this->validate([
            'description' => 'required|min:4|max:100|unique:priorities,description',
        ]);
        Priority::create($validateData);
        session()->flash('message', 'Prioridad creada correctamente.');
        $this->clean();
        $this->emit('priorityCreatedEvent');
    }

    public function show(Priority $priority)
    {
        $this->priority_id  = $priority->id;
        $this->description  = $priority->description;
        $this->status       = $priority->status;
        $this->created_at   = $priority->created_at;
        $this->updated_at   = $priority->updated_at;
    }

    public function close()
    {
        $this->clean();
        $this->emit('priorityShowEvent');
    }

    public function edit(Priority $priority)
    {
        $this->priority_id  = $priority->id;
        $this->description  = $priority->description;
        $this->status       = $priority->status;
        $this->accion       = "update";
    }

    public function update()
    {
        $this->validate([
            'description' => 'required|min:4|max:100|unique:priorities,description,' . $this->priority_id,
        ]);
        if ($this->priority_id) {
            $priority = Priority::find($this->priority_id);
            $priority->update([
                'description'   => $this->description,
                'status'        => $this->status,
            ]);
            session()->flash('message', 'Prioridad actualizada correctamente.');
            $this->clean();
            $this->emit('priorityUpdatedEvent');
        }
    }

    public function delete(Priority $priority)
    {
        $this->priority_id  = $priority->id;
        $this->description  = $priority->description;
        $this->status       = $priority->status;
    }

    public function destroy()
    {
        Priority::find($this->priority_id)->delete();
        session()->flash('message', 'Prioridad eliminada correctamente.');
        $this->clean();
        $this->emit('priorityDeletedEvent');
    }

    public function clean()
    {
        $this->reset(['description', 'status', 'priority_id', 'accion', 'created_at', 'updated_at',]);
    }

    public function clear()
    {
        $this->reset(['search', 'perPage', 'page']);
    }

    public function render()
    {
        return view(
            'livewire.priority.priority-component',
            ['priorities' => Priority::where('description', 'LIKE', "%{$this->search}%")
            ->orWhere('id', 'LIKE', "%{$this->search}%")
            ->paginate($this->perPage)]
        );
    }
}
