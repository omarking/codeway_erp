<div>
    <div class="card">
        <div class="card-body">
            @foreach ($usuario as $user)
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    @forelse($user->departaments as $departament)
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <label class="text-white text-uppercase" for="name"> Departamento de {{ $departament->name }}</label>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <h4>{{ $departament->description }}</h4>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <div class="d-flex justify-content-end">
                                        <label for="responsable">Resposanble : <small class="text-uppercase">{{ $departament->responsable }}</small></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <label class="text-white text-uppercase" for="nombre"><h4>Aun no eres asignado a un departamento</h4></label>
                            </div>
                            <div class="card-body">
                                <h4>
                                    Parace que no te han asignado un departamento con el que puedas trabajar, es raro que pase esto por lo que te recomiendo que le informes a tu superior.
                                </h4>
                                <h4>
                                    Prueba estas opciones:
                                </h4>
                                <h4>
                                    <li>Cierra sesión y vuelve a entrar</li>
                                    <li>Revisa tu conexión a internet</li>
                                    <li>Verifica que estes en un departamento</li>
                                    <li>Informale a tu superior tu situación</li>
                                </h4>
                            </div>
                            <div class="card-footer">
                                - - - -
                            </div>
                        </div>
                    @endforelse
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    @forelse($user->groups as $group)
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <label class="text-white text-uppercase" for="name">Grupo {{ $group->name }}</label>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="description">Descripción</label>
                                    <h4>{{ $group->description }}</h4>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="form-group">
                                    <div class="d-flex justify-content-end">
                                        <label for="responsable">Resposanble : <small class="text-uppercase">{{ $group->responsable }}</small></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="card">
                            <div class="card-header bg-secondary">
                                <label class="text-white text-uppercase" for="nombre"><h4>Aun no eres asignado a un grupo</h4></label>
                            </div>
                            <div class="card-body">
                                <h4>
                                    Parace que no te han asignado un grupo con el que puedas trabajar, es raro que pase esto por lo que te recomiendo que le informes a tu superior.
                                </h4>
                                <h4>
                                    Prueba estas opciones:
                                </h4>
                                <h4>
                                    <li>Cierra sesión y vuelve a entrar</li>
                                    <li>Revisa tu conexión a internet</li>
                                    <li>Verifica que estes en un departamento</li>
                                    <li>Informale a tu superior tu situación</li>
                                </h4>
                            </div>
                            <div class="card-footer">
                                - - - -
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <hr>
                @forelse($user->projects as $project)
                    <div class="card">
                        <h3 class="text-uppercase text-center">MIS    PROYECTOS</h3>
                        <div class="card-header bg-secondary">
                            <label class="text-white text-uppercase" for="nombre">{{ $project->name }}</label>
                            <a class="btn btn-primary float-right" href="{{ route('project.show', $project) }}">Trabajar en este Proyecto</a>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-7">
                                    <div class="form-group">
                                        <label for="clave">Clave</label>
                                        <h4>{{ $project->key }}</h4>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Descripción</label>
                                        <h4>{{ $project->description }}</h4>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="clase">Clase</label>
                                                @isset($project->clas->description)
                                                    <h4>{{ $project->clas->description }}</h4>
                                                @else
                                                    <h4>Este proyecto no esta asignado a una clase</h4>
                                                @endisset
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="form-group">
                                                <label for="categoria">Categoria</label>
                                                @isset($project->category->description)
                                                    <h4>{{ $project->category->description }}</h4>
                                                @else
                                                    <h4>Este proyecto no esta asignado a una categoria</h4>
                                                @endisset
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="estado">Estado</label>
                                        @if ($project->status == "1")
                                            <h5>Activo</h5>
                                        @else
                                            <h5>Inactivo</h5>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-5">
                                    <img class="img-fluid" src="{{ asset('storage/projects/' . $project->avatar) }}" alt="{{ $project->avatar }}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group">
                                <div class="d-flex justify-content-end">
                                    <label for="responsable">Resposanble : <small class="text-uppercase">{{ $project->responsable }}</small></label>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <label class="text-white text-uppercase" for="nombre"><h4>Aun no eres asignado a un proyecto</h4></label>
                        </div>
                        <div class="card-body">
                            <h4>
                                Parace que no te han asignado un proyecto en el que puedas trabajar, es raro que pase esto por lo que te recomiendo que le informes a tu superior.
                            </h4>
                            <h4>
                                Prueba estas opciones:
                            </h4>
                            <h4>
                                <li>Cierra sesión y vuelve a entrar</li>
                                <li>Revisa tu conexión a internet</li>
                                <li>Verifica que estes en un departamento</li>
                                <li>Informale a tu superior tu situación</li>
                            </h4>
                        </div>
                        <div class="card-footer">
                            - - - -
                        </div>
                    </div>
                @endforelse
            @endforeach
        </div>
    </div>
</div>
