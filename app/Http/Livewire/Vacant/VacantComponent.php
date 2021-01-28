<?php

namespace App\Http\Livewire\Vacant;

use App\Models\Vacant;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class VacantComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $vacant_id, $name, $description, $quantity, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total;

    public $rules = [
        'name'         => 'required|string|max:200|unique:vacants,name',
        'description'  => 'required|string',
        'quantity'     => 'required|numeric',
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
        'quantity'      => 'cantidad',
    ];

    public function mount()
    {
        $this->total = count(Vacant::all());
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'name'         => 'required|string|max:200|unique:vacants,name',
                'description'  => 'required|string',
                'quantity'     => 'required|numeric',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'name'         => 'required|string|max:200|unique:vacants,name,' . $this->vacant_id,
                'description'  => 'required|string',
                'quantity'     => 'required|numeric',
            ]);
        }
    }

    public function store()
    {
        $this->validate([
            'name'         => 'required|string|max:200|unique:vacants,name',
            'description'  => 'required|string',
            'quantity'     => 'required|numeric',
        ]);
        Vacant::create([
            'name'          => $this->name,
            'slug'          => Str::slug($this->name, '-'),
            'description'   => $this->description,
            'quantity'      => $this->quantity,
        ]);
        session()->flash('message', 'Vacante creada correctamente.');
        $this->clean();
        $this->emit('vacantCreatedEvent');
    }

    public function show(Vacant $vacant)
    {
        $created            = new Carbon($vacant->created_at);
        $updated            = new Carbon($vacant->updated_at);
        $this->vacant_id    = $vacant->id;
        $this->name         = $vacant->name;
        $this->description  = $vacant->description;
        $this->quantity     = $vacant->quantity;
        $this->status       = $vacant->status;
        $this->created_at   = $created->format('l jS \\of F Y h:i:s A');
        $this->updated_at   = $updated->format('l jS \\of F Y h:i:s A');
        /* $this->created_at   = $vacant->created_at;
        $this->updated_at   = $vacant->updated_at; */
    }

    public function close()
    {
        $this->clean();
        $this->emit('vacantShowEvent');
    }

    public function edit(Vacant $vacant)
    {
        $this->vacant_id    = $vacant->id;
        $this->name         = $vacant->name;
        $this->description  = $vacant->description;
        $this->quantity     = $vacant->quantity;
        $this->status       = $vacant->status;
        $this->accion       = "update";
    }

    public function update()
    {
        $this->validate([
            'name'         => 'required|string|max:200|unique:vacants,name,' . $this->vacant_id,
            'description'  => 'required|string',
            'quantity'     => 'required|numeric',
        ]);
        if ($this->vacant_id) {
            $vacants = Vacant::find($this->vacant_id);
            $vacants->update([
                'name'          => $this->name,
                'slug'          => Str::slug($this->name, '-'),
                'description'   => $this->description,
                'quantity'      => $this->quantity,
                'status'        => $this->status,
            ]);
            session()->flash('message', 'Vacante actualizada correctamente.');
            $this->clean();
            $this->emit('vacantUpdatedEvent');
        }
    }

    public function delete(Vacant $vacant)
    {
        $this->vacant_id    = $vacant->id;
        $this->name         = $vacant->name;
    }

    public function destroy()
    {
        Vacant::find($this->vacant_id)->delete();
        session()->flash('message', 'Vacante eliminada correctamente.');
        $this->clean();
        $this->emit('vacantDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'vacant_id',
            'name',
            'description',
            'quantity',
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
            'livewire.vacant.vacant-component',
            [
                'vacants' => Vacant::latest('id')
                    ->where('name', 'LIKE', "%{$this->search}%")
                    ->orWhere('description', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ]
        );
    }
}
