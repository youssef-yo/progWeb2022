@extends('layouts.dashboard')

@section('link_logo')
{{ route('client.index') }}
@endsection

@section('home_link')
{{ route('client.index') }}
@endsection

@section('nome_profilo')
{{ session('loggedName') }}
@endsection

@section('titolo_pagina', 'La tua officina di fiducia')

@section('menu_profilo')
<li>
    <a class="dropdown-item d-flex align-items-center" href="{{ route('google.authorize') }}" id="googleCalendar-link">
    <i class="bi bi-calendar2-plus"></i>
    <span>Google Calendar</span>
    </a>
</li>
@endsection

@section('left_navbar')
<li class="nav-item">
    <a class="nav-link " href="{{ route('vehicles') }}" id="veicoli-link">
        <i class="bi bi-car-front"></i>
        <span>Veicoli</span>
    </a>
</li><!-- End Vehicles Nav -->

<li class="nav-item">
    <a class="nav-link " href="{{ route('appointments') }}" id="appuntamenti-link">
        <i class="bi bi-calendar"></i>
        <span>Appuntamenti</span>
    </a>
</li><!-- End Appointments Nav -->
@endsection

@section('corpo')
<div class="col-12">
    <div class="card recent-sales overflow-auto">
        <div class="card-body">
            <h5 class="card-title">Servizi disponibili</h5>
            <div id="servizi-table">
        <table class="table">
            <thead>
                <tr>
                <th scope="col">Titolo</th>
                <th scope="col">Descrizione</th>
                </tr>
            </thead>
            <tbody>
                @foreach($services as $service)
                    <tr>
                        <td>{{ $service->title }}</td>
                        <td>{{ $service->description }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
        </div>
    </div>
</div>

@endsection

@section('corpo_dx')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $garage->denomination }}</h5>
        
        <div class="row mb-3">
            <label class="col-sm-8"><b>Email</b>: {{ $garage->email }}</label>
        </div>
        <div class="row mb-3">
            <label class="col-sm-8"><b>Telefono</b>: {{ $garage->phone }}</label>
        </div>
        <div class="row mb-3">
            <label class="col-sm-8"><b>Luogo</b>: {{ $garage->place }}</label>
        </div>        
    </div>

    <!-- <a href="{{ route('google.authorize') }}" class="btn btn-primary">Google Calendar</a> -->
</div>
@endsection

@section('script', 'vehicles_script.js')
@section('script2', 'appointments_script.js')