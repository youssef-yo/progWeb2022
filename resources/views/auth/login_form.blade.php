@extends('layouts.auth')

@section('form')
<div id="login-card" class="card">
    <div class="card-body">
        <h3 class="card-title text-center">Accedi</h3>
        <form id="login-form" action="{{ route('user.login') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Inserisci la tua email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Inserisci la tua password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block">Accedi</button>
            <hr>
        </form>
        <p class="text-center">Non hai un account? <a href="{{ route('user.registerPage') }}" id="register-link">Registrati</a></p>
    </div>
</div>
@endsection
