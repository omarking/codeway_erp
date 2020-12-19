<div>
    {{-- Crear prioridad --}}
    <div class="modal fade" id="createPriority"  tabindex="-1" aria-labelledby="createPriorityModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPriorityModal">Agregar nueva prioridad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @livewire('priority-form-component')
                </div>
            </div>
        </div>
    </div>

    {{-- Detalle prioridad --}}
    <div class="modal fade" id="showPriority"  tabindex="-1" aria-labelledby="showPriorityModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="showPriorityModal">Detalle prioridad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @livewire('priority-form-component')
                </div>
            </div>
        </div>
    </div>

    {{-- Actualizar prioridad --}}
    <div class="modal fade" id="updatePriority"  tabindex="-1" aria-labelledby="updatePriorityModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updatePriorityModal">Actualizar prioridad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @livewire('priority-form-component')
                </div>
            </div>
        </div>
    </div>

    {{-- Eliminar prioridad --}}
    <div class="modal fade" id="deletePriority" tabindex="-1" aria-labelledby="deletePriorityModal" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deletePriorityModal">Eliminar prioridad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h3>¿Seguro que quieres borrar la prioridad?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button wire:click="delete" type="button" class="btn btn-primary" >Eliminar</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Mostrar lista de prioridades --}}
    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Prioridades</h1>
            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#createPriority">Agregar</button>
        </div>
        <div class="card-body">
            {{-- @if ($priorities->count()) --}}
                <div class="table-responsive">
                    <table class="table table-white table-striped table-hover" id="priorityTables">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Prioridad</th>
                                <th scope="col">Estatus</th>
                                <th scope="col">Creado</th>
                                <th scope="col">Actualizado</th>
                                <th scope="colgroup">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($priorities as $priority)
                                <tr>
                                    <th scope="row">{{ $priority->id }}</th>
                                    <td>{{ $priority->description }}</td>
                                    <td>{{ $priority->status }}</td>
                                    <td>{{ $priority->created_at->diffForHumans() }}</td>
                                    <td>{{ $priority->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <button wire:click="selectedItem({{ $priority->id }}, 'show')" class="btn btn-info">Ver</button>
                                        <button wire:click="selectedItem({{ $priority->id }}, 'update')" class="btn btn-success">Editar</button>
                                        <button wire:click="selectedItem({{ $priority->id }}, 'delete')" class="btn btn-danger">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            {{-- @endif --}}
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>
