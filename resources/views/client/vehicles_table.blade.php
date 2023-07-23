<div id="veicoli-table">
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Targa</th>
            <th scope="col">Anno immatricolazione</th>
            <th scope="col">Km</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if(count($vehicles) > 0)
            @foreach($vehicles as $vehicle)
                <tr data-id="{{ $vehicle->id }}">
                    <td>{{ $vehicle->plate_number }}</td>
                    <td>{{ $vehicle->registration_year }}</td>
                    <td>{{ $vehicle->mileage }}</td>
                    <td><button type="button" class="btn btn-outline-primary btn-edit" id="btn_modificaVeicolo"><i class="bi bi-pencil"></i></button></td>
                    <td><button type="button" class="btn btn-outline-danger" data-bs-id="{{ $vehicle->id }}" data-bs-toggle="modal" data-bs-target="#confirmDeleteModalVehicle"><i class="bi bi-trash"></i></button></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="5" class="text-center">Ancora nessun veicolo aggiunto.</td>
            </tr>
        @endif 
    </tbody>
    </table>
</div>