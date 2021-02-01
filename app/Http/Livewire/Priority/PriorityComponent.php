<?php

namespace App\Http\Livewire\Priority;

use App\Models\Priority;
use App\Models\Task;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class PriorityComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $priority_id, $description, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $page = 1, $total, $task, $priority;

    public $rules = [
        'description'  => 'required|string|max:200|unique:priorities,description',
    ];

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
        $this->validate([
            'description' => 'required|max:200|unique:priorities,description',
        ]);
        $status  = 'success';
        $content = 'Se agrego correctamente la prioridad';
        try {
            DB::beginTransaction();
            Priority::create([
                'description'   => $this->description,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status  = 'error';
            $content = 'Ocurrio un error al agregar la prioridad';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
        $this->clean();
        $this->emit('priorityCreatedEvent');
    }

    public function show(Priority $priority)
    {
        $created            = new Carbon($priority->created_at);
        $updated            = new Carbon($priority->updated_at);
        $this->priority_id  = $priority->id;
        $this->description  = $priority->description;
        $this->status       = $priority->status;
        $this->created_at   = $created->format('l jS \\of F Y h:i:s A');
        $this->updated_at   = $updated->format('l jS \\of F Y h:i:s A');
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
        $status  = 'success';
        $content = 'Se actualizo correctamente la prioridad';
        try {
            DB::beginTransaction();
            if ($this->priority_id) {
                $priority = Priority::find($this->priority_id);
                $priority->update([
                    'description'   => $this->description,
                    'status'        => $this->status,
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status  = 'error';
            $content = 'Ocurrio un error al actualizar la prioridad';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
        $this->clean();
        $this->emit('priorityUpdatedEvent');
    }

    public function delete(Priority $priority)
    {
        $this->priority_id  = $priority->id;
        $this->description  = $priority->description;
    }

    public function destroy()
    {
        $status  = 'success';
        $content = 'Se elimino correctamente la prioridad';
        try {
            DB::beginTransaction();
            Priority::find($this->priority_id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status  = 'error';
            $content = 'Ocurrio un error al eliminar la prioridad';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
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
            [
                'priorities' => Priority::latest('id')
                    ->where('description', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ],
            compact('tareas')
        );
    }
}
