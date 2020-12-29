<?php

namespace App\Http\Livewire\Status;

use App\Models\Statu;
use Livewire\Component;
use Livewire\WithPagination;

class StatusComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $description, $status, $status_id, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total;

    public $rules = [
        'description'  => 'required|string|min:4|max:100|unique:status,description',
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
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'description' => 'required|min:4|max:100|unique:status,description',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'description' => 'required|min:4|max:100|unique:status,description,' . $this->status_id,
            ]);
        }
    }

    public function store()
    {
        $validateData = $this->validate([
            'description' => 'required|min:4|max:100|unique:status,description',
        ]);
        Statu::create($validateData);
        session()->flash('message', 'Estado creado correctamente.');
        $this->clean();
        $this->emit('statusCreatedEvent');
    }

    public function show(Statu $status)
    {
        $this->status_id    = $status->id;
        $this->description  = $status->description;
        $this->status       = $status->status;
        $this->created_at   = $status->created_at;
        $this->updated_at   = $status->updated_at;
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
            'description' => 'required|min:4|max:100|unique:status,description,' . $this->status_id,
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
        $this->status       = $status->status;
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
        $this->reset(['description', 'status', 'status_id', 'accion', 'created_at', 'updated_at',]);
    }

    public function clear()
    {
        $this->reset(['search', 'perPage', 'page']);
    }

    public function render()
    {
        return view(
            'livewire.status.status-component',
            ['estados' => Statu::where('description', 'LIKE', "%{$this->search}%")
                ->orWhere('id', 'LIKE', "%{$this->search}%")
                ->paginate($this->perPage)]
        );
    }
}
