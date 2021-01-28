<?php

namespace App\Http\Livewire\Status;

use App\Models\Statu;
use App\Models\Task;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class StatusComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $status_id, $description, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total, $task, $statu;

    public $rules = [
        'description'  => 'required|string|max:200|unique:status,description',
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
        $this->total = count(Statu::all());
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'description' => 'required|max:200|unique:status,description',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'description' => 'required|max:200|unique:status,description,' . $this->status_id,
            ]);
        }
    }

    public function store()
    {
        $this->validate([
            'description' => 'required|max:200|unique:status,description',
        ]);
        Statu::create([
            'description'   => $this->description,
        ]);
        session()->flash('message', 'Estado creado correctamente.');
        $this->clean();
        $this->emit('statusCreatedEvent');
    }

    public function show(Statu $status)
    {
        $created            = new Carbon($status->created_at);
        $updated            = new Carbon($status->updated_at);
        $this->status_id    = $status->id;
        $this->description  = $status->description;
        $this->status       = $status->status;
        $this->created_at   = $created->format('l jS \\of F Y h:i:s A');
        $this->updated_at   = $updated->format('l jS \\of F Y h:i:s A');
        /* $this->created_at   = $status->created_at;
        $this->updated_at   = $status->updated_at; */
        $this->statu        = $status;
    }

    public function close()
    {
        $this->clean();
        $this->emit('statusShowEvent');
    }

    public function edit(Statu $status)
    {
        $this->status_id    = $status->id;
        $this->description  = $status->description;
        $this->status       = $status->status;
        $this->accion       = "update";
    }

    public function update()
    {
        $this->validate([
            'description' => 'required|max:200|unique:status,description,' . $this->status_id,
        ]);
        if ($this->status_id) {
            $clase = Statu::find($this->status_id);
            $clase->update([
                'description'   => $this->description,
                'status'        => $this->status,
            ]);
            session()->flash('message', 'Estado actualizado correctamente.');
            $this->clean();
            $this->emit('statusUpdatedEvent');
        }
    }

    public function delete(Statu $status)
    {
        $this->status_id    = $status->id;
        $this->description  = $status->description;
    }

    public function destroy()
    {
        Statu::find($this->status_id)->delete();
        session()->flash('message', 'Estado eliminado correctamente.');
        $this->clean();
        $this->emit('statusDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'status_id',
            'description',
            'status',
            'accion',
            'task',
            'statu',
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
            'livewire.status.status-component',
            [
                'estados' => Statu::latest('id')
                    ->where('description', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ],
            compact('tareas')
        );
    }
}
