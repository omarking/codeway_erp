<div wire:ignore.self class="modal fade" id="showEvent" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="showClassModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="showClassModal">MOSTRAR EVENTO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label class="text-muted" for="title">Titulo:</label>
                        <h5>{{ $title }}</h5>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="description">Descripción:</label>
                        <h5>{{ $description }}</h5>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="start">Fecha de inicio:</label>
                        <h5>{{ $start }}</h5>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="end">Fecha de termino:</label>
                        <h5>{{ $end }}</h5>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="color">Color:</label>
                        <h5>{{ $color }}</h5>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="textColor">Color de texto:</label>
                        <h5>{{ $textColor }}</h5>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="estado">Estado:</label>
                        @if ($status == "1")
                            <h5>Activo</h5>
                        @else
                            <h5>Inactivo</h5>
                        @endif
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="created_at">Creado:</label>
                        <h5>{{ $created_at }}</h5>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="updated_at">Actualizado:</label>
                        <h5>{{ $updated_at }}</h5>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="form-group justify-content-start">
                    <div wire:loading wire:loading.class="bg-white">Procesando datos...</div>
                </div>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click.prevent="clean()">Cancelar</button>
                <button type="button" class="btn btn-info" wire:click.prevent="close()">Aceptar</button>
            </div>
        </div>
    </div>
</div>
