<div wire:ignore.self class="modal fade" id="showProject" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="showProjectModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="showProjectModal">MOSTRAR PROYECTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    {{-- <div class="form-group">
                        <label class="text-muted" for="avatar">Avatar:</label>
                        <h5>{{ $avatar }}</h5>
                    </div> --}}
                    <div class="form-group">
                        <label class="text-muted" for="key">Clave:</label>
                        <h5>{{ $key }}</h5>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="name">Nombre:</label>
                        <h5>{{ $name }}</h5>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="description">Descripción:</label>
                        <h5>{{ $description }}</h5>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="responsable">Responsable:</label>
                        <h5>{{ $responsable }}</h5>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="status">Estado:</label>
                        @if($status == 1)
                            <h5>Activo</h5>
                        @else
                            <h5>Inactivo</h5>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="category_id">Clase:</label>
                        @isset($clase)
                            <h5>{{ $clase }}</h5>
                        @endisset
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="description">Categoria:</label>
                        @isset($categoria)
                            <h5>{{ $categoria }}</h5>
                        @endisset
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="created_at">Creado:</label>
                        <h5>{{ $created_at }}</h5>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="updated_at">Actualizado:</label>
                        <h5>{{ $updated_at }}</h5>
                    </div>
                    {{-- <div class="form-group">
                        <label class="text-muted text-uppercase" for="permisos">Tareas</label>
                        <div>
                            @foreach ($tareas as $tarea)
                            <h6> {{ $tarea }} </h6>
                                @if ()

                                @endif
                                <div class="custom-control custom-checkbox">
                                    <label for="tarea"></label>
                                    <input type="checkbox" disabled class="custom-control-input"
                                        id="permission_{{ $permission->id }}" wire:model="permission_role"
                                        value="{{ $permission->id }}"
                                        @if(is_array($permission_role) && in_array("$permission->id", $permission_role))
                                            checked
                                        @endif
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
                    </div> --}}
                </form>
            </div>
            <div class="modal-footer">
                <div class="form-group justify-content-start">
                    <div wire:loading wire:loading.class="bg-white">Procesando datos...</div>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click.prevent="clean()">Cancelar</button>
                <button type="button" class="btn btn-info" wire:click.prevent="close()">Aceptar</button>
            </div>
        </div>
    </div>
</div>
