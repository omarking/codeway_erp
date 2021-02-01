<?php

namespace App\Http\Livewire\Absence;

use App\Models\Absence;
use App\Models\Holiday;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class AbsenceComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $absence_id, $description, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total, $absence, $page = 1;

    public $rules = [
        'description'  => 'required|string|max:200|unique:absences,description',
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

        $status = 'success';
        $content = 'Se agrego correctamente la ausencia';

        try {
            DB::beginTransaction();
            Absence::create([
                'description'   => $this->description,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $status = 'error';
            $content = 'Ocurrio un error al agregar la ausencia';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
        $this->clean();
        $this->emit('absenceCreatedEvent');
    }

    public function show(Absence $absence)
    {
        $created            = new Carbon($absence->created_at);
        $updated            = new Carbon($absence->updated_at);
        $this->absence_id   = $absence->id;
        $this->description  = $absence->description;
        $this->status       = $absence->status;
        $this->created_at   = $created->format('l jS \\of F Y h:i:s A');
        $this->updated_at   = $updated->format('l jS \\of F Y h:i:s A');
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
        $status = 'success';
        $content = 'Se actualizo correctamente la ausencia';
        try {
            DB::beginTransaction();
            if ($this->absence_id) {
                $absence = Absence::find($this->absence_id);
                $absence->update([
                    'description'   => $this->description,
                    'status'        => $this->status,
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $status = 'error';
            $content = 'Ocurrio un error al actualizar la ausencia';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
        $this->clean();
        $this->emit('absenceUpdatedEvent');
    }

    public function delete(Absence $absence)
    {
        $this->absence_id   = $absence->id;
        $this->description  = $absence->description;
    }

    public function destroy()
    {
        $status = 'success';
        $content = 'Se elimino correctamente la ausencia';
        try {
            DB::beginTransaction();
            Absence::find($this->absence_id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $status = 'error';
            $content = 'Ocurrio un error al eliminar la ausencia';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
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
