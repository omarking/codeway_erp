<div>
    <div class="card-body">
        <div class="form-group">
            <h6>Descripcion :</h6>
            <input type="text" class="form-control @error('description') is-invalid @enderror"
                wire:model="description" name="description" required
            >
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        @if ($accion == "update")
            <div class="form-group">
                <h6>Estatus :</h6>
                <div class="custom-control custom-radio custom-control-inline @error('status') is-invalid @enderror">
                    <input type="radio" id="statusType1" wire:model="status" name="status" class="custom-control-input" value="1"
                        @if ( $status == "1" )
                            checked
                        @endif
                    >
                    <label class="custom-control-label" for="statusType1">Activo</label>
                </div>
                <div class="custom-control custom-radio custom-control-inline @error('status') is-invalid @enderror">
                    <input type="radio" id="statusType0" wire:model="status" name="status" class="custom-control-input" value="0"
                        @if ( $status == "0" )
                            checked
                        @endif
                    >
                    <label class="custom-control-label" for="statusType0">Inactivo</label>
                    <hr>
                </div>
                @error('status')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        @endif
    </div>
    <div class="card-footer">
        {{-- <button type="button" class="btn btn-primary" wire:click="store">Agregar</button> --}}
        @if ($accion == "store")
            <button wire:click="store" class="btn btn-primary">Agregar</button>
            <button wire:click="clean" class="btn btn-secondary">Limpiar</button>
        @else
            @if ($accion == "update")
                <button wire:click="store" class="btn btn-info">Actualizar</button>
                <button wire:click="clean" class="btn btn-primary">Limpiar</button>
            @endif
        @endif
        <button wire:click="close" class="btn btn-danger">Close</button>
    </div>
</div>
