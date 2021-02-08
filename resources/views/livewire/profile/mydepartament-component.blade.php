<div>
    <div class="card" style="height: 100%;">
        <div class="card-header bg-secondary">
            <div class="row">
                <div class="col-6">
                    <h4 class="font-weight-normal text-uppercase">{{$departamento}}</h4>
                </div>
                <div class="col-6">
                    <h6 class="justify-content-end">{{$descripcion}}</h6>
                </div>
            </div>
        </div>
        <div wire:poll.1000ms class="table-responsive px-1" style="height: 25rem;">
            <div class="card-body">
                @foreach ($comentarios as $comentario)
                <div class="row">
                    @if ($comentario->user_id == $yo->id)
                        <div class="col-1 text-center">
                            <img src="{{ asset('storage/users/' . $yo->profile->avatar) }}" width="80%" alt="{{ $yo->profile->avatar }}"><br>
                        </div>
                        <div class="col 11 border border-primary rounded-pill my-1 card-footer">
                            <p class="font-weight-normal text-monospace">
                                {{ $yo->name }} : {{ $comentario->body }}
                                <small class="d-flex justify-content-end">{{$comentario->created_at->diffForHumans()}}</small>
                            </p>
                        </div>
                    @else
                        <div class="col-11 border border-success rounded-pill my-1 card-footer">
                            @foreach ($otros as $otro)
                                @if ($comentario->user_id == $otro->id)
                                    <p class="font-weight-normal text-monospace">
                                        {{ $otro->name }} : {{ $comentario->body }}
                                        <small class="d-flex justify-content-end">{{$comentario->created_at->diffForHumans()}}</small>
                                    </p>
                                @endif
                            @endforeach
                        </div>
                        <div class="col-1 text-center">
                            @foreach ($otros as $otro)
                                @if ($comentario->user_id == $otro->id)
                                    <img src="{{ asset('storage/users/' . $otro->profile->avatar) }}" width="80%" alt="{{ $otro->profile->avatar }}"><br>
                                @endif
                            @endforeach
                        </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        <div class="card-footer">
            <div class="row">
                <div class="col-2">
                    <img src="{{ asset('storage/users/' . $usuario->profile->avatar) }}" width="35%" class="rounded-circle" alt="{{ $usuario->profile->avatar }}">
                </div>
                <div class="col-8">
                    <textarea class="form-control rounded-pill" name="message" wire:model="message" wire:dirty.class="bg-primary" rows="1" autofocus></textarea>
                </div>
                <div class="col-2">
                    <button type="button" wire:click.prevent="send()" class="btn btn-primary float-end btn-block" >Enviar</button>
                </div>
            </div>
        </div>
    </div>
</div>
