<div id="appuntamentiCompletati-table">
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Veicolo</th>
            <th scope="col">Servizio</th>
            <th scope="col">Data</th>
            <th scope="col">Note</th>
        </tr>
    </thead>
    <tbody>
        @if(count($appointments_completed) > 0)
            @foreach($appointments_completed as $appointment)
                <tr data-id="{{ $appointment->id }}">
                    <td>{{ $appointment->plate_number }}</td>
                    <td>{{ $appointment->title }}</td>
                    <td>{{ $appointment->date }}</td>
                    <td>{{ $appointment->note }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">Non ci sono appuntamenti in archivio.</td>
            </tr>
        @endif  
    </tbody>
    </table>
</div>