@extends('client.home')

@section('titolo_pagina', 'Appuntamenti')

@section('corpo')
<div class="col-12">
    <div class="card recent-sales overflow-auto">
        <div class="card-body">
            <h5 class="card-title">Appuntamenti in corso</h5>
            @include('client/appointments_uncompleted_table')
        </div>
    </div>

    <div class="card recent-sales overflow-auto">
        <div class="card-body">
            <h5 class="card-title">Appuntamenti completati</h5>
            @include('client/appointments_completed_table')
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="confirmDeleteModalAppointment" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalAppointmentLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rimuovi appuntamento</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler rimuovere l'appuntamento?
                <input type="hidden" id="appuntamento-id-cancella">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="confirm_deleteAppointment">Conferma</button>
            </div>
            </div>
        </div>
    </div>

    <div class="modal" id="confirmModificationModalAppointment" tabindex="-1" role="dialog" aria-labelledby="confirmModificationModalAppointmentLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifica appuntamento</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler modificare l'appuntamento?
                <input type="hidden" id="appuntamento-id-modifica">
                <input type="hidden" id="appuntamento-targa-modifica">
                <input type="hidden" id="appuntamento-data-modifica">
                <input type="hidden" id="appuntamento-servizio-modifica">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="btn_annullaModificaAppointment">Annulla</button>
                <button type="button" class="btn btn-primary" id="confirm_modificaAppointment">Conferma</button>
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('corpo_dx')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Aggiungi appuntamento</h5>
        <form novalidate>
            <div class="row mb-3">
                <label for="inputText" class="col-sm-8 col-form-label"><b>Veicolo</b></label>
                <div class="col-sm-10 has-validation" id="veicoli_disponibili">
                    <select class="form-control" id="input_veicolo">
                        @foreach($vehicles as $vehicle)
                            <option id="{{ $vehicle->id }}">{{ $vehicle->plate_number }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                      Scegli un veicolo valido.
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label word-break"><b>Servizio</b></label>
                <div class="col-sm-10 has-validation" id="sevizi_disponibili">
                    <select class="form-control" id="input_servizio">
                        @foreach($services as $service)
                            <option id="{{ $service->id }}">{{ $service->title }}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback">
                      Scegli un servizio valido.
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-4 col-form-label word-break"><b>Giorno</b></label>
                <div class="col-sm-10 has-validation">

                    <input type="date" class="form-control" id="input_data" min="{{ date('Y-m-d') }}">

                    <div class="invalid-feedback">
                      Scegli un giorno valido.
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10 offset-sm-2">
                    @if(count($vehicles) > 0 && count($services) > 0)
                        <button type="submit" class="btn btn-primary" id="btnAddAppuntamento"><i class="bi bi-plus"></i> Aggiungi</button>
                    @else
                        <button type="submit" class="btn btn-primary" id="btnAddAppuntamento" disabled><i class="bi bi-plus"></i> Aggiungi</button>
                    @endif    
                </div>
            </div>
        </form>
        
    </div>
    
</div>
<div id="alert-container"></div>

<div class="card">
    <div class="card-body">
        <h5 class="card-title">Google Calendar</h5>
        <div style="text-align: center;">
            <a href="{{ route('google.synchronize') }}" class="btn btn-primary" id="sincronizzazione-link"><i class="bi bi-arrow-repeat"> Sincronizza</i></a>
        </div>       
    </div>
</div>
@endsection