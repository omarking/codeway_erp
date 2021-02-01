<div>
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <div class="d-flex justify-content-start">
                <h4 class="font-weight-normal text-uppercase" for="name">{{ $proyecto->name }}</h4>
            </div>
            <div class="d-flex justify-content-end">
                {{-- <h6>{{$proyecto->responsable}}</h6> --}}
            </div>
        </div>
        <div class="card-body">
            <div class="form-group d-flex justify-content-between">
                <div class="col-lg-3 col-md-3 col-sm-3">
                    {{-- <input type="text" class="form-control" placeholder="Buscar" wire:model="search" wire:dirty.class="bg-secondary"> --}}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    {{-- @foreach ($tareas as $tarea)
                        @foreach ($tarea->users as $user)
                            {{ $user->name }}
                        @endforeach
                    @endforeach --}}
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3">
                    {{-- <select class="form-control" wire:model="perPage">
                        <option value="10">10 por página</option>
                        <option value="25">25 por página</option>
                        <option value="50">50 por página</option>
                        <option value="100">100 por página</option>
                    </select> --}}
                </div>
                {{-- @if ($search !== '')
                    <div wire:click="clear" class="col col-lg-1">
                        <button class="btn btn-light">X</button>
                    </div>
                @endif --}}
                <div class="col-lg-2 col-md-2 col-sm-2">
                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#createTask">Agregar Tarea</button>
                </div>
            </div>
            <div>
                <table wire:poll.10000ms id="mitasks">
                    <div class="row">
                        @foreach ($estados as $estado)
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="card" >
                                    <div class="card-footer">
                                        <h5 class="font-weight-normal text-uppercase"> {{ $estado->description}} </h5>
                                    </div>
                                    <div class="card-body">
                                        @foreach ($tareas as $tarea)
                                            @foreach ($tarea->tasks as $task)
                                                @if ($estado->id == $task->statu_id)
                                                    <div class="fluid" wire:click.prevent="edit({{ $task->id }})" data-toggle="modal" data-target="#updateTask">
                                                        <h5 class="font-italic"> {{ $task->name }} </h5>
                                                        <h6> {{ $task->start }} </h6>
                                                        <h6> {{ $task->end }} </h6>
                                                        <h6> {{ $task->informer }} </h6>
                                                        <h6> {{ $task->responsable}} </h6>
                                                    </div>
                                                    <hr>
                                                @endif
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </table>
            </div>
        </div>
        <div class="card-footer">

        </div>
    </div>


    {{-- <div class="card">
        @foreach ($tareas as $tarea)
            <h5>Tareas :</h5>
            <h4>{{ $tarea->name }}</h4>
            @foreach ($tarea->tasks as $task)
                <h4>{{ $task->name }}</h4>
            @endforeach
            <h5>Usuarios</h5>
            <h4>{{ $tarea->name }}</h4>
            @foreach ($tarea->users as $user)
                <h4>{{ $user->name }}</h4>
            @endforeach
        @endforeach
    </div>

    <div class="form-group">
        <label for="dal">Proyecto</label>
        <h5>{{$proyecto}}</h5>
    </div>
    <div class="form-group">
        <label for="dal">Tareas</label>
        <h5>{{$tareas}}</h5>
    </div> --}}
    @include('custom.message')
    @include('livewire.profile.create')
    @include('livewire.profile.update')
</div>
