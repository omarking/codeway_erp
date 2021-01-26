<div>
    <div class="row">
        <div class="col lg-8 .col-md-8 .col-sm-4">
            <div class="card">
                <div class="card-header bg-secondary">
                    <h4 class="text-uppercase">
                        @isset($departament->id)
                            Departamento de {{ $departament->name }}
                        @else
                            Aun no eres asignado a un departamento
                        @endisset
                    </h4>
                </div>
                <div class="card-body">
                    @isset($departament->id)
                        <h5> {{ $departament->description }} </h5>
                    @else
                        <h5>Espera a que se te asigne a un departamento, por lo mientras tomate un cafe</h5>
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
            <label class="text-muted text-uppercase">Grupos en este Departamento</label>
            <div>
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
            </div>
        </div>
        <div class="col lg-4 .col-md-4 .col-sm-4">
            <div class="card">
                <div class="card-body">
                    Mensajes
                </div>
            </div>
        </div>
    </div>
</div>
