<div id="garage-table">
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Denominazione</th>
            <th scope="col">Email</th>
            <th scope="col">Telefono</th>
            <th scope="col">Luogo</th>
            <th scope="col">Capacità giornaliera</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <tr data-id="{{ $garage->id }}">
            <td>{{ $garage->denomination }}</td>
            <td>{{ $garage->email }}</td>
            <td>{{ $garage->phone }}</td>
            <td>{{ $garage->place }}</td>
            <td>{{ $garage->daily_capacity }}</td>
            <td><button type="button" class="btn btn-outline-primary btn-edit" id="btn_modificaDatiGarage"><i class="bi bi-pencil"></i></button></td>
        </tr>   
    </tbody>
    </table>
</div>

<!-- Modal -->
<div class="modal" id="confirmEditGarage" tabindex="-1" role="dialog" aria-labelledby="confirmEditGarage" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Modifica dati officina</h5>
            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            Sei sicuro di voler aggiornare i dati dell'officina?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="annulla_ModalEditGarage">Annulla</button>
            <button type="button" class="btn btn-primary" id="confirm_ModalEditGarage">Conferma</button>
        </div>
        </div>
    </div>
</div>