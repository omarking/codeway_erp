<?php

namespace App\Http\Livewire\Absence;

use App\Models\Absence;
use App\Models\Holiday;
use Livewire\Component;
use Livewire\WithPagination;

class AbsenceComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $absence_id, $description, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total, $absence;

    public $rules = [
        'description'  => 'required|string|max:200|unique:absences,description',
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
        $this->total = count(Absence::all());
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'description' => 'required|max:200|unique:absences,description',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'description' => 'required|max:200|unique:absences,description,' . $this->absence_id,
            ]);
        }
    }

    public function store()
    {
        $this->validate([
            'description' => 'required|max:200|unique:absences,description',
        ]);
        Absence::create([
            'description'   => $this->description,
        ]);
        session()->flash('message', 'Ausencia creada correctamente.');
        $this->clean();
        $this->emit('absenceCreatedEvent');
    }

    public function show(Absence $absence)
    {
        $this->absence_id   = $absence->id;
        $this->description  = $absence->description;
        $this->status       = $absence->status;
        $this->created_at   = $absence->created_at;
        $this->updated_at   = $absence->updated_at;
        $this->absence      = $absence;
    }

    public function close()
    {
        $this->clean();
        $this->emit('absenceShowEvent');
    }

    public function edit(Absence $absence)
    {
        $this->absence_id   = $absence->id;
        $this->description  = $absence->description;
        $this->status       = $absence->status;
        $this->accion       = "update";
    }

    public function update()
    {
        $this->validate([
            'description' => 'required|max:200|unique:absences,description,' . $this->absence_id,
        ]);
        if ($this->absence_id) {
            $absence = Absence::find($this->absence_id);
            $absence->update([
                'description'   => $this->description,
                'status'        => $this->status,
            ]);
            session()->flash('message', 'Ausencia actualizada correctamente.');
            $this->clean();
            $this->emit('absenceUpdatedEvent');
        }
    }

    public function delete(Absence $absence)
    {
        $this->absence_id   = $absence->id;
        $this->description  = $absence->description;
    }

    public function destroy()
    {
        Absence::find($this->absence_id)->delete();
        session()->flash('message', 'Ausencia eliminada correctamente.');
        $this->clean();
        $this->emit('absenceDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'absence_id',
            'description',
            'status',
            'accion',
            'absence',
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
        $vacaciones = Holiday::latest('id')->get();

        if ($this->search != '') {
            $this->page = 1;
        }
        if (isset(($this->total)) && ($this->perPage > $this->total) && ($this->page != 1)) {
            $this->reset(['perPage']);
        }

        return view(
            'livewire.absence.absence-component',
            [
                'absences' => Absence::latest('id')
                    ->where('description', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ],
            compact('vacaciones')
        );
    }
}
