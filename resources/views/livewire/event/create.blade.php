<div wire:ignore.self class="modal fade" id="createEvent" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="createClassModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title" id="createClassModal">AGREGAR EVENTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label class="text-muted" for="title">Titulo:</label>
                        <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                wire:model="title" wire:dirty.class="bg-primary">
                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="description">Descripción:</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" wire:model="description" wire:dirty.class="bg-primary" rows="3"></textarea>
                        @error('description')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between mb-auto ">
                        <div class="form-group justify-content-start">
                            <label class="text-muted" for="start">Inicio:</label>
                            <input type="date" name="start" class="form-control @error('start') is-invalid @enderror"
                                    wire:model="start" wire:dirty.class="bg-primary">
                            @error('start')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group justify-content-end">
                            <label class="text-muted" for="end">Fin:</label>
                            <input type="date" name="end" class="form-control @error('end') is-invalid @enderror"
                                    wire:model="end" wire:dirty.class="bg-primary">
                            @error('end')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="color">Color:</label>
                        <input type="text" name="color" class="form-control @error('color') is-invalid @enderror"
                                wire:model="color" wire:dirty.class="bg-primary">
                        @error('color')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="textColor">Color de texto:</label>
                        <input type="text" name="textColor" class="form-control @error('textColor') is-invalid @enderror"
                                wire:model="textColor" wire:dirty.class="bg-primary">
                        @error('textColor')
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
                    <button type="button" class="btn btn-primary" wire:click.prevent="store()">Agregar Evento</button>
                </div>
            </div>
        </div>
    </div>
</div>
