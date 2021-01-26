<?php

namespace App\Http\Livewire\Preuser;

use App\Models\Preuser;
use Livewire\Component;
use Livewire\WithPagination;

class PreuserComponent extends Component
{
    use WithPagination;

    public $page = 1;

    protected $paginationTheme = 'bootstrap';

    public $preuser_id, $name, $lastname, $phone, $email, $status, $created_at, $updated_at, $accion = "store";

    public $search = '', $perPage = '10', $total;

    public $rules = [
        'name'         => 'required|string|max:100',
        'lastname'     => 'required|string|max:100',
        'phone'        => 'required|numeric|unique:preusers,phone',
        'email'        => 'required|email|max:100|unique:preusers,email',
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
        'lastname'      => 'apellidos',
        'phone'         => 'telefono',
        'email'         => 'correo electronico',
    ];

    public function mount()
    {
        $this->total = count(Preuser::all());
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updated($propertyName)
    {
        if ($this->accion == "store") {
            $this->validateOnly($propertyName, [
                'name'         => 'required|string|max:100',
                'lastname'     => 'required|string|max:100',
                'phone'        => 'required|numeric|unique:preusers,phone',
                'email'        => 'required|email|max:100|unique:preusers,email',
            ]);
        } else {
            $this->validateOnly($propertyName, [
                'name'         => 'required|string|max:100',
                'lastname'     => 'required|string|max:100',
                'phone'        => 'required|numeric|unique:preusers,phone,' . $this->preuser_id,
                'email'        => 'required|email|max:100|unique:preusers,email,' . $this->preuser_id,
            ]);
        }
    }

    public function store()
    {
        $this->validate([
            'name'         => 'required|string|max:100',
            'lastname'     => 'required|string|max:100',
            'phone'        => 'required|numeric|unique:preusers,phone',
            'email'        => 'required|email|max:100|unique:preusers,email',
        ]);
        Preuser::create([
            'name'          => $this->name,
            'lastname'      => $this->lastname,
            'phone'         => $this->phone,
            'email'         => $this->email,
        ]);
        session()->flash('message', 'Usuario creado correctamente.');
        $this->clean();
        $this->emit('preuserCreatedEvent');
    }

    public function show(Preuser $preuser)
    {
        $this->preuser_id       = $preuser->id;
        $this->name             = $preuser->name;
        $this->lastname         = $preuser->lastname;
        $this->phone            = $preuser->phone;
        $this->email            = $preuser->email;
        $this->status           = $preuser->status;
        $this->created_at       = $preuser->created_at;
        $this->updated_at       = $preuser->updated_at;
    }

    public function close()
    {
        $this->clean();
        $this->emit('preuserShowEvent');
    }

    public function edit(Preuser $preuser)
    {
        $this->preuser_id       = $preuser->id;
        $this->name             = $preuser->name;
        $this->lastname         = $preuser->lastname;
        $this->phone            = $preuser->phone;
        $this->email            = $preuser->email;
        $this->status           = $preuser->status;
        $this->accion           = "update";
    }

    public function update()
    {
        $this->validate([
            'name'         => 'required|string|max:100',
            'lastname'     => 'required|string|max:100',
            'phone'        => 'required|numeric|unique:preusers,phone,' . $this->preuser_id,
            'email'        => 'required|email|max:100|unique:preusers,email,' . $this->preuser_id,
        ]);
        if ($this->preuser_id) {
            $preusers = Preuser::find($this->preuser_id);
            $preusers->update([
                'name'          => $this->name,
                'lastname'      => $this->lastname,
                'phone'         => $this->phone,
                'email'         => $this->email,
                'status'        => $this->status,
            ]);
            session()->flash('message', 'Usuario actualizado correctamente.');
            $this->clean();
            $this->emit('preuserUpdatedEvent');
        }
    }

    public function delete(Preuser $preusers)
    {
        $this->preuser_id   = $preusers->id;
        $this->name         = $preusers->name;
        $this->lastname     = $preusers->lastname;
    }

    public function destroy()
    {
        Preuser::find($this->preuser_id)->delete();
        session()->flash('message', 'Usuario eliminado correctamente.');
        $this->clean();
        $this->emit('preuserDeletedEvent');
    }

    public function clean()
    {
        $this->reset([
            'preuser_id',
            'name',
            'lastname',
            'phone',
            'email',
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
            'livewire.preuser.preuser-component',
            [
                'preusers' => Preuser::latest('id')
                    ->where('name', 'LIKE', "%{$this->search}%")
                    ->orWhere('lastname', 'LIKE', "%{$this->search}%")
                    ->orWhere('phone', 'LIKE', "%{$this->search}%")
                    ->orWhere('email', 'LIKE', "%{$this->search}%")
                    ->paginate($this->perPage)
            ]
        );
    }
}
