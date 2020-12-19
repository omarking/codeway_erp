<?php

namespace App\Http\Livewire;

use App\Models\Priority;
use Livewire\Component;

class PriorityComponent extends Component
{
    public $action;

    public $selectedItem;

    protected $listeners = [
        'refreshParent' => '$refresh',
    ];

    public function selectedItem($itemId, $action)
    {
        $this->selectedItem = $itemId;

        if ($action == 'delete') {
            $this->dispatchBrowserEvent('openDeletePriorityModal');
        } elseif ($action == 'update') {
            $this->emit('getModelId', $this->selectedItem);
            $this->dispatchBrowserEvent('openUpdatePriorityModal');
        } elseif ($action == 'show') {
            $this->emit('getModelId', $this->selectedItem);
            $this->dispatchBrowserEvent('openShowPriorityModal');
        } else {
            $this->emit('getModelId', $this->selectedItem);
            $this->dispatchBrowserEvent('openCreatePriorityModal');
        }
    }

    public function delete()
    {
        Priority::destroy($this->selectedItem);
        $this->dispatchBrowserEvent('closeDeletePriorityModal');
    }

    public function render()
    {
        /* return view('livewire.priority-component'); */
        return view('livewire.priority-component', ['priorities' => Priority::latest('id')->get()]);
    }
}
