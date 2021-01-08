<div>
    <div class="card">
        <div class="card-header bg-secondary">
            <div class="text-xl-left">
                <h3 class="card-title text-uppercase">Usuarios</h3>
            </div>
            <div>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#createUser">Agregar Usuario</button>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <div class="card">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
                <div class="form-group d-flex justify-content-between">
                    <div class="col-md-auto col-lg-9">
                        <input type="text" class="form-control" placeholder="Buscar" wire:model="search" wire:dirty.class="bg-secondary">
                    </div>
                    <div class="col-md-auto col-lg-2">
                        <select class="form-control" wire:model="perPage">
                            <option value="10">10 por página</option>
                            <option value="25">25 por página</option>
                            <option value="50">50 por página</option>
                            <option value="100">100 por página</option>
                        </select>
                    </div>
                    @if ($search !== '')
                    <div wire:click="clear" class="col col-lg-1">
                        <button class="btn btn-light">X</button>
                    </div>
                    @endif
                </div>
                <table wire:poll.10000ms id="userTable" class="table table-white table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Email</th>
                            {{-- <th scope="col">Corporativo</th> --}}
                            <th scope="col">Roles</th>
                            <th scope="col">Estado</th>
                            <th scope="colgroup">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->nameUser }} {{ $user->firstLastname }} {{ $user->secondLastname }}</td>
                                <td>{{ $user->phone }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                {{-- <td>{{ $user->corporative }}</td> --}}
                                <td>
                                    @isset( $user->roles[0]->name )
                                        {{ $user->roles[0]->name }}
                                    @else
                                        Sin Rol
                                    @endisset
                                </td>
                                <td>
                                    @if ($user->status == "1")
                                        Activo
                                    @else
                                        Inactivo
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" wire:click.prevent="show({{ $user->id }})" class="btn btn-info" data-toggle="modal" data-target="#showUser">Mostrar</button>
                                        <button type="button" wire:click.prevent="edit({{ $user->id }})" class="btn btn-success" data-toggle="modal" data-target="#updateUser">Editar</button>
                                        <button type="button" wire:click.prevent="delete({{ $user->id }})" class="btn btn-danger" data-toggle="modal" data-target="#deleteUser">Borrar</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            @if ($users->count())
                <nav class="col col-lg-6 justify-content-start" aria-label="Page navigation example">
                    <ul class="pagination justify-content">
                        <h6>Mostrando {{ $users->count() }} registros de {{ $total }} registros totales en la pagina {{ $page }}</h6>
                    </ul>
                    <ul>
                        <small>Paginas: {{ $page }}</small>
                        <small>Buscar: {{ $search }}</small>
                        <small>PerPage: {{ $perPage }}</small>
                        <small>Users: {{ $users->count() }}</small>
                    </ul>
                </nav>
                <nav class="col col-lg-6 justify-content-end" aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        {{ $users->links() }}
                    </ul>
                </nav>
            @else
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content">
                        <h6>No hay resultados para la búsqueda "{{ $search }}" en la página {{ $page }} al mostrar {{ $perPage }} por página</h6>
                    </ul>
                    <ul>
                        <small>Paginas: {{ $page }}</small>
                        <small>Buscar: {{ $search }}</small>
                        <small>PerPage: {{ $perPage }}</small>
                        <small>Users: {{ $users->count() }}</small>
                    </ul>
                </nav>
            @endif
        </div>
    </div>
    @include('livewire.user.create')
    @include('livewire.user.show')
    @include('livewire.user.update')
    @include('livewire.user.delete')
</div>
