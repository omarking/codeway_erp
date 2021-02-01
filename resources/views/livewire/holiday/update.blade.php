<div wire:ignore.self class="modal fade" id="updateHoliday" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="updateHolidayModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success">
                <h5 class="modal-title" id="updateHolidayModal">MODIFICAR VACACIÓN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label class="text-muted" for="days">Días:</label>
                        <input type="numeric" name="days" class="form-control @error('days') is-invalid @enderror"
                                wire:model="days" wire:dirty.class="bg-success">
                        @error('days')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-between mb-auto ">
                        <div class="form-group justify-content-start">
                            <label class="text-muted" for="beginDate">Inicio:</label>
                            <input type="date" name="beginDate" wire:dirty.class="bg-success"
                                class="form-control @error('beginDate') is-invalid @enderror" wire:model="beginDate">
                            @error('beginDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group justify-content-end">
                            <label class="text-muted" for="endDate">Terminó:</label>
                            <input type="date" name="endDate" wire:dirty.class="bg-success"
                                class="form-control @error('endDate') is-invalid @enderror" wire:model="endDate">
                            @error('endDate')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="inProcess">En proceso:</label>
                        <input type="numeric" name="inProcess" class="form-control @error('inProcess') is-invalid @enderror"
                                wire:model="inProcess" wire:dirty.class="bg-success">
                        @error('inProcess')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="taken">Tomadas:</label>
                        <input type="numeric" name="taken" class="form-control @error('taken') is-invalid @enderror"
                                wire:model="taken" wire:dirty.class="bg-success">
                        @error('taken')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="available">Viables:</label>
                        <input type="numeric" name="available" class="form-control @error('available') is-invalid @enderror"
                                wire:model="available" wire:dirty.class="bg-success">
                        @error('available')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="commentable">Comentario:</label>
                        <textarea class="form-control @error('commentable') is-invalid @enderror" name="commentable" wire:model="commentable" wire:dirty.class="bg-success" rows="3"></textarea>
                        @error('commentable')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="responsable">Responsable:</label>
                        <input type="text" name="responsable" wire:dirty.class="bg-success"
                            class="form-control @error('responsable') is-invalid @enderror" wire:model="responsable" disabled>
                        @error('responsable')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="absence_id">Ausencia:</label>
                        <select wire:model="absence_id" class="form-control @error('absence_id') is-invalid @enderror"  name="absence_id" wire:dirty.class="bg-success">
                            <option value="">--Seleccione la ausencia--</option>
                            @foreach($ausencias as $ausencia)
                                <option  value="{{ $ausencia->id }}"
                                    @isset( $ausencia->description )
                                        @if( $ausencia->description )
                                            selected
                                        @endif
                                    @endisset
                                    >
                                    {{ $ausencia->description }}
                                </option>
                            @endforeach
                        </select>
                        @error('absence_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label class="text-muted" for="period_id">Periodo:</label>
                        <select wire:model="period_id" class="form-control @error('period_id') is-invalid @enderror"  name="period_id" wire:dirty.class="bg-success">
                            <option value="">--Seleccione el periodo--</option>
                            @foreach($periodos as $periodo)
                                <option  value="{{ $periodo->id }}"
                                    @isset( $periodo->description )
                                        @if( $periodo->description )
                                            selected
                                        @endif
                                    @endisset
                                    >
                                    {{ $periodo->description }}
                                </option>
                            @endforeach
                        </select>
                        @error('period_id')
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
                <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click.prevent="clean()">Cancelar</button>
                <button type="button" class="btn btn-success" wire:click.prevent="update()">Actualizar Vacación</button>
            </div>
        </div>
    </div>
</div>
