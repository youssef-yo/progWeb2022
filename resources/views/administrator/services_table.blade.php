<div id="servizi-table">
    <table class="table">
    <thead>
        <tr>
            <th scope="col">Titolo</th>
            <th scope="col">Descrizione</th>
            <th></th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if(count($services) > 0)
            @foreach($services as $service)
                <tr data-id="{{ $service->id }}">
                    <td>{{ $service->title }}</td>
                    <td>{{ $service->description }}</td>
                    <td><button type="button" class="btn btn-outline-primary btn-edit" id="btn_modificaServizio"><i class="bi bi-pencil"></i></button></td>
                    <td><button type="button" class="btn btn-outline-danger" data-bs-id="{{ $service->id }}" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"><i class="bi bi-trash"></i></button></td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4" class="text-center">Ancora nessun servizio aggiunto.</td>
            </tr>
        @endif
    </tbody>
    </table>
</div>