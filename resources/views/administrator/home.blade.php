@extends('administrator.dashboard')

@php
    use Carbon\Carbon;
@endphp

@section('titolo_pagina', 'Home')

@section('notifiche')
@php
    $todayAppointments = 0;
    $now = now();

    foreach ($appointments as $appointment) {
        $appointmentDate = \Carbon\Carbon::parse($appointment->date);

        if ($appointmentDate->isSameDay($now)) {
            $todayAppointments++;
        }
    }
@endphp

@php
    $totalUncompletedAppointments = 0;

    foreach ($appointments as $appointment) {
        if (!$appointment->completed) {
            $totalUncompletedAppointments++;
        }
    }
@endphp
<li class="nav-item dropdown">

    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
    <i class="bi bi-bell"></i>
    <span class="badge bg-primary badge-number">*</span>
    </a><!-- End Notification Icon -->

    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
        <li class="dropdown-header">
            Situazione degli appuntamenti
        </li>
        <li>
            <hr class="dropdown-divider">
        </li>
        <li class="notification-item">
            <i class="bi bi-exclamation-circle text-warning"></i>
            <div>
            <h4>Oggi</h4>
            <p>{{ $todayAppointments }} da completare</p>
            </div>
        </li>

        <li>
            <hr class="dropdown-divider">
        </li>

        <li class="notification-item">
            <i class="bi bi-info-circle text-primary"></i>
            <div>
            <h4>Totali</h4>
            <p>{{ $totalUncompletedAppointments }} da completare</p>
            </div>
        </li>
    </ul><!-- End Notification Dropdown Items -->

</li><!-- End Notification Nav -->

@endsection

@section('corpo')
<!-- Services Card -->
<div class="col-xxl-4 col-md-6">
    <div class="card info-card services-card">

    <div class="card-body">
        <h5 class="card-title">Servizi offerti</h5>

        <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-cart"></i>
        </div>
        <div class="ps-3">
            <h6>{{ count($services) }}</h6>
        </div>
        </div>
    </div>

    </div>
</div><!-- End Services Card -->

<!-- Appointments Card -->
<div class="col-xxl-4 col-md-6">
    <div class="card info-card appointments-card">

    <div class="card-body">
        <h5 class="card-title">Appuntamenti totali</h5>

        <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-calendar3"></i>
        </div>
        <div class="ps-3">
            <h6>{{ count($appointments) }}</h6>
        </div>
        </div>
    </div>

    </div>
</div><!-- End Appointments Card -->

<!-- Customers Card -->
<div class="col-xxl-4 col-xl-12">

    <div class="card info-card customers-card">

    <div class="card-body">
        <h5 class="card-title">Clienti registrati</h5>

        <div class="d-flex align-items-center">
        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
            <i class="bi bi-people"></i>
        </div>
        <div class="ps-3">
            <h6>{{ count($clients) }}</h6>
        </div>
        </div>

    </div>
    </div>

</div><!-- End Customers Card -->
<div class="card recent-sales overflow-auto">
    <div class="card-body">
        <h5 class="card-title">Dati</h5>
        @include('administrator/garage_table')
    </div>
</div>
@endsection