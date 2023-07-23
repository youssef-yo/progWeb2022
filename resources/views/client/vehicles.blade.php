@extends('client.home')

@section('titolo_pagina', 'Garage')

@section('corpo')
<div class="col-12">
    <div class="card recent-sales overflow-auto">
        <div class="card-body">
            <h5 class="card-title">Veicoli</h5>
            @include('client/vehicles_table')
        </div>
    </div>
    <!-- Modal -->
    <div class="modal" id="confirmDeleteModalVehicle" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalVehicleLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rimuovi veicolo</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Verranno eliminati anche tutti gli appuntamenti completati associati a questo veicolo! <br><br>
                Sei sicuro di voler rimuovere il veicolo?
                <input type="hidden" id="veicolo-id-cancella">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="confirm_deleteVeicolo">Conferma</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal" id="confirmModificationModalVehicle" tabindex="-1" role="dialog" aria-labelledby="confirmModificationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica veicolo</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler modificare i dati del veicolo?
                <input type="hidden" id="veicolo-id-modifica">
                <input type="hidden" id="veicolo-targa-modifica">
                <input type="hidden" id="veicolo-anno-modifica">
                <input type="hidden" id="veicolo-km-modifica">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn_annullaModifica">Annulla</button>
                <button type="button" class="btn btn-primary" id="confirm_modificaVeicolo">Conferma</button>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('corpo_dx')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Aggiungi veicolo</h5>
        <form novalidate>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-8 col-form-label"><b>Targa</b></label>
                <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control" id="targa" required>
                    <div class="invalid-feedback">
                      Scegli una targa valida.
                    </div>
                </div>
            </div>
            <div class="row">
                <label class="col col-form-label"><b>Anno immatricolazione</b></label>
                <div class="col-sm-10 has-validation">
                    <input type="number" min="0" max="4" class="form-control" id="anno_immatricolazione" required>
                    <div class="invalid-feedback">
                      Scegli un anno valido.
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label word-break"><b>Km</b></label>
                <div class="col-sm-10 has-validation">
                    <input type="number" min="0" class="form-control" id="km" required>
                    <div class="invalid-feedback">
                      Scegli un valore valido.
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary" id="btnAddVeicolo"><i class="bi bi-plus"></i> Aggiungi</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="alert-container"></div>
@endsection