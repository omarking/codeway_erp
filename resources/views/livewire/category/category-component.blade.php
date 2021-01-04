<div>
    <div class="card">
        <div class="card-header bg-secondary">
            <div class="text-xl-left">
                <h3 class="card-title text-uppercase">Categorias</h3>
            </div>
            <div>
                <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#createCategory">Agregar Categoria</button>
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
                            {{-- <option value="50">50 por página</option> --}}
                            {{-- <option value="100">100 por página</option> --}}
                        </select>
                    </div>
                    @if ($search !== '')
                    <div wire:click="clear" class="col col-lg-1">
                        <button class="btn btn-light">X</button>
                    </div>
                    @endif
                </div>
                <table wire:poll.10000ms id="categoryTable" class="table table-white table-striped table-hover">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Categorias</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Creado</th>
                            <th scope="col">Actualizado</th>
                            <th scope="colgroup">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <th scope="row">{{ $category->id }}</th>
                                <td>{{ $category->description }}</td>
                                <td>
                                    @if ($category->status == "1")
                                        Activa
                                    @else
                                        Inactivo
                                    @endif
                                </td>
                                <td>{{ $category->created_at->diffForHumans() }}</td>
                                <td>{{ $category->updated_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" wire:click.prevent="show({{ $category->id }})" class="btn btn-info" data-toggle="modal" data-target="#showCategory">Mostrar</button>
                                        <button type="button" wire:click.prevent="edit({{ $category->id }})" class="btn btn-success" data-toggle="modal" data-target="#updateCategory">Editar</button>
                                        <button type="button" wire:click.prevent="delete({{ $category->id }})" class="btn btn-danger" data-toggle="modal" data-target="#deleteCategory">Borrar</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer d-flex justify-content-between">
            @if ($categories->count())
                <nav class="col col-lg-6 justify-content-start" aria-label="Page navigation example">
                    <ul class="pagination justify-content">
                        <h6>Mostrando {{ $perPage }} registros de {{ $total }} registros totales en la pagina {{ $page }}</h6>
                    </ul>
                </nav>
                <nav class="col col-lg-6 justify-content-end" aria-label="Page navigation example">
                    <ul class="pagination justify-content-end">
                        {{ $categories->links() }}
                    </ul>
                </nav>
            @else
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content">
                        <h6>No hay resultados para la búsqueda "{{ $search}}" en la página {{ $page }} al mostrar {{ $perPage }} por página</h6>
                    </ul>
                </nav>
            @endif
        </div>
    </div>
    @include('livewire.category.create')
    @include('livewire.category.show')
    @include('livewire.category.update')
    @include('livewire.category.delete')
    {{-- <div class="card">
        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

    <div class="card" wire:offline.class="bg-red-300">
        <div class="card-header">
            <h1 class="card-title">Agregar categoria</h1>
        </div>
        <form wire:submit.prevent="save">
            <div class="card-body">
                <span wire:dirty wire:target="description">validando...</span>
                <input wire:dirty.class="border-red-500" wire:model.lazy="description" class="form-control" type="text" wire:model="description">
                @error('description') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="card-footer">
                <button wire:offline.attr="disabled" class="btn btn-success" type="submit">Save</button>
            </div>
        </form>
    </div>

    <div >
        <div wire:loading wire:loading.class="bg-gray">Procesando datos 1</div>
        <div wire:loading.flex>Procesando datos 2</div>
        <div wire:loading.grid>Procesando datos 3</div>
        <div wire:loading.inline>Procesando datos 4</div>
        <div wire:loading.table>Procesando datos 5</div>
    </div>

    <div class="card">
        <div wire:loading.remove>
            Esperando a ocultarse...
        </div>
    </div> --}}

    {{-- Actualizara el componenete cada 2 seg en el que se agrege este de wire:poll --}}
    {{-- <div class="card">
        <div wire:poll.15000ms>
            Current time: {{ now() }}
        </div>
    </div> --}}

    {{-- <div class="card">
        <button wire:click.prefetch="toggleContent">Ver Contenido</button>

        @if ($contentIsVisible)
            <span>Algo se debera de mostrar</span>
        @endif
    </div> --}}

    {{-- Muestra al usuario si ha pedido la conexion a intenet --}}
    {{-- <div class="card">
        <div wire:offline>
            Conexion a intenet perdida, revisa tu configuración
        </div>
    </div>

    <div class="card">
        <div x-data="{ open: false }">
            <button @click="open = true">Show More...</button>

            <ul x-show="open" @click.away="open = false">
                <li><button wire:click="archive">Archive</button></li>
                <li><button wire:click="delete">Delete</button></li>
            </ul>
        </div>
    </div> --}}
</div>
