<?php

namespace App\Http\Livewire;

use App\Models\Type;
use Livewire\Component;

class TypeComponent extends Component
{
    public $description, $status, $type_id;

    public $accion = "store";

    public function render()
    {
        $types = Type::latest('id')->get();
        return view('livewire.type-component', compact('types'));
    }

    public function store()
    {
        $this->validate([
            'description' => 'required|min:4|max:100|unique:types,description',
        ]);
        Type::create([
            'description' => $this->description,
        ]);
        $this->defaults();
    }

    public function edit(Type $type)
    {
        $this->description  = $type->description;
        $this->status       = $type->status;
        $this->type_id      = $type->id;
        $this->accion       = "update";
    }

    /* public function updated($field)
    {
        if ($this->accion == "store") {
            $this->validateOnly($field, [
                'description' => 'required|min:4|max:100|unique:types,description',
                'status'      => 'required',
            ]);
        } else {
            $this->validateOnly($field, [
                'description' => 'required|min:4|max:100|unique:types,description,' . $this->type_id,
                'status'      => 'required',
            ]);
        }
    } */

    public function update()
    {
        $type = Type::find($this->type_id);
        $this->validate([
            'description' => 'required|min:5|max:100|unique:types,description,' . $type->id,
            'status'      => 'required',
        ]);
        $type->update([
            'description'   => $this->description,
            'status'        => $this->status,
        ]);
        $this->defaults();
    }

    public function destroy(Type $type)
    {
        $type->delete();
        $this->defaults();
    }

    public function defaults()
    {
        $this->reset(['description', 'status', 'accion', 'type_id']);
    }
}
