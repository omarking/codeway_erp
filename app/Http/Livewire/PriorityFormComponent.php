<?php

namespace App\Http\Livewire;

use App\Models\Priority;
use Livewire\Component;

class PriorityFormComponent extends Component
{
    public $description, $status, $priority_id;

    public $accion = "store";

    protected $listeners = [
        'getModelId',
        'forcedCloseModal',
    ];

    public function getModelId($priority)
    {
        $this->priority_id = $priority;

        $model = Priority::find($this->priority_id);

        $this->description  = $model->description;
        $this->status       = $model->status;
        $this->accion = 'update';
    }

    public function updated($field)
    {
        if ($this->accion == "store") {
            $this->validateOnly($field, [
                'description' => 'required|min:4|max:100|unique:priorities,description',
            ]);
        } else {
            $this->validateOnly($field, [
                'description' => 'required|min:4|max:100|unique:priorities,description,' . $this->priority_id,
            ]);
        }
    }

    public function store()
    {
        $data = [
            'description' => $this->description,
        ];

        if ($this->priority_id) {
            $this->validate([
                'description' => 'required|min:4|max:100|unique:priorities,description,' . $this->priority_id,
                'status'      => 'required',
            ]);
            Priority::find($this->priority_id)->update($data);
        } else {
            $this->validate([
                'description' => 'required|min:4|max:100|unique:priorities,description',
            ]);
            Priority::create($data);
        }

        $this->emit('refreshParent');
        $this->dispatchBrowserEvent('closeCreatePriorityModal');
        $this->clean();
    }

    public function forcedCloseModal()
    {
        $this->clean();

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function clean()
    {
        $this->reset(['description', 'status', 'priority_id', 'accion',]);
    }
    public function close()
    {
        if ($this->accion == 'store') {
            $this->dispatchBrowserEvent('closeCreatePriorityModal');
        } elseif ($this->accion == 'update') {
            $this->dispatchBrowserEvent('closeUpdatePriorityModal');
        } else {
            $this->dispatchBrowserEvent('closeShowPriorityModal');
        }
    }

    public function render()
    {
        return view('livewire.priority-form-component', ['priorities' => Priority::latest('id')->get()]);
    }
}
