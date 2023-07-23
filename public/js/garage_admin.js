function tabellaGarageAggiornata() {
    $.ajax({
        url: '/admin',
        type: 'GET',
        success: function(response) {
            var garageTable = $('#garage-table');

            var newTable = $(response).find('#garage-table');

            var html = newTable.html();

            garageTable.html(html);
        },
        error: function(xhr) {
            //
        }
    }); 
}

$(document).ready(function() {
     // Gestione del click sul bottone "modifica"
     $(document).on('click', '#btn_modificaDatiGarage', function() {
        var row = $(this).closest('tr');
        var denominazione = row.find('td:eq(0)').text();
        var email = row.find('td:eq(1)').text();
        var telefono = row.find('td:eq(2)').text();
        var luogo = row.find('td:eq(3)').text();
        var capacità = row.find('td:eq(4)').text();

        var denominazioneInput = $('<input>').addClass('form-control').attr('type', 'text').attr('id', 'denominazioneInput').val(denominazione);
        var emailInput = $('<input>').addClass('form-control').attr('type', 'email').attr('id', 'emailInput').val(email);
        var telefonoInput = $('<input>').addClass('form-control').attr('type', 'text').attr('id', 'telefonoInput').val(telefono);
        var luogoInput = $('<input>').addClass('form-control').attr('type', 'text').attr('id', 'luogoInput').val(luogo);
        var capacitàInput = $('<input>').addClass('form-control').attr('type', 'number').attr('id', 'capacitàInput').val(capacità);

        // Sostituzione delle label con gli input
        row.find('td:eq(0)').html(denominazioneInput);
        row.find('td:eq(1)').html(emailInput);
        row.find('td:eq(2)').html(telefonoInput);
        row.find('td:eq(3)').html(luogoInput);
        row.find('td:eq(4)').html(capacitàInput);

        // Creazione dei bottoni di conferma e annullamento
        var btnSave = $('<button>').addClass('btn btn-success btn-save').attr('id', 'btnSaveGarageData').html('<i class="bi bi-check"></i>');
        var btnCancel = $('<button>').addClass('btn btn-danger btn-cancel').attr('id', 'btnCancelGarageData').html('<i class="bi bi-x"></i>');

        // Creazione del btn-group con i bottoni di conferma e annullamento
        var btnGroup = $('<div>').addClass('btn-group').append(btnSave, btnCancel);

        // Aggiunta del btn-group alla riga
        row.find('td:eq(5)').html(btnGroup);
    });

    $(document).on('click', '#btnCancelGarageData', function() {
        tabellaGarageAggiornata();        
    });

    $(document).on('click', '#btnSaveGarageData', function() {
        var denominazione = $('#denominazioneInput').val();
        var email = $('#emailInput').val();
        var telefono = $('#telefonoInput').val();
        var luogo = $('#luogoInput').val();
        var capacità = $('#capacitàInput').val();

        var lunghezzaDenominazione = denominazione.length;
        var lunghezzaEmail = email.length;
        var lunghezzaTelefono = telefono.length;
        var lunghezzaLuogo = luogo.length;
        var lunghezzaCapacità = capacità.length;

        if(lunghezzaDenominazione === 0 || lunghezzaEmail === 0 || lunghezzaTelefono === 0 || lunghezzaLuogo === 0 || lunghezzaCapacità === 0) {
            displayErrorAlert("Tutti i campi sono obbligatori!");
        } else {
            $('#confirmEditGarage').modal('show');
        }

    });

    $(document).on('click', '#annulla_ModalEditGarage', function() {
        $('#confirmEditGarage').modal('hide');
        tabellaGarageAggiornata();
    });

    $(document).on('click', '#confirm_ModalEditGarage', function() {
        var denominazione = $('#denominazioneInput').val();
        var email = $('#emailInput').val();
        var telefono = $('#telefonoInput').val();
        var luogo = $('#luogoInput').val();
        var capacità = $('#capacitàInput').val();

        $('#confirmEditGarage').modal('hide');

        $.ajax({
            url: '/garage',
            type: 'POST',
            data: {denomination: denominazione, email: email, phone: telefono, place: luogo, daily_capacity: capacità}, 
            success: function(response) {
                var garageTable = $('#garage-table');
    
                var newTable = $(response).find('#garage-table');
    
                var html = newTable.html();
    
                garageTable.html(html);
                displaySuccessAlert("Dati modificati con successo.");
            },
            error: function(xhr) {
                //
            }
        }); 
    });
});