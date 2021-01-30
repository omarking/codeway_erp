<?php

namespace App\Http\Livewire\Profile;

use App\Models\Priority;
use Livewire\Component;
use App\Models\Project;
use App\Models\Statu;
use App\Models\Task;
use App\Models\Type;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class MytaskComponent extends Component
{
    use WithFileUploads;

    public $search = '', $perPage = '10', $page = 1;

    public $proyecto, $tareas, $tasks, $usuario;

    public $estados;

    public $task_id, $name, $description, $file, $start, $end, $informer, $responsable, $created_at, $updated_at, $accion = "store";

    public $estado, $tipo, $prioridad, $statu_id, $priority_id, $type_id, $temporary;

    public $rules = [
        'name'          => 'required|string|max:200|unique:tasks,name',
        'description'   => 'required|string',
        'temporary'     => 'file|max:10000|mimes:jpeg,png|nullable|mimetypes:video/mp4',
        'file'          => 'file|max:10000|mimes:jpeg,png|nullable|mimetypes:video/mp4',
        'start'         => 'required|date|after:tomorrow',
        'end'           => 'required|date|after:start',
        'informer'      => 'required|string|',
        'responsable'   => 'required|string|',
        'statu_id'      => 'required',
        'priority_id'   => 'required',
        'type_id'       => 'required',
    ];

    protected $validationAttributes = [
        'name'          => 'nombre',
        'description'   => 'descripción',
        'temporary'     => 'archivo',
        'file'          => 'archivo',
        'start'         => 'fecha de inicio',
        'end'           => 'fecha termino',
        'informer'      => 'informador',
        'responsable'   => 'responsable',
        'statu_id'      => 'estado',
        'priority_id'   => 'prioridad',
        'type_id'       => 'tipo',
    ];

    public function mount(Project $project)
    {
        $this->proyecto = $project;
        $this->tareas = Project::with('tasks', 'users')->where('id', '=', $project->id)->get();
        $this->estados = Statu::where('status', '=', 1)->get();
        $this->tasks = Task::all();

        foreach ($this->tareas as $tarea) {
            foreach ($tarea->tasks as $task) {
                $this->name = $task->name;
                $this->start = $task->start;
                $this->end = $task->end;
                $this->informer = $task->informer;
                $this->responsable = $task->responsable;
            }
        }

        /* @foreach ($tareas as $tarea)
            @foreach ($tarea->tasks as $task)
                @if ($estado->id == $task->statu_id)
                    <div wire:click.prevent="edit({{ $task->id }})" data-toggle="modal" data-target="#updateTask">
                        <h5 class="font-italic"> {{ $task->name }} </h5>
                        <h6> {{ $task->start }} </h6>
                        <h6> {{ $task->end }} </h6>
                        <h6> {{ $task->informer }} </h6>
                        <h6> {{ $task->responsable}} </h6>
                    </div>
                    <hr>
                @endif
            @endforeach
        @endforeach */

        $this->usuario = Auth::user()->name;
        $this->responsable = Auth::user()->name;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'name'          => 'required|string|max:200|unique:tasks,name',
                'description'   => 'required|string',
                'temporary'     => 'file|max:10000|nullable',
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
                'file'          => 'file|max:10000|nullable',
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
        $this->validate([
            'name'          => 'required|string|max:200|unique:tasks,name',
            'description'   => 'required|string|',
            'temporary'     => 'file|max:10000|nullable',
            'start'         => 'required|date',
            'end'           => 'required|date',
            'informer'      => 'required|string',
            'responsable'   => 'required|string',
            'statu_id'      => 'required',
            'priority_id'   => 'required',
            'type_id'       => 'required',
        ]);
        if ($this->temporary != null) {
            if ($this->temporary->getClientOriginalName()) {
                $nameFile = time() . '_' . $this->temporary->getClientOriginalName();
                $this->temporary->storePubliclyAs('storage/files', $nameFile, 'public_uploads');
            }
        } else {
            $nameFile = null;
        }
        $task = Task::create([
            'name'          => $this->name,
            'slug'          => Str::slug($this->name, '-'),
            'description'   => $this->description,
            'file'          => $nameFile,
            'start'         => $this->start,
            'end'           => $this->end,
            'informer'      => $this->informer,
            'responsable'   => Auth::user()->name,
            'statu_id'      => $this->statu_id,
            'priority_id'   => $this->priority_id,
            'type_id'       => $this->type_id,
        ]);
        $task->projects()->sync($this->proyecto->id);
        session()->flash('message', 'Tarea creada correctamente.');
        $this->clean();
        $this->emit('taskCreatedEvent');
    }

    public function close()
    {
        $this->clean();
        $this->emit('taskShowEvent');
    }

    public function edit(Task $task)
    {
        /* $date                = new Carbon($task->start); */

        $this->task_id       = $task->id;
        $this->name          = $task->name;
        $this->description   = $task->description;
        $this->file          = $task->file;
        /* $this->start         = $task->start; */
        $start               = new Carbon($task->start);
        $this->start         = $start->toFormattedDateString();
        $this->end           = $task->end;
        $this->informer      = $task->informer;
        $this->responsable   = $task->responsable;
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
            'temporary'     => 'file|max:10000|nullable',
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
                'slug'          => Str::slug($this->name, '-'),
                'description'   => $this->description,
                'end'           => $this->end,
                'informer'      => $this->informer,
                'responsable'   => Auth::user()->name,
                'statu_id'      => $this->statu_id,
                'priority_id'   => $this->priority_id,
                'type_id'       => $this->type_id,
            ]);
            if ($this->temporary != null) {
                if ($this->temporary->getClientOriginalName()) {
                    $nameFile = time() . '_' . $this->temporary->getClientOriginalName();
                    $this->temporary->storePubliclyAs('storage/files', $nameFile, 'public_uploads');
                    $task->update(['file'   => $nameFile]);
                }
            }
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
        /* Storage::delete('file.jpg'); */
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
            'temporary',
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
        $this->responsable = Auth::user()->name;
        $this->resetErrorBag();
        $this->resetValidation();
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

        if ($this->search != '') {
            $this->page = 1;
        }
        if (isset(($this->total)) && ($this->perPage > $this->total) && ($this->page != 1)) {
            $this->reset(['perPage']);
        }


        return view(
            'livewire.profile.mytask-component',
            [
                'tasks' => Task::latest('id')
                    ->with('type', 'statu', 'priority')
                    ->where('name', 'LIKE', "%{$this->search}%")
                    ->orWhere('description', 'LIKE', "%{$this->search}%")
                    ->orWhere('informer', 'LIKE', "%{$this->search}%")
                    ->orWhere('responsable', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ],
            compact('estados', 'types', 'priorities')
        );
    }
}