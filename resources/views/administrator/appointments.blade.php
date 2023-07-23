@extends('administrator.dashboard')

@section('titolo_pagina', 'Appuntamenti')

@section('corpo')
<div class="col-12">
    <div class="card recent-sales overflow-auto">
        <div class="card-body">
            <h5 class="card-title">Appuntamenti in corso</h5>
            @include('administrator/appointments_uncompleted_table')
        </div>
    </div>

    <div class="card recent-sales overflow-auto">
        <div class="card-body">
            <h5 class="card-title">Appuntamenti completati</h5>
            @include('administrator/appointments_completed_table')
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="confirmCompleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmCompleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Completa appuntamento</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler completare l'appuntamento?
                <label class="col-sm-8 col-form-label"><b>Aggiungi una nota</b>
                <textarea class="form-control form-control-resize-none" id="nota"></textarea>

                <input type="hidden" id="appuntamento-id-completa">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="annulla_ModalAppuntamentoFinito">Annulla</button>
                <button type="button" class="btn btn-primary" id="confirm-appuntamento">Conferma</button>
            </div>
            </div>
        </div>
    </div>

</div>
@endsection

@section('corpo_dx')
<div id="alert-container"></div>
@endsection