<div>
    {{-- En este modal se crea un nuevo tipo --}}
    <div class="modal fade" id="createType" data-keyboard="false" tabindex="-1" aria-labelledby="createTypeLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTypeLabel">Registrar nuevo tipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <h6>Descripcion :</h6>
                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                            wire:model="description" placeholder="Descripcion del tipo"
                            name="description" autocomplete="description" required autofocus
                        >
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    @if ($accion == "store")
                        <button wire:click="store" class="btn btn-primary">Agregar</button>
                    @else
                        <button wire:click="update" class="btn btn-info">Actualizar</button>
                        <button wire:click="defaults" class="btn btn-danger">Cancelar</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- En este modal se actualiza un tipo --}}
    <div class="modal fade" id="editType" data-keyboard="false" tabindex="-1" aria-labelledby="editTypeLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTypeLabel">Actualizar tipo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <h6>Descripcion :</h6>
                        <input type="text" class="form-control @error('description') is-invalid @enderror"
                            wire:model="description" placeholder="Descripcion del tipo"
                            name="description" autocomplete="description" required autofocus
                        >
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <h6>Estatus :</h6>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="statusType1" wire:model="status" name="status" class="custom-control-input" value="1"
                                @if ( $status == "1" )
                                    checked
                                @endif
                            >
                            <label class="custom-control-label" for="statusType1">Activo</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="statusType0" wire:model="status" name="status" class="custom-control-input" value="0"
                                @if ( $status == "0" )
                                    checked
                                @endif
                            >
                            <label class="custom-control-label" for="statusType0">Inactivo</label>
                            <hr>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    @if ($accion != "store")
                        <button wire:click="store" class="btn btn-primary">Agregar</button>
                    @else
                        <button wire:click="update" class="btn btn-info">Actualizar</button>
                        <button wire:click="defaults" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Se muestran los tipos --}}
    <div class="card">
        <div class="card-header">
            <div class="justify-content-end float">
                <h1 class="card-title">Tipos</h1>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#createType">Agregar</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped table-hover" id="typeTable">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Status</th>
                            <th scope="col">Creado</th>
                            <th scope="col">Actualizado</th>
                            <th scope="colgroup">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($types as $type)
                            <tr>
                                <th scope="row">{{ $type->id }}</th>
                                <td>{{ $type->description }}</td>
                                <td>{{ $type->status }}</td>
                                <td>{{ $type->created_at->diffForHumans() }}</td>
                                <td>{{ $type->updated_at->diffForHumans() }}</td>
                                <td>
                                    <button class="btn btn-info">Show</button>
                                    <button type="button" wire:click="edit({{ $type }})" class="btn btn-success" data-toggle="modal" data-target="#editType">Edit</button>
                                    <button wire:click="destroy({{ $type }})" class="btn btn-danger">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>
