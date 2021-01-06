<div wire:ignore.self class="modal fade" id="createUser" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="createUserModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="createUserModal">AGREGAR USUARIO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label class="text-muted" for="nameUser">Nombre:</label>
                        <input type="text" name="nameUser" class="form-control @error('nameUser') is-invalid @enderror"
                                wire:model="nameUser" wire:dirty.class="bg-primary">
                        @error('nameUser')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="firstLastname">Primer Apellido:</label>
                        <input type="text" name="firstLastname" class="form-control @error('firstLastname') is-invalid @enderror"
                                wire:model="firstLastname" wire:dirty.class="bg-primary">
                        @error('firstLastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="secondLastname">Segundo Apellido:</label>
                        <input type="text" name="secondLastname" class="form-control @error('secondLastname') is-invalid @enderror"
                                wire:model="secondLastname" wire:dirty.class="bg-primary">
                        @error('secondLastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="phone">Telefono:</label>
                        <input type="number" name="phone" class="form-control @error('phone') is-invalid @enderror"
                                wire:model="phone" wire:dirty.class="bg-primary">
                        @error('phone')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="name">Nombre de Usuario:</label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                wire:model="name" wire:dirty.class="bg-primary">
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="email">Email:</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                                wire:model="email" wire:dirty.class="bg-primary">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="password">Contraseña:</label>
                        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                                wire:model="password" wire:dirty.class="bg-primary">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="role">Rol:</label>
                        <select wire:model="role" class="form-control @error('role') is-invalid @enderror" name="role" wire:dirty.class="bg-primary" id="role">
                            <option value="">--Seleccione el rol--</option>
                            @foreach($roless as $role)
                                <option value="{{$role->id}}">
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
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
                    <button type="button" class="btn btn-primary" wire:click.prevent="store()">Agregar Usuario</button>
                </div>
            </div>
        </div>
    </div>
</div>
