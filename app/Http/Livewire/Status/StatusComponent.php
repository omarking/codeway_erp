<?php

namespace App\Http\Livewire\Status;

use App\Models\Statu;
use App\Models\Task;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class StatusComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $status_id, $description, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $page = 1, $total, $task, $statu;

    public $rules = [
        'description'  => 'required|string|max:200|unique:status,description',
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
        $status  = 'success';
        $content = 'Se agrego correctamente el estado';
        try {
            DB::beginTransaction();
            Statu::create([
                'description'   => $this->description,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status  = 'error';
            $content = 'Ocurrio un error al agregar el estado';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
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
        $status  = 'success';
        $content = 'Se actualizo correctamente el estado';
        try {
            DB::beginTransaction();
            if ($this->status_id) {
                $clase = Statu::find($this->status_id);
                $clase->update([
                    'description'   => $this->description,
                    'status'        => $this->status,
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status  = 'error';
            $content = 'Ocurrio un error al actualizar el estado';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
        $this->clean();
        $this->emit('statusUpdatedEvent');
    }

    public function delete(Statu $status)
    {
        $this->status_id    = $status->id;
        $this->description  = $status->description;
    }

    public function destroy()
    {
        $status  = 'success';
        $content = 'Se elimino correctamente el estado';
        try {
            DB::beginTransaction();
            Statu::find($this->status_id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            $status  = 'error';
            $content = 'Ocurrio un error al eliminar el estado';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
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
