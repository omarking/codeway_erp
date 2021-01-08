<?php

namespace App\Http\Livewire\Period;

use App\Models\Holiday;
use App\Models\Period;
use Livewire\Component;
use Livewire\WithPagination;

class PeriodComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $period_id, $description, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total, $period;

    public $rules = [
        'description'  => 'required|numeric|unique:periods,description',
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
        $this->total = count(Period::all());
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'description' => 'required|numeric|unique:periods,description',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'description' => 'required|numeric|unique:periods,description,' . $this->period_id,
            ]);
        }
    }

    public function store()
    {
        $validateData = $this->validate([
            'description' => 'required|numeric|unique:periods,description',
        ]);
        Period::create($validateData);
        session()->flash('message', 'Periodo creado correctamente.');
        $this->clean();
        $this->emit('periodCreatedEvent');
    }

    public function show(Period $period)
    {
        $this->period_id    = $period->id;
        $this->description  = $period->description;
        $this->status       = $period->status;
        $this->created_at   = $period->created_at;
        $this->updated_at   = $period->updated_at;
        $this->period       = $period;
    }

    public function close()
    {
        $this->clean();
        $this->emit('periodShowEvent');
    }

    public function edit(Period $period)
    {
        $this->period_id    = $period->id;
        $this->description  = $period->description;
        $this->status       = $period->status;
        $this->accion       = "update";
    }

    public function update()
    {
        $this->validate([
            'description' => 'required|numeric|unique:periods,description,' . $this->period_id,
        ]);
        if ($this->period_id) {
            $periods = Period::find($this->period_id);
            $periods->update([
                'description'   => $this->description,
                'status'        => $this->status,
            ]);
            session()->flash('message', 'Periodo actualizado correctamente.');
            $this->clean();
            $this->emit('periodUpdatedEvent');
        }
    }

    public function delete(Period $period)
    {
        $this->period_id    = $period->id;
        $this->description  = $period->description;
    }

    public function destroy()
    {
        Period::find($this->period_id)->delete();
        session()->flash('message', 'Periodo eliminado correctamente.');
        $this->clean();
        $this->emit('periodDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'period_id',
            'description',
            'status',
            'accion',
            'period',
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
            'livewire.period.period-component',
            [
                'periods' => Period::latest('id')
                    ->where('id', 'LIKE', "%{$this->search}%")
                    ->orWhere('description', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ],
            compact('vacaciones')
        );
    }
}
