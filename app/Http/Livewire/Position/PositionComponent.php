<?php

namespace App\Http\Livewire\Position;

use App\Models\Position;
use Livewire\Component;
use Livewire\WithPagination;

class PositionComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $position_id, $description, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total;

    public $rules = [
        'description'  => 'required|string|max:200|unique:positions,description',
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
        $this->total = count(Position::all());
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'description' => 'required|max:200|unique:positions,description',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'description' => 'required|max:200|unique:positions,description,' . $this->position_id,
            ]);
        }
    }

    public function store()
    {
        $validateData = $this->validate([
            'description' => 'required|max:200|unique:positions,description',
        ]);
        Position::create($validateData);
        session()->flash('message', 'Posición creada correctamente.');
        $this->clean();
        $this->emit('positionCreatedEvent');
    }

    public function show(Position $position)
    {
        $this->position_id  = $position->id;
        $this->description  = $position->description;
        $this->status       = $position->status;
        $this->created_at   = $position->created_at;
        $this->updated_at   = $position->updated_at;
    }

    public function close()
    {
        $this->clean();
        $this->emit('positionShowEvent');
    }

    public function edit(Position $position)
    {
        $this->position_id  = $position->id;
        $this->description  = $position->description;
        $this->status       = $position->status;
        $this->accion       = "update";
    }

    public function update()
    {
        $this->validate([
            'description' => 'required|max:200|unique:positions,description,' . $this->position_id,
        ]);
        if ($this->position_id) {
            $positions = Position::find($this->position_id);
            $positions->update([
                'description'   => $this->description,
                'status'        => $this->status,
            ]);
            session()->flash('message', 'Posición actualizada correctamente.');
            $this->clean();
            $this->emit('positionUpdatedEvent');
        }
    }

    public function delete(Position $position)
    {
        $this->position_id  = $position->id;
        $this->description  = $position->description;
        $this->status       = $position->status;
    }

    public function destroy()
    {
        Position::find($this->position_id)->delete();
        session()->flash('message', 'Posición eliminada correctamente.');
        $this->clean();
        $this->emit('positionDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'position_id',
            'description',
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
        if ($this->search != '') {
            $this->page = 1;
        }
        if (isset(($this->total)) && ($this->perPage > $this->total) && ($this->page != 1)) {
            $this->reset(['perPage']);
        }
        
        return view(
            'livewire.position.position-component',
            ['positions' => Position::latest('id')
                ->where('id', 'LIKE', "%{$this->search}%")
                ->orWhere('description', 'LIKE', "%{$this->search}%")
                ->paginate($this->perPage)
            ]
        );
    }
}
