@extends('administrator.dashboard')

@section('titolo_pagina', 'Servizi')

@section('corpo')
<div class="col-12">
    <div class="card recent-sales overflow-auto">
        <div class="card-body">
            <h5 class="card-title">Servizi offerti</h5>
            @include('administrator/services_table')
        </div>
    </div>
    <!-- Modal -->
    <div class="modal" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rimuovi servizio</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Verranno eliminati anche tutti gli appuntamenti già completati che fanno riferimento a questo servizio! <br><br>
                Sei sicuro di voler rimuovere il servizio?   
                <input type="hidden" id="servizio-id-cancella">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="confirm-delete">Conferma</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal" id="confirmModificationModal" tabindex="-1" role="dialog" aria-labelledby="confirmModificationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica servizio</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler modificare il servizio?
                <input type="hidden" id="servizio-id-modifica">
                <input type="hidden" id="servizio-titolo-modifica">
                <input type="hidden" id="servizio-descrizione-modifica">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn_annullaModifica">Annulla</button>
                <button type="button" class="btn btn-primary" id="confirm-modifica">Conferma</button>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('corpo_dx')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Aggiungi servizio</h5>
        <form novalidate>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-8 col-form-label"><b>Titolo</b> (max 255 caratteri)</label>
                <div class="col-sm-10 has-validation">
                    <input type="text" class="form-control" id="titolo" maxlength="255" required>
                    <div class="invalid-feedback">
                      Scegli un titolo valido.
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword" class="col-sm-4 col-form-label word-break"><b>Descrizione</b></label>
                <div class="col-sm-10 has-validation">
                    <textarea class="form-control form-control-resize-none" id="descrizione" required></textarea>
                    <div class="invalid-feedback">
                      Scegli una descrizione valida.
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    <button type="submit" class="btn btn-primary" id="btnAddService"><i class="bi bi-plus"></i> Aggiungi</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div id="alert-container"></div>
@endsection