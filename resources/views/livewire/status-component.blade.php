<div>
    <div class="card">
        <div class="card-header">
            <div class="form-group">
                <h6>Descripción :</h6>
                <input type="text" class="form-control @error('description') is-invalid @enderror"
                    wire:model="description" placeholder="Descripción del estado"
                    name="description" value="{{ old('description') }}"
                    autocomplete="description" required autofocus
                >
                @error('description')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="card-body">
            <h6>Estado :</h6>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="statusEstado1" name="status" class="custom-control-input" value="1"
                    {{-- @if ( $types->status =="1" )
                        checked
                    @elseif ( old('status')=="1" )
                        checked
                    @endif --}}
                >
                <label class="custom-control-label" for="statusEstado1">Activo</label>
            </div>
            <div class="custom-control custom-radio custom-control-inline">
                <input type="radio" id="statusEstado0" name="status" class="custom-control-input" value="0"
                {{--  @if ( $types->status =="0" )
                        checked
                    @elseif ( old('status')=="0" )
                        checked
                    @endif --}}
                >
                <label class="custom-control-label" for="statusEstado0">Inactivo</label>
                <hr>
            </div>
        </div>
        <div class="card-footer">
            <div class="form-group">
                @if ($accion == "store")
                    <button wire:click="store" class="btn btn-primary">Agregar</button>
                @else
                    <button wire:click="update" class="btn btn-secondary">Actualizar</button>
                    <button wire:click="defaults" class="btn btn-danger">Cancelar</button>
                @endif
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <h1 class="card-title">Estados</h1>
            <button type="button" class="btn btn-primary float-right" data-toggle="modal">Agregar</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if ($estados->count())
                    <table class="table table-striped table-hover" id="statusTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Status</th>
                                <th scope="col">Creado</th>
                                <th scope="col">Actualizado</th>
                                <th scope="colgroup">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($estados as $estado)
                                <tr>
                                    <th scope="row">{{ $estado->id }}</th>
                                    <td>{{ $estado->description }}</td>
                                    <td>{{ $estado->status }}</td>
                                    <td>{{ $estado->created_at->diffForHumans() }}</td>
                                    <td>{{ $estado->updated_at->diffForHumans() }}</td>
                                    <td>
                                        <button class="btn btn-info">Show</button>
                                        <button wire:click="edit({{ $estado }})" class="btn btn-success">Edit</button>
                                        <button wire:click="destroy({{ $estado }})" class="btn btn-danger">Eliminar</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>
</div>
