<div>
    <div class="row">
        <div class="col lg-8 .col-md-8 .col-sm-4">
            <div class="card">
                <div class="card-header bg-secondary">
                        <h4 class="text-uppercase">
                            @isset($departament->id)
                                <div wire:click="$emitTo('comment.comment-component', 'veamos')">
                                    Departamento de {{ $departament->name }}
                                </div>
                            @else
                                Aun no eres asignado a un departamento
                            @endisset
                        </h4>
                </div>
                <div class="card-body">
                    @isset($departament->id)
                        <div wire:click.prevent="send({{ $departament->id }})">
                            <h5> {{ $departament->description }} </h5>
                        </div>
                    @else
                        <h5>Espera a que se te asigne un departamento, por lo mientras tomate un café</h5>
                    @endisset
                </div>
                <div class="card-footer">
                    @isset($departament->id)
                        <h6> {{ $departament->responsable }} </h6>
                    @else
                        <h6>- - - - -</h6>
                    @endisset
                </div>
            </div>
            <div class="card">
                <div class="card-header bg-secondary">
                    <h4 class="text-uppercase">
                        @isset($group->id)
                            <div wire:click.prevent="send({{ $group->id }})">
                                Área de {{ $group->name }}
                            </div>
                        @else
                            Aun no eres asignado a una área
                        @endisset
                    </h4>
                </div>
                <div class="card-body">
                    @isset($group->id)
                        <div wire:click.prevent="send({{ $group->id }})">
                            <h5> {{ $group->description }} </h5>
                        </div>
                    @else
                        <h5>Espera a que se te asigne una área, por lo mientras tomate un café</h5>
                    @endisset
                </div>
                <div class="card-footer">
                    @isset($group->id)
                        <h6> {{ $group->responsable }} </h6>
                    @else
                        <h6>- - - - -</h6>
                    @endisset
                </div>
            </div>
            {{-- <div>
                @isset($grupos)
                    @forelse ($grupos->groups as $group)
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-uppercase">{{ $group->name }}</h4>
                            </div>
                            <div class="card-body">
                                <h5>{{ $group->description }}</h5>
                            </div>
                            <div class="card-footer">
                                <h6>{{ $group->responsable }}</h6>
                            </div>
                        </div>
                        <hr>
                    @empty
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title text-uppercase">No hay grupos en este departamento</h4>
                            </div>
                            <div class="card-body">
                                <h5>Se debe de agregar grupos a este departamento para que se puedan visualizar aqui.</h5>
                            </div>
                            <div class="card-footer">
                                <h6>- - - - - -</h6>
                            </div>
                        </div>
                    @endforelse
                @else
                    No hay grupos en este Departamento
                @endisset
            </div> --}}
        </div>
        <div class="col lg-4 .col-md-4 .col-sm-4">
            <div class="card">
                <div wire:poll.100ms class="card-body">
                    Mensajes
                    {{ $component }}
                    @isset($component)
                        @livewire('comment.comment-component', ['component' => $component])
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
