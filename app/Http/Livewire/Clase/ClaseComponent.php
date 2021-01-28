<?php

namespace App\Http\Livewire\Clase;

use App\Models\Clas;
use App\Models\Project;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ClaseComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $class_id, $description, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total, $clase;

    public $rules = [
        'description'  => 'required|string|max:200|unique:class,description',
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
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'description' => 'required|max:200|unique:class,description',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'description' => 'required|max:200|unique:class,description,' . $this->class_id,
            ]);
        }
    }

    public function store()
    {
        $this->validate([
            'description' => 'required|max:200|unique:class,description',
        ]);
        Clas::create([
            'description'   => $this->description,
        ]);
        session()->flash('message', 'Clase creada correctamente.');
        $this->clean();
        $this->emit('classCreatedEvent');
    }

    public function show(Clas $clase)
    {
        $created            = new Carbon($clase->created_at);
        $updated            = new Carbon($clase->updated_at);
        $this->class_id     = $clase->id;
        $this->description  = $clase->description;
        $this->status       = $clase->status;
        $this->created_at   = $created->format('l jS \\of F Y h:i:s A');
        $this->updated_at   = $updated->format('l jS \\of F Y h:i:s A');
        /* $this->created_at   = $clase->created_at;
        $this->updated_at   = $clase->updated_at; */
        $this->clase        = $clase;
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
            'description' => 'required|max:200|unique:class,description,' . $this->class_id,
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
        $this->reset([
            'class_id',
            'description',
            'status',
            'accion',
            'clase',
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
        $proyectos = Project::orderBy('name')->get();

        if ($this->search != '') {
            $this->page = 1;
        }
        if (isset(($this->total)) && ($this->perPage > $this->total) && ($this->page != 1)) {
            $this->reset(['perPage']);
        }

        return view(
            'livewire.clase.clase-component',
            [
                'clases' => Clas::latest('id')
                    ->where('description', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ],
            compact('proyectos')
        );
    }
}
