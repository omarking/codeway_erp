<?php

namespace App\Http\Livewire\Position;

use App\Models\Position;
use App\Models\Profile;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class PositionComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $position_id, $description, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $page = 1, $total, $position;

    public $rules = [
        'description'  => 'required|string|max:200|unique:positions,description',
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
        $this->total = count(Position::all());

        $this->resetErrorBag();
        $this->resetValidation();
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
        Gate::authorize('haveaccess', 'position.create');

        $this->validate([
            'description' => 'required|max:200|unique:positions,description',
        ]);

        $status  = 'success';
        $content = 'Se agregó correctamente la posición';

        try {

            DB::beginTransaction();

            Position::create([
                'description'   => $this->description,
            ]);

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollBack();

            $status  = 'error';
            $content = 'Ocurrió un error al agregar la posición';

        }

        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);

        $this->clean();
        $this->emit('positionCreatedEvent');
    }

    public function show(Position $position)
    {
        Gate::authorize('haveaccess', 'position.show');

        try {

            $created            = new Carbon($position->created_at);
            $updated            = new Carbon($position->updated_at);
            $this->position_id  = $position->id;
            $this->description  = $position->description;
            $this->status       = $position->status;
            $this->created_at   = $created->format('l jS \\of F Y h:i:s A');
            $this->updated_at   = $updated->format('l jS \\of F Y h:i:s A');
            $this->position     = $position;

        } catch (\Throwable $th) {

            $status = 'error';
            $content = 'Ocurrio un error en la carga de datos';

            session()->flash('process_result', [
                'status'    => $status,
                'content'   => $content,
            ]);

        }
    }

    public function close()
    {
        $this->clean();
        $this->emit('positionShowEvent');
    }

    public function edit(Position $position)
    {
        Gate::authorize('haveaccess', 'position.edit');

        try {

            $this->position_id  = $position->id;
            $this->description  = $position->description;
            $this->status       = $position->status;
            $this->accion       = "update";

        } catch (\Throwable $th) {

            $status = 'error';
            $content = 'Ocurrio un error en la carga de datos';

            session()->flash('process_result', [
                'status'    => $status,
                'content'   => $content,
            ]);

        }
    }

    public function update()
    {
        Gate::authorize('haveaccess', 'position.edit');

        $this->validate([
            'description' => 'required|max:200|unique:positions,description,' . $this->position_id,
        ]);

        $status  = 'success';
        $content = 'Se actualizó correctamente la posición';

        try {

            DB::beginTransaction();

            if ($this->position_id) {
                $positions = Position::find($this->position_id);
                $positions->update([
                    'description'   => $this->description,
                    'status'        => $this->status,
                ]);
            }

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollBack();

            $status  = 'error';
            $content = 'Ocurrió un error al actualizar la posición';

        }

        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);

        $this->clean();
        $this->emit('positionUpdatedEvent');
    }

    public function delete(Position $position)
    {
        Gate::authorize('haveaccess', 'position.destroy');

        try {

            $this->position_id  = $position->id;
            $this->description  = $position->description;
            $this->status       = $position->status;
            
        } catch (\Throwable $th) {

            $status = 'error';
            $content = 'Ocurrio un error en la carga de datos';

            session()->flash('process_result', [
                'status'    => $status,
                'content'   => $content,
            ]);

        }
    }

    public function destroy()
    {
        Gate::authorize('haveaccess', 'position.destroy');

        $status  = 'success';
        $content = 'Se eliminó correctamente la posición';

        try {

            DB::beginTransaction();

            Position::find($this->position_id)->delete();

            DB::commit();

        } catch (\Throwable $th) {

            DB::rollBack();

            $status  = 'error';
            $content = 'Ocurrió un error al eliminar la posición';

        }

        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);

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
        $perfiles = Profile::latest('id')->where('status', '=', 1)->get();

        if ($this->search != '') {
            $this->page = 1;
        }

        if (isset(($this->total)) && ($this->perPage > $this->total) && ($this->page != 1)) {
            $this->reset(['perPage']);
        }

        return view(
            'livewire.position.position-component',
            [
                'positions' => Position::latest('id')
                    ->where('description', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ],
            compact('perfiles')
        );
    }
}
