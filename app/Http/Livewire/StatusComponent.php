<?php

namespace App\Http\Livewire;

use App\Models\Statu;
use Livewire\Component;

class StatusComponent extends Component
{
    public $description, $status, $statu_id;

    public $accion = "store";

    public function render()
    {
        $estados = Statu::all();
        return view('livewire.status-component', compact('estados'));
    }

    public function store()
    {
        $this->validate([
            'description' => 'required|min:4|max:100|unique:status,description',
        ]);
        Statu::create([
            'description' => $this->description,
        ]);
        $this->defaults();
    }

    public function edit(Statu $statu)
    {
        $this->description  = $statu->description;
        $this->status       = $statu->status;
        $this->statu_id     = $statu->id;
        $this->accion       = "update";
    }

    public function updated($field)
    {
        if ($this->accion == "store") {
            $this->validateOnly($field, [
                'description' => 'required|min:4|max:100|unique:status,description',
                'status'      => 'required',
            ]);
        } else {
            $this->validateOnly($field, [
                'description' => 'required|min:4|max:100|unique:status,description,' . $this->statu_id,
                'status'      => 'required',
            ]);
        }
    }

    public function update()
    {
        $type = Statu::find($this->statu_id);
        $type->update([
            'description'   => $this->description,
            'status'        => $this->status,
        ]);
        $this->defaults();
    }

    public function destroy(Statu $statu)
    {
        $statu->delete();
        $this->defaults();
    }

    public function defaults()
    {
        $this->reset(['description', 'status', 'accion', 'statu_id']);
    }
}
