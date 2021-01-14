<?php

namespace App\Http\Livewire\Priority;

use App\Models\Priority;
use App\Models\Task;
use Livewire\Component;
use Livewire\WithPagination;

class PriorityComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $priority_id, $description, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total, $task, $priority;

    public $rules = [
        'description'  => 'required|string|max:200|unique:priorities,description',
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
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'description' => 'required|max:200|unique:priorities,description',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'description' => 'required|max:200|unique:priorities,description,' . $this->priority_id,
            ]);
        }
    }

    public function store()
    {
        $validateData = $this->validate([
            'description' => 'required|max:200|unique:priorities,description',
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
        $this->$priority    = $priority;
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
            'description' => 'required|max:200|unique:priorities,description,' . $this->priority_id,
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
        $this->reset([
            'priority_id',
            'description',
            'status',
            'accion',
            'task',
            'priority',
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
            'livewire.priority.priority-component',
            ['priorities' => Priority::latest('id')
                ->where('id', 'LIKE', "%{$this->search}%")
                ->orWhere('description', 'LIKE', "%{$this->search}%")
                ->paginate($this->perPage)
            ],
            compact('tareas')
        );
    }
}
