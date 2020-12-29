<div style="text-align: center">
    <div class="card">
        <div class="card-body">
            <button class="btn btn-primary" wire:click="increment">+</button>
            <h1>{{ $count }}</h1>
            <button class="btn btn-primary" wire:click="decrement">-</button>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            {{-- De forma predeterminada, Livewire aplica un rebote de 150 ms a las entradas de texto. Esto evita que se envíen demasiadas solicitudes de red a medida que un usuario escribe en un campo de texto. --}}
            <input type="text" wire:model.debounce.500ms="message">
        </div>
    </div>
</div>
