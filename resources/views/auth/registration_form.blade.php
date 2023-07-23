@extends('layouts.auth')

@section('form')
<div id="register-card" class="card">
    <div class="card-body">
        <h3 class="card-title text-center">Registrati</h3>
        <form id="registrazione-form" method="post">
            @csrf
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="firstname" placeholder="Inserisci il tuo nome" required>
            </div>
            <div class="form-group">
                <label for="nome">Cognome:</label>
                <input type="text" class="form-control" id="cognome" name="lastname" placeholder="Inserisci il tuo cognome" required>
            </div>
            <div class="form-group">
                <label for="phone">Telefono</label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Inserisci il tuo numero di telefono" required>
            </div>
            <div class="form-group">
                <label for="email_registrazione">Email:</label>
                <input type="email" class="form-control" id="email_registrazione" name="email" placeholder="Inserisci la tua email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Inserisci una password" required>
            </div>

            <div class="form-group">
                <label for="password_confirmation">Conferma password</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Reinserisci la password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block" id="btn_registrati">Registrati</button>
            <hr>
            @if (isset($error))
                <div class="alert alert-danger">
                    <ul>
                            <li>{{ $error }}</li>
                    </ul>
                </div>
            @endif
            
            @if (isset($success))
                <script>
                    showAlert('{{ $success }}', false);
                </script>
            @endif
            
        </form>
        
        <p class="text-center">Hai già un account? <a href="{{ route('user.loginPage') }}" id="login-link">Accedi</a></p>
    </div>
</div>

@endsection