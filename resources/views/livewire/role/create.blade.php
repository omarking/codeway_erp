<div wire:ignore.self class="modal fade" id="createRole" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="createClassModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="createClassModal">AGREGAR ROL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label class="text-muted" for="name">Nombre:</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                wire:model="name" wire:dirty.class="bg-primary">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="slug">Slug:</label>
                        <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror"
                                wire:model="slug" wire:dirty.class="bg-primary">
                        @error('slug')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="description">Descripción:</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" wire:model="description" wire:dirty.class="bg-primary" rows="3"></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="description">Acceso total:</label><br>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="fullaccessyes" name="full-access" class="custom-control-input" value="yes"
                                @if ( old('full-access')=="yes" )
                                    checked
                                @endif
                            >
                            <label class="custom-control-label" for="fullaccessyes">Yes</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="fullaccessno" name="full-access" class="custom-control-input" value="no"
                                @if ( old('full-access')=="no" )
                                    checked
                                @endif
                                @if ( old('full-access')===null )
                                    checked
                                @endif
                            >
                            <label class="custom-control-label" for="fullaccessno">No</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="responsable">Responsable:</label>
                        <input type="text" name="responsable" class="form-control @error('responsable') is-invalid @enderror"
                                wire:model="responsable" wire:dirty.class="bg-primary" disabled>
                        @error('responsable')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted text-uppercase" for="description">Permisos</label>
                        <div>
                            @forelse ( $permissions as $permisos )
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input"
                                        id="permission_{{ $permisos->id }}" wire:model="permission"
                                        value="{{$permisos->id}}"
                                        @if( is_array(old('permission')) && in_array("$permisos->id", old('permission')) )
                                            checked
                                        @endif
                                    >
                                    <label class="custom-control-label"
                                        for="permission_{{ $permisos->id }}">
                                        {{ $permisos->id }}
                                        -
                                        {{ $permisos->name }}
                                        <em>( {{ $permisos->description }} )</em>
                                    </label>
                                </div>
                            @empty
                                <li>No hay permisos registrados</li>
                            @endforelse
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="form-group justify-content-start">
                    <div wire:loading wire:loading.class="bg-white">Procesando datos...</div>
                </div>
                <div class="justify-content-end">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click.prevent="clean()">Cancelar</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="store()">Agregar Rol</button>
                </div>
            </div>
        </div>
    </div>
</div>
