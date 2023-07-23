@extends('administrator.dashboard')

@section('titolo_pagina', 'Clienti')

@section('corpo')
<div class="col-12">
    <div class="card recent-sales overflow-auto">
        <div class="filter">
            <input class="form-control" type="text" id="filter-input" placeholder="Filtra per cognome">
        </div>
        <div class="card-body">
            <h5 class="card-title">Rubbrica Clienti</h5>
            <div id="clients-table">
                <table class="table" id="table_clienti">
                <thead>
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Cognome</th>
                        <th scope="col">Cellulare</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($clients) > 0)
                        @foreach($clients as $client)
                            <tr data-id="{{ $client->id }}">
                                <td>{{ $client->firstname }}</td>
                                <td>{{ $client->lastname }}</td>
                                <td>{{ $client->phone }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3" class="text-center">Nessun cliente registrato.</td>
                        </tr>
                    @endif  
                </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection