<div wire:ignore.self class="modal fade" id="createProject" data-backdrop="static" role="document" data-keyboard="false" tabindex="-1" aria-labelledby="createProjectModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="createProjectModal">AGREGAR PROYECTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label class="text-muted" for="avatar">Imagen:</label>
                        <input type="text" name="avatar" class="form-control @error('avatar') is-invalid @enderror"
                                wire:model="avatar" wire:dirty.class="bg-primary">
                        @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="key">Clave:</label>
                        <input type="text" name="key" class="form-control @error('key') is-invalid @enderror"
                                wire:model="key" wire:dirty.class="bg-primary">
                        @error('key')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
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
                        <label class="text-muted" for="description">Descripción:</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" wire:model="description" wire:dirty.class="bg-primary" rows="3"></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
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
                        <label class="text-muted" for="clas_id">Clase:</label>
                        <select wire:model="clas_id" class="form-control @error('clas_id') is-invalid @enderror" name="clas_id" wire:dirty.class="bg-primary">
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
                        <select wire:model="category_id" class="form-control @error('category_id') is-invalid @enderror"  name="category_id" wire:dirty.class="bg-primary">
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
                <div class="justify-content-end">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click.prevent="clean()">Cancelar</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="store()">Agregar Proyecto</button>
                </div>
            </div>
        </div>
    </div>
</div>
