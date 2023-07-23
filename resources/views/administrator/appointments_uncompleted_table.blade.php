<div id="appuntamentiDaCompletare-table">
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Cliente</th>
            <th scope="col">Veicolo</th>
            <th scope="col">Servizio</th>
            <th scope="col">Data</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if(count($appointments_uncompleted) > 0)
            @foreach($appointments_uncompleted as $appointment)
                <tr data-id="{{ $appointment->id }}">
                    <td>{{ $appointment->lastname }} {{ $appointment->firstname }}</td>
                    <td>{{ $appointment->plate_number }}</td>
                    <td>{{ $appointment->title }}</td>
                    <td>{{ $appointment->date }}</td>
                    <td><button type="button" class="btn btn-outline-primary btn-edit" data-bs-id="{{ $appointment->id }}" data-bs-toggle="modal" data-bs-target="#confirmCompleteModal" id="btn_concludiAppuntamento"><i class="bi bi-check-lg"></i></button></td>
                </tr>
            @endforeach       
        @else
            <tr>
                <td colspan="5" class="text-center">Non ci sono appuntamenti in archivio.</td>
            </tr>
        @endif
    </tbody>
    </table>
</div>