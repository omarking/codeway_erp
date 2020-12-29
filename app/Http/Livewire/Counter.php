<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Counter extends Component
{

    public $count = 0;

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        $this->count--;
    }
    /* Puede inicializar propiedades utilizando el mountmétodo de su componente */
    public $message;
    public function mount()
    {
        $this->message = 'Hello World!';
    }

    /* Livewire ofrece $this->reset()restablecer programáticamente los valores de propiedad pública a su estado inicial */
    public $search = '';
    public $isActive = true;
    public function resetFilters()
    {
        $this->reset('search');
        // Will only reset the search property.

        $this->reset(['search', 'isActive']);
        // Will reset both the search AND the isActive property.
    }

    public function render()
    {
        return view('livewire.counter');
    }
}
