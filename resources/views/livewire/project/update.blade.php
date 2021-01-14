<div wire:ignore.self class="modal fade" id="updateProject" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="updateProjectModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="updateProjectModal">MODIFICAR PROYECTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    {{-- <div class="form-group">
                        <label class="text-muted" for="avatar">Imagen:</label>
                        <input type="text" name="avatar" wire:dirty.class="bg-success"
                            class="form-control @error('avatar') is-invalid @enderror" wire:model="avatar">
                        @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div> --}}
                    <div class="form-group">
                        <label class="text-muted" for="key">Clave:</label>
                        <input type="text" name="key" wire:dirty.class="bg-success"
                            class="form-control @error('key') is-invalid @enderror" wire:model="key">
                        @error('key')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
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
                        <label class="text-muted" for="description">Descripción:</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" wire:model="description" wire:dirty.class="bg-success" rows="3"></textarea>
                        @error('description')
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
                    <div class="form-group">
                        <label class="text-muted" for="responsable">Responsable:</label>
                        <input type="text" name="responsable" wire:dirty.class="bg-success"
                            class="form-control @error('responsable') is-invalid @enderror" wire:model="responsable" disabled>
                        @error('responsable')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="clas_id">Clase:</label>
                        <select wire:model="clas_id" class="form-control @error('clas_id') is-invalid @enderror" name="clas_id" wire:dirty.class="bg-success">
                            <option value="">--Seleccione la clase--</option>
                            @foreach($clases as $clase)
                                <option  value="{{ $clase->id }}"
                                    @isset( $clase->description )
                                        @if( $clase->description )
                                            selected
                                        @endif
                                    @endisset
                                    >
                                    {{ $clase->description }}
                                </option>
                            @endforeach
                        </select>
                        @error('clas_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="category_id">Categoria:</label>
                        <select wire:model="category_id" class="form-control @error('category_id') is-invalid @enderror"  name="category_id" wire:dirty.class="bg-success">
                            <option value="">--Seleccione la categoria--</option>
                            @foreach($categorias as $categoria)
                                <option  value="{{ $categoria->id }}"
                                    @isset( $categoria->description )
                                        @if( $categoria->description )
                                            selected
                                        @endif
                                    @endisset
                                    >
                                    {{ $categoria->description }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="form-group justify-content-start">
                    <div wire:loading wire:loading.class="bg-white">Procesando datos...</div>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click.prevent="clean()">Cancelar</button>
                <button type="button" class="btn btn-success" wire:click.prevent="update()">Actualizar Proyecto</button>
            </div>
        </div>
    </div>
</div>
