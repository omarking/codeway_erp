<div wire:ignore.self class="modal fade" id="updateRole" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="updateClassModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="updateClassModal">MODIFICAR ROL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @if ($fullAccess != "yes")
                        <div class="col-lg-5 mb-4">
                    @else
                        <div class="col-lg-12 mb-4">
                    @endif
                        <form>
                            <div class="form-group">
                                <label class="text-muted" for="name">Nombre:</label>
                                <input type="text" name="name" wire:dirty.class="bg-success"
                                    class="form-control @error('name') is-invalid @enderror" wire:model="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="text-muted" for="slug">Identificador:</label>
                                <input type="text" name="slug" wire:dirty.class="bg-success"
                                    class="form-control @error('slug') is-invalid @enderror" wire:model="slug">
                                @error('slug')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="text-muted" for="description">Descripción:</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" name="description" wire:model="description" wire:dirty.class="bg-success" rows="3"></textarea>
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="text-muted" for="description">Acceso total:</label><br>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="fullaccessyes" name="fullAccess" wire:model="fullAccess" class="custom-control-input" value="yes">
                                    <label class="custom-control-label" for="fullaccessyes">Si</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="fullaccessno" wire:model="fullAccess" name="fullAccess" class="custom-control-input" value="no" checked>
                                    <label class="custom-control-label" for="fullaccessno">No</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="text-muted" for="responsable">Responsable:</label>
                                <input type="text" name="responsable" wire:dirty.class="bg-success" disabled
                                    class="form-control @error('responsable') is-invalid @enderror" wire:model="responsable">
                                @error('responsable')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label class="text-muted" for="color">Estado:</label><br>
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
                        </form>
                    </div>
                    @if ($fullAccess != "yes")
                        <div class="col-lg-6 mb-4">
                            <div class="form-group">
                                <label class="text-muted text-uppercase" for="permisos">Lista de Permisos</label>
                                <div>
                                    @foreach ($permissions as $permission)
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                id="permission_{{$permission->id}}"  value="{{$permission->id}}"
                                                name="permission[]" wire:model="permission"
                                            >
                                            <label class="custom-control-label"
                                                for="permission_{{ $permission->id }}">
                                                {{ $permission->id }}
                                                -
                                                {{ $permission->name }}
                                                <em>( {{ $permission->description }} )</em>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                                <div>
                                    <label class="btn btn-light" value="reset" wire:click="limpia()">Limpiar</label>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <div class="form-group justify-content-start">
                    <div wire:loading wire:loading.class="bg-white">Procesando datos...</div>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click.prevent="clean()">Cancelar</button>
                <button type="button" class="btn btn-success" wire:click.prevent="update()">Actualizar Rol</button>
            </div>
        </div>
    </div>
</div>
