<?php

namespace App\Http\Livewire\Group;

use App\Models\Group;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class GroupComponent extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public $group_id, $name, $description, $responsable, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $page = 1, $total, $usuarios;

    public $rules = [
        'name'         => 'required|string|max:200|unique:groups,name',
        'description'  => 'required|string',
        'responsable'  => 'required|string',
    ];

    protected $queryString = [
        'search'  => ['except' => ''],
        'perPage' => ['except' => '10'],
    ];

    protected $validationAttributes = [
        'name'          => 'nombre',
        'description'   => 'descripción',
        'responsable'   => 'responsable',
    ];

    public function mount()
    {
        $this->total        = count(Group::all());
        $this->usuarios     = User::where('status', '=', 1)->get();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'name'         => 'required|string|max:200|unique:groups,name',
                'description'  => 'required|string',
                'responsable'  => 'required|string',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'name'         => 'required|string|max:200|unique:groups,name,' . $this->group_id,
                'description'  => 'required|string',
                'responsable'  => 'required|string',
            ]);
        }
    }

    public function store()
    {
        $this->validate([
            'name'         => 'required|string|max:200|unique:groups,name',
            'description'  => 'required|string',
            'responsable'  => 'required|string',
        ]);
        $status = 'success';
        $content = 'Se agrego correctamente el grupo';
        try {
            DB::beginTransaction();
            Group::create([
                'name'          => $this->name,
                'description'   => $this->description,
                'responsable'   => $this->responsable,
            ]);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $status = 'error';
            $content = 'Ocurrio un error al agregar el grupo';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
        $this->clean();
        $this->emit('groupCreatedEvent');
    }

    public function show(Group $group)
    {
        $created            = new Carbon($group->created_at);
        $updated            = new Carbon($group->updated_at);
        $this->group_id     = $group->id;
        $this->name         = $group->name;
        $this->description  = $group->description;
        $this->responsable  = $group->responsable;
        $this->status       = $group->status;
        $this->created_at   = $created->format('l jS \\of F Y h:i:s A');
        $this->updated_at   = $updated->format('l jS \\of F Y h:i:s A');
    }

    public function close()
    {
        $this->clean();
        $this->emit('groupShowEvent');
    }

    public function edit(Group $group)
    {
        $this->group_id     = $group->id;
        $this->name         = $group->name;
        $this->description  = $group->description;
        $this->responsable  = $group->responsable;
        $this->status       = $group->status;
        $this->accion       = "update";
    }

    public function update()
    {
        $this->validate([
            'name'         => 'required|string|max:200|unique:groups,name,' . $this->group_id,
            'description'  => 'required|string',
            'responsable'  => 'required|string',
        ]);
        $status = 'success';
        $content = 'Se actualizo correctamente el grupo';
        try {
            DB::beginTransaction();
            if ($this->group_id) {
                $groups = Group::find($this->group_id);
                $groups->update([
                    'name'          => $this->name,
                    'description'   => $this->description,
                    'responsable'   => $this->responsable,
                    'status'        => $this->status,
                ]);
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $status = 'error';
            $content = 'Ocurrio un error al actualizar el grupo';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
        $this->clean();
        $this->emit('groupUpdatedEvent');
    }

    public function delete(Group $group)
    {
        $this->group_id     = $group->id;
        $this->name         = $group->name;
    }

    public function destroy()
    {
        $status = 'success';
        $content = 'Se elimino correctamente el grupo';
        try {
            DB::beginTransaction();
            Group::find($this->group_id)->delete();
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            $status = 'error';
            $content = 'Ocurrio un error al eliminar el grupo';
        }
        session()->flash('process_result', [
            'status'    => $status,
            'content'   => $content,
        ]);
        $this->clean();
        $this->emit('groupDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'group_id',
            'name',
            'description',
            'responsable',
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
            'livewire.group.group-component',
            [
                'groups' => Group::latest('id')
                    ->where('name', 'LIKE', "%{$this->search}%")
                    ->orWhere('description', 'LIKE', "%{$this->search}%")
                    ->orWhere('responsable', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ]
        );
    }
}
