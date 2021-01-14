<?php

namespace App\Http\Livewire\Holiday;

use App\Models\Absence;
use App\Models\Holiday;
use App\Models\Period;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class HolidayComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $holiday_id, $days, $beginDate, $endDate, $inProcess, $taken, $available, $responsable, $commentable, $created_at, $updated_at, $accion = "store";

    public $ausencia, $periodo, $absence_id, $period_id;

    public $search = '', $perPage = '10', $total;

    public $rules = [
        'days'          => 'required|numeric|max:100',
        'beginDate'     => 'required|date',
        'endDate'       => 'required|date',
        'inProcess'     => 'required|numeric|max:100',
        'taken'         => 'required|numeric|max:100',
        'available'     => 'numeric|max:100',
        'responsable'   => 'required|string|',
        'commentable'   => '',
        'absence_id'    => 'required',
        'period_id'     => 'required',
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
        'days'          => 'dias',
        'beginDate'     => 'fecha de inicio',
        'endDate'       => 'fecha de termino',
        'inProcess'     => 'en proceso',
        'taken'         => 'tomadas',
        'available'     => 'disponibles',
        'responsable'   => 'responsable',
        'commentable'   => 'comentario',
        'absence_id'    => 'ausecia',
        'period_id'     => 'periodo',
    ];

    public function mount()
    {
        $this->total = count(Holiday::all());
        $this->responsable = Auth::user()->name;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'days'          => 'required|numeric|max:100',
                'beginDate'     => 'required|date',
                'endDate'       => 'required|date',
                'inProcess'     => 'required|numeric|max:100',
                'taken'         => 'required|numeric|max:100',
                'available'     => 'numeric|max:100',
                'responsable'   => 'required|string|',
                'commentable'   => '',
                'absence_id'    => 'required',
                'period_id'     => 'required',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'days'          => 'required|numeric|max:100',
                'beginDate'     => 'required|date',
                'endDate'       => 'required|date',
                'inProcess'     => 'required|numeric|max:100',
                'taken'         => 'required|numeric|max:100',
                'available'     => 'numeric|max:100',
                'responsable'   => 'required|string|',
                'commentable'   => '',
                'absence_id'    => 'required',
                'period_id'     => 'required',
            ]);
        }
    }

    public function store()
    {
        $validateData = $this->validate([
            'days'          => 'required|numeric|max:100',
            'beginDate'     => 'required|date',
            'endDate'       => 'required|date',
            'inProcess'     => 'required|numeric|max:100',
            'taken'         => 'required|numeric|max:100',
            'available'     => 'numeric|max:100',
            'responsable'   => 'required|string|',
            'commentable'   => '',
            'absence_id'    => 'required',
            'period_id'     => 'required',
        ]);
        Holiday::create($validateData);
        session()->flash('message', 'Vacación creada correctamente.');
        $this->clean();
        $this->emit('holidayCreatedEvent');
    }

    public function show(Holiday $holiday)
    {
        $this->holiday_id     = $holiday->id;
        $this->days           = $holiday->days;
        $this->beginDate      = $holiday->beginDate;
        $this->endDate        = $holiday->endDate;
        $this->inProcess      = $holiday->inProcess;
        $this->taken          = $holiday->taken;
        $this->available      = $holiday->available;
        $this->responsable    = $holiday->responsable;
        $this->commentable    = $holiday->commentable;
        $this->absence_id     = $holiday->absence_id;
        $this->period_id      = $holiday->period_id;
        $this->created_at     = $holiday->created_at;
        $this->updated_at     = $holiday->updated_at;

        if (isset($holiday->absence->description)) {
            $this->ausencia   = $holiday->absence->description;
        } else {
            $this->ausencia   = "Sin ausencia";
        }
        if (isset($holiday->period->description)) {
            $this->periodo     = $holiday->period->description;
        } else {
            $this->periodo     = "Sin periodo";
        }
    }

    public function close()
    {
        $this->clean();
        $this->emit('holidayShowEvent');
    }

    public function edit(Holiday $holiday)
    {
        $this->holiday_id     = $holiday->id;
        $this->days           = $holiday->days;
        $this->beginDate      = $holiday->beginDate;
        $this->endDate        = $holiday->endDate;
        $this->inProcess      = $holiday->inProcess;
        $this->taken          = $holiday->taken;
        $this->available      = $holiday->available;
        $this->responsable    = $holiday->responsable;
        $this->commentable    = $holiday->commentable;
        $this->absence_id     = $holiday->absence_id;
        $this->period_id      = $holiday->period_id;
        $this->created_at     = $holiday->created_at;
        $this->updated_at     = $holiday->updated_at;
        $this->accion         = "update";
    }

    public function update()
    {
        $this->validate([
            'days'          => 'required|numeric|max:100',
            'beginDate'     => 'required|date',
            'endDate'       => 'required|date',
            'inProcess'     => 'required|numeric|max:100',
            'taken'         => 'required|numeric|max:100',
            'available'     => 'numeric|max:100',
            'responsable'   => 'required|string|',
            'commentable'   => '',
            'absence_id'    => 'required',
            'period_id'     => 'required',
        ]);
        if ($this->holiday_id) {
            $holiday = Holiday::find($this->holiday_id);
            $holiday->update([
                'days'         => $this->days,
                'beginDate'    => $this->beginDate,
                'endDate'      => $this->endDate,
                'inProcess'    => $this->inProcess,
                'taken'        => $this->taken,
                'available'    => $this->available,
                'responsable'  => Auth::user()->name,
                'commentable'  => $this->commentable,
                'absence_id'   => $this->absence_id,
                'period_id'    => $this->period_id,
            ]);
            session()->flash('message', 'Vacación actualizada correctamente.');
            $this->clean();
            $this->emit('holidayUpdatedEvent');
        }
    }

    public function delete(Holiday $holiday)
    {
        $this->holiday_id     = $holiday->id;
        $this->days           = $holiday->days;
        $this->beginDate      = $holiday->beginDate;
        $this->endDate        = $holiday->endDate;
        $this->inProcess      = $holiday->inProcess;
        $this->taken          = $holiday->taken;
        $this->available      = $holiday->available;
    }

    public function destroy()
    {
        Holiday::find($this->holiday_id)->delete();
        session()->flash('message', 'Vacación eliminada correctamente.');
        $this->clean();
        $this->emit('holidayDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'holiday_id',
            'days',
            'beginDate',
            'endDate',
            'inProcess',
            'taken',
            'available',
            'responsable',
            'commentable',
            'absence_id',
            'period_id',
            'created_at',
            'updated_at',
            'accion',
            'ausencia',
            'periodo',
        ]);
        $this->mount();
    }

    public function clear()
    {
        $this->reset(['search', 'perPage', 'page']);
    }

    public function render()
    {
        $ausencias   = Absence::orderBy('description')->where('status', '1')->get();
        $periodos    = Period::orderBy('description')->where('status', '1')->get();

        if ($this->search != '') {
            $this->page = 1;
        }
        if (isset(($this->total)) && ($this->perPage > $this->total) && ($this->page != 1)) {
            $this->reset(['perPage']);
        }

        return view(
            'livewire.holiday.holiday-component',
            [
                'holidays' => Holiday::latest('id')
                    ->with('absence', 'period')
                    ->where('id', 'LIKE', "%{$this->search}%")
                    ->orWhere('days', 'LIKE', "%{$this->search}%")
                    ->orWhere('beginDate', 'LIKE', "%{$this->search}%")
                    ->orWhere('endDate', 'LIKE', "%{$this->search}%")
                    ->orWhere('inProcess', 'LIKE', "%{$this->search}%")
                    ->orWhere('taken', 'LIKE', "%{$this->search}%")
                    ->orWhere('available', 'LIKE', "%{$this->search}%")
                    ->orWhere('responsable', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ],
            compact('periodos', 'ausencias')
        );
    }
}
