<?php

namespace App\Http\Livewire\Clase;

use App\Models\Clas;
use Livewire\Component;
use Livewire\WithPagination;

class ClaseComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $description, $status, $class_id, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total;

    public $rules = [
        'description'  => 'required|string|min:4|max:100|unique:class,description',
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
        $this->total = count(Clas::all());
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'description' => 'required|min:4|max:100|unique:class,description',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'description' => 'required|min:4|max:100|unique:class,description,' . $this->class_id,
            ]);
        }
    }

    public function store()
    {
        $validateData = $this->validate([
            'description' => 'required|min:4|max:100|unique:class,description',
        ]);
        Clas::create($validateData);
        session()->flash('message', 'Clase creada correctamente.');
        $this->clean();
        $this->emit('classCreatedEvent');
    }

    public function show(Clas $clase)
    {
        $this->class_id     = $clase->id;
        $this->description  = $clase->description;
        $this->status       = $clase->status;
        $this->created_at   = $clase->created_at;
        $this->updated_at   = $clase->updated_at;
    }

    public function close()
    {
        $this->clean();
        $this->emit('classShowEvent');
    }

    public function edit(Clas $clase)
    {
        $this->class_id     = $clase->id;
        $this->description  = $clase->description;
        $this->status       = $clase->status;
        $this->accion       = "update";
    }

    public function update()
    {
        $this->validate([
            'description' => 'required|min:4|max:100|unique:class,description,' . $this->class_id,
        ]);
        if ($this->class_id) {
            $clase = Clas::find($this->class_id);
            $clase->update([
                'description'   => $this->description,
                'status'        => $this->status,
            ]);
            session()->flash('message', 'Clase actualizada correctamente.');
            $this->clean();
            $this->emit('classUpdatedEvent');
        }
    }

    public function delete(Clas $clase)
    {
        $this->class_id     = $clase->id;
        $this->description  = $clase->description;
        $this->status       = $clase->status;
    }

    public function destroy()
    {
        Clas::find($this->class_id)->delete();
        session()->flash('message', 'Clase eliminada correctamente.');
        $this->clean();
        $this->emit('classDeletedEvent');
    }

    public function clean()
    {
        $this->reset(['description', 'status', 'class_id', 'accion', 'created_at', 'updated_at',]);
    }

    public function clear()
    {
        $this->reset(['search', 'perPage', 'page']);
    }

    public function render()
    {
        return view(
            'livewire.clase.clase-component',
            ['clases' => Clas::where('description', 'LIKE', "%{$this->search}%")
            ->orWhere('id', 'LIKE', "%{$this->search}%")
            ->paginate($this->perPage)]
        );
    }
}
