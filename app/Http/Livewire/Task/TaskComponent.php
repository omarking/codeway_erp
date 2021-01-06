<?php

namespace App\Http\Livewire\Task;

use App\Models\Priority;
use App\Models\Statu;
use App\Models\Task;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class TaskComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $task_id, $name, $description, $file, $start, $end, $informer, $responsable, $created_at, $updated_at, $accion = "store";

    public $estado, $tipo, $prioridad, $statu_id, $priority_id, $type_id;

    public $search = '', $perPage = '10', $total;

    public $rules = [
        'name'          => 'required|string|max:200|unique:tasks,name',
        'description'   => 'required|string',
        'file'          => '',
        'start'         => 'required|date',
        'end'           => 'required|date',
        'informer'      => 'required|string|',
        'responsable'   => 'required|string|',
        'statu_id'      => 'required',
        'priority_id'   => 'required',
        'type_id'       => 'required',
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
        'file'          => 'archivo',
        'start'         => 'fecha de inicio',
        'end'           => 'fecha termino',
        'informer'      => 'informador',
        'responsable'   => 'responsable',
        'statu_id'      => 'estado',
        'priority_id'   => 'prioridad',
        'type_id'       => 'tipo',
    ];

    public function mount()
    {
        $this->total = count(Task::all());
        $this->responsable = Auth::user()->name;
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'name'          => 'required|string|max:200|unique:tasks,name',
                'description'   => 'required|string',
                'file'          => '',
                'start'         => 'required|date',
                'end'           => 'required|date',
                'informer'      => 'required|string',
                'responsable'   => 'required|string',
                'statu_id'      => 'required',
                'priority_id'   => 'required',
                'type_id'       => 'required',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'name'          => 'required|string|max:200|unique:tasks,name,' . $this->task_id,
                'description'   => 'required|string',
                'file'          => '',
                'start'         => 'required|date',
                'end'           => 'required|date',
                'informer'      => 'required|string',
                'responsable'   => 'required|string',
                'statu_id'      => 'required',
                'priority_id'   => 'required',
                'type_id'       => 'required',
            ]);
        }
    }

    public function store()
    {
        $validateData = $this->validate([
            'name'          => 'required|string|max:200|unique:tasks,name',
            'description'   => 'required|string|',
            'file'          => '',
            'start'         => 'required|date',
            'end'           => 'required|date',
            'informer'      => 'required|string',
            'responsable'   => 'required|string',
            'statu_id'      => 'required',
            'priority_id'   => 'required',
            'type_id'       => 'required',
        ]);
        Task::create($validateData);
        session()->flash('message', 'Tarea creada correctamente.');
        $this->clean();
        $this->emit('taskCreatedEvent');
    }

    public function show(Task $task)
    {
        $this->task_id       = $task->id;
        $this->name          = $task->name;
        $this->description   = $task->description;
        $this->file          = $task->file;
        $this->start         = $task->start;
        $this->end           = $task->end;
        $this->informer      = $task->informer;
        $this->responsable   = $task->responsable;
        $this->statu_id      = $task->statu_id;
        $this->priority_id   = $task->priority_id;
        $this->type_id       = $task->type_id;
        $this->created_at    = $task->created_at;
        $this->updated_at    = $task->updated_at;
        if (isset($task->statu->description)) {
            $this->estado   = $task->statu->description;
        }else{
            $this->estado   = "Sin estado";
        }
        if (isset($task->type->description)) {
            $this->tipo     = $task->type->description;
        }else{
            $this->tipo     = "Sin tipo";
        }
        if (isset($task->priority->description)) {
            $this->prioridad = $task->priority->description;
        }else{
            $this->prioridad = "Sin prioridad";
        }
    }

    public function close()
    {
        $this->clean();
        $this->emit('taskShowEvent');
    }

    public function edit(Task $task)
    {
        $this->task_id       = $task->id;
        $this->name          = $task->name;
        $this->description   = $task->description;
        $this->file          = $task->file;
        $this->start         = $task->start;
        $this->end           = $task->end;
        $this->informer      = $task->informer;
        $this->statu_id      = $task->statu_id;
        $this->priority_id   = $task->priority_id;
        $this->type_id       = $task->type_id;
        $this->created_at    = $task->created_at;
        $this->updated_at    = $task->updated_at;
        $this->accion        = "update";
    }

    public function update()
    {
        $this->validate([
            'name'          => 'required|string|max:200|unique:tasks,name,' . $this->task_id,
            'description'   => 'required|string',
            'file'          => '',
            'start'         => 'required|date',
            'end'           => 'required|date',
            'informer'      => 'required|string',
            'responsable'   => 'required|string',
            'statu_id'      => 'required',
            'priority_id'   => 'required',
            'type_id'       => 'required',
        ]);
        if ($this->task_id) {
            $task = Task::find($this->task_id);
            $task->update([
                'name'          => $this->name,
                'description'   => $this->description,
                'file'          => $this->file,
                'end'           => $this->end,
                'informer'      => $this->informer,
                'responsable'   => Auth::user()->name,
                'statu_id'      => $this->statu_id,
                'priority_id'   => $this->priority_id,
                'type_id'       => $this->type_id,

            ]);
            session()->flash('message', 'Tarea actualizada correctamente.');
            $this->clean();
            $this->emit('taskUpdatedEvent');
        }
    }

    public function delete(Task $task)
    {
        $this->task_id      = $task->id;
        $this->name         = $task->name;
    }

    public function destroy()
    {
        Task::find($this->task_id)->delete();
        session()->flash('message', 'Tarea eliminada correctamente.');
        $this->clean();
        $this->emit('taskDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'task_id',
            'name',
            'description',
            'file',
            'start',
            'end',
            'informer',
            'responsable',
            'statu_id',
            'priority_id',
            'type_id',
            'created_at',
            'updated_at',
            'accion',
            'estado',
            'tipo',
            'prioridad',
        ]);
        $this->mount();
    }

    public function clear()
    {
        $this->reset(['search', 'perPage', 'page']);
    }

    public function render()
    {
        $estados    = Statu::orderBy('description')->where('status', '1')->get();
        $types      = Type::orderBy('description')->where('status', '1')->get();
        $priorities = Priority::orderBy('description')->where('status', '1')->get();
        return view(
            'livewire.task.task-component',
            [
                'tasks' => Task::latest('id')
                    ->with('type', 'statu', 'priority')
                    ->where('id', 'LIKE', "%{$this->search}%")
                    ->orWhere('name', 'LIKE', "%{$this->search}%")
                    ->orWhere('description', 'LIKE', "%{$this->search}%")
                    ->orWhere('informer', 'LIKE', "%{$this->search}%")
                    ->orWhere('responsable', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ],
            compact('estados', 'types', 'priorities')
        );
    }
}
