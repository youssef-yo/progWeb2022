<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login e Registrazione</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <style>
        body {
            background-color: #4676cf;
        }

        .card {
            margin-top: 100px;
            margin-bottom: 100px;
            padding: 40px;
            border-radius: 5px;
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.1);
        }

        .custom-alert {
            max-width: 300px;
        }
    </style>
</head>
<body>
    <div class="container" id="contenitore">
        <div class="row justify-content-center">
            <div class="col-md-6" id="form">
                @yield('form')
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="{{ url('/') }}/js/auth.js"></script>    
</body>
</html>
