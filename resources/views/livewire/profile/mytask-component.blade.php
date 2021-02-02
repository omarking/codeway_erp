<div>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-10">
                    <h4 class="font-weight-normal text-uppercase">{{ $proyecto->name }}</h4>
                </div>
                <div class="col-2">
                    <img src="{{ asset('storage/users/' . $responsable_imagen) }}" width="25%" class="rounded-circle" alt="{{ $responsable_imagen }}">
                    <small>{{ $responsable_proyecto }}</small>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="pb-3">
                <div class="row">
                    <div class="col-lg-6 col-md-4 col-sm-6">
                        <input type="text" class="form-control" placeholder="Búscar entre las tareas" wire:model="search" wire:dirty.class="bg-secondary">
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        @foreach ($pivote as $pivot)
                            <select wire:model="search" class="form-control" wire:dirty.class="bg-secondary" id="searchs">
                                <option value="">Usuarios en este proyectó</option>
                                @foreach ($pivot->users as $user)
                                        <option value="{{ $user->name }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        @endforeach
                    </div>
                    <div wire:click="clear" class="col-lg-1 col-md-2 col-sm-6">
                        @if ($search !== '')
                            <button class="btn btn-dark">Limpiar</button>
                        @endif
                    </div>
                    <div class="col-lg-2 col-md-3 col-sm-6">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createTask">Agregar Tarea</button>
                    </div>
                </div>
            </div>
            <table wire:poll.10000ms id="mitasks">
                <div class="row">
                    @foreach ($estados as $estado)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="card-footer bg-secondary">
                                <h5 class="font-weight-normal text-uppercase"> {{ $estado->description}} </h5>
                            </div>
                            <div class="table-responsive px-1" style="height: 100rem;">
                                @foreach ($tasks as $task)
                                    @isset($task->projects[0]->name)
                                        @if (($task->statu->description == $estado->description) && ($proyecto->name == $task->projects[0]->name))
                                            <div class="border rounded my-3 card-footer">
                                                <div>
                                                    <h6 class="font-weight-normal">{{ $task->name }} </h6>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h6> {{ $task->start }} </h6>
                                                        </div>
                                                        <div class="col-6">
                                                            <h6> {{ $task->end }} </h6>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-7">
                                                            @isset($task->type->description)
                                                                <small>Tipo:</small>
                                                                <small>{{ $task->type->description }}</small>
                                                            @else
                                                                <small>Sin tipo</small>
                                                            @endisset
                                                        </div>
                                                        <div class="col-5">
                                                            @isset($task->priority->description)
                                                                <small>Prioridad:</small>
                                                                <small>{{ $task->priority->description }}</small>
                                                            @else
                                                                <small>Sin prioridad</small>
                                                            @endisset
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            @foreach ($usuarios as $informador)
                                                                @if ($informador->name == $task->informer)
                                                                    <img src="{{ asset('storage/users/' . $informador->profile->avatar) }}" width="20%" class="rounded-circle" alt="{{ $informador->profile->avatar }}">
                                                                    <small> {{ $task->informer}} </small>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                        <div class="col-6">
                                                            @foreach ($usuarios as $responsa)
                                                                @if ($responsa->name == $task->responsable)
                                                                    <img src="{{ asset('storage/users/' . $responsa->profile->avatar) }}" width="20%" class="rounded-circle" alt="{{ $responsa->profile->avatar }}">
                                                                    <small> {{ $task->responsable}} </small>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endisset
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </table>
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
