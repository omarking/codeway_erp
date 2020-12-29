<div wire:ignore.self class="modal fade" id="createType" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="createTypeModal" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="createTypeModal">AGREGAR TIPO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">

                        <label class="text-muted" for="description">Descripción:</label>
                        <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
                                wire:model="description" wire:dirty.class="bg-primary">
                        {{-- <span wire:dirty wire:target="description">validando...</span> --}}
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="form-group justify-content-start">
                    <div wire:loading wire:loading.class="bg-white">Procesando datos...</div>
                </div>
                <div class="justify-content-end">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click.prevent="clean()">Cancelar</button>
                    <button type="button" class="btn btn-primary" wire:click.prevent="store()">Agregar Tipo</button>
                </div>
            </div>
        </div>
    </div>
</div>
