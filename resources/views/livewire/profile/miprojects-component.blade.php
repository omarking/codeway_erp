<div>
    <div class="card">
        <div class="card-body">
            @foreach ($usuario as $user)
                @forelse($user->projects as $project)
                    <div class="card">
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
                            <label class="text-white text-uppercase" for="nombre">No tienes proyectos</label>
                        </div>
                        <div class="card-body">
                            <h4>
                                Aun no tienes proyectos en los que puedas trabajar
                            </h4>
                            <h4>
                                Por el momento puedes comunicarte con tu superior para que se te asigne uno o te integres a un equipo
                            </h4>
                        </div>
                        <div class="card-footer">

                        </div>
                    </div>
                @endforelse
            @endforeach
        </div>
    </div>
</div>
