@extends('layouts.dashboard')

@section('link_logo')
{{ route('admin.index') }}
@endsection

@section('home_link')
{{ route('admin.index') }}
@endsection

<!-- TODO -->
@section('nome_profilo')
{{ $garage->denomination }}
@endsection

@section('left_navbar')
<li class="nav-item">
    <a class="nav-link " href="{{ route('clients') }}" id="clienti-link">
        <i class="bi bi-car-front"></i>
        <span>Clienti</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link " href="{{ route('admin.appointments') }}" id="appuntamenti-link">
        <i class="bi bi-calendar"></i>
        <span>Appuntamenti</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link " href="{{ route('services') }}" id="servizi-link">
        <i class="bi bi-tools"></i>
        <span>Servizi</span>
    </a>
</li><!-- End Services Nav -->
@endsection

@section('script', 'services_script.js')
@section('script2', 'appointments_admin.js')
@section('script3', 'garage_admin.js')