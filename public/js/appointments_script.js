$(document).ready(function() { 
    // tabella veicoli aggiornata

    function tabellaAppuntametiDaCompletareAggiornata() {
        $.ajax({
            url: '/appointments',
            type: 'GET',
            success: function(response) {
                var tableHtml = $(response.corpo).find('#appuntamentiDaCompletare-table').html();

                $('#appuntamentiDaCompletare-table').html(tableHtml);
                
            },
            error: function(xhr) {
                console.log("Errore");
            }
        });
    }

    function tabellaAppuntametiCompletatiAggiornata() {
        $.ajax({
            url: '/appointments',
            type: 'GET',
            success: function(response) {
                var tableHtml = $(response.appuntamenti_completati).find('#appuntamentiCompletati-table').html();

                $('#appuntamentiCompletati-table').html(tableHtml);
                
            },
            error: function(xhr) {
                console.log("Errore");
            }
        });
    }

    // Gestore di eventi per il click sul bottone di eliminazione dei Servizi
    $(document).on('click', '[data-bs-toggle="modal"][data-bs-target="#confirmDeleteModalAppointment"]', function() {
        var appuntamentoId = $(this).data('bs-id');

        // Assegna l'ID del servizio all'input nascosto nel modal di conferma
        $('#appuntamento-id-cancella').val(appuntamentoId);
    });

    // Gestore di eventi per il click sul pulsante di conferma di eliminazione nel modal Servizi
    $(document).on('click', '#confirm_deleteAppointment', function() {
        var appuntamentoId = $('#appuntamento-id-cancella').val();

        $.ajax({
            url: '/appointments/' + appuntamentoId,
            type: 'DELETE',
            success: function(response) {
                var table = $.parseHTML(response.appuntamenti_daCompletare);

                $('#appuntamentiDaCompletare-table').find('table').html(table);

                $('#confirmDeleteModalAppointment').modal('hide');

                displaySuccessAlert(response.success);
            },
            error: function(xhr) {
                displayErrorAlert("C'è qualcosa che non va...");
            }
        });
    });

    $(document).on('click', '#btnAddAppuntamento', function() {
        event.preventDefault();

        var targa = $('#input_veicolo');
        var servizio = $('#input_servizio');
        var data = $('#input_data');

    
        if (targa.val().trim() === '') {
            targa.addClass('is-invalid'); 
            return;
        } else {
            targa.removeClass('is-invalid');
        }

        if (servizio.val().trim() === '') {
            servizio.addClass('is-invalid'); 
            return;
        } else {
            servizio.removeClass('is-invalid');
        }

        if (data.val().trim() === '') {
            data.addClass('is-invalid'); 
            return;
        } else {
            data.removeClass('is-invalid');
        }

        if(targa !== "" && servizio !== "" && data !== "") {
            $.ajax({
                url: '/appointments',
                method: 'POST',
                data: {targa: targa.val().trim(), servizio: servizio.val().trim(), data: data.val().trim()},
                success: function(response) {
                    var table = $.parseHTML(response.appuntamenti_daCompletare);
    
                    $('#appuntamentiDaCompletare-table').find('table').html(table);

                    targa.val("");
                    servizio.val("");
                    data.val("");

                    displaySuccessAlert("Appuntamento aggiunto.");
                },
                error: function(xhr, status, error) {    
                    var errorMessage = xhr.responseJSON.error;
                    var successMessage = xhr.responseJSON.success;
                    var table = xhr.responseJSON.appuntamenti_daCompletare;

                    $('#appuntamentiDaCompletare-table').find('table').html(table);

                    if (successMessage === undefined) {
                        displayErrorAlert(errorMessage);
                    } else {
                        displayWarningAlert(successMessage + " " + errorMessage);
                    }
                }
            });
        }
    });

    // Gestione del click sul bottone "modifica"
    $(document).on('click', '#btn_modificaAppuntamento', function() {
        var row = $(this).closest('tr');
        var targa = row.find('td:eq(0)').text();
        var servizio = row.find('td:eq(1)').text();
        var data = row.find('td:eq(2)').text();
        
        console.log("TARGA, SERVIZIO, DATA: ", targa, servizio, data);

        var veicoloMenuReference = $("#veicoli_disponibili");
        var servizioMenuReference = $("#sevizi_disponibili");

        var servizioInput = $('<div>').attr('id', 'modifica_servizio');
        var targaInput = $('<div>').attr('id', 'modifica_veicolo');
        var dataInput = $('<input>').addClass('form-control').attr('type', 'date').val(data);

        $(targaInput).html(veicoloMenuReference.clone());
        $(servizioInput).html(servizioMenuReference.clone());

        targaInput.find("select").val(targa);
        servizioInput.find("select").val(servizio);
        // Sostituzione delle label con gli input
        row.find('td:eq(0)').html(targaInput);
        row.find('td:eq(1)').html(servizioInput);
        row.find('td:eq(2)').html(dataInput);

        // Creazione dei bottoni di conferma e annullamento
        var btnSave = $('<button>').addClass('btn btn-success btn-save').attr('id', 'btn_saveMoficaAppointment').html('<i class="bi bi-check"></i>');
        var btnCancel = $('<button>').addClass('btn btn-danger btn-cancel').html('<i class="bi bi-x"></i>');

        // Creazione del btn-group con i bottoni di conferma e annullamento
        var btnGroup = $('<div>').addClass('btn-group').append(btnSave, btnCancel);

        // Aggiunta del btn-group alla riga
        row.find('td:eq(3)').html(btnGroup);
    });

    // Gestione del click sul bottone di conferma
    $(document).on('click', '#btn_saveMoficaAppointment', function() {
        var row = $(this).closest('tr');
        var appuntamentoId = row.data('id'); 
        var targaInput = row.find('td:eq(0) #input_veicolo');
        var servizioInput = row.find('td:eq(1) #input_servizio');
        var dataInput = row.find('td:eq(2) input[type="date"]');

        var targa = targaInput.val();
        var servizio = servizioInput.val();
        var data = dataInput.val();

        console.log("appuntamentoID: ", appuntamentoId);
        console.log("Elemento TARGA, SEVIZIO e DATA:", targaInput, servizioInput, dataInput)
        console.log("SAVE-> TARGA, SERVIZIO, DATA: ", targa, servizio, data);

        // Sostituisci gli input con i nuovi valori dei campi
        row.find('td:eq(0)').text(targa);
        row.find('td:eq(1)').text(servizio);
        row.find('td:eq(2)').text(data);

        //Apri modal
        $('#appuntamento-id-modifica').val(appuntamentoId);
        $('#appuntamento-targa-modifica').val(targa);
        $('#appuntamento-servizio-modifica').val(servizio);
        $('#appuntamento-data-modifica').val(data);

        $('#confirmModificationModalAppointment').modal('show');
        
        // Ripristina il bottone "modifica"
        $('.btn-group').html('<button type="button" class="btn btn-outline-primary btn-edit" id="btn_modificaAppuntamento"><i class="bi bi-pencil"></i></button>');
    });

    // Gestione del click sul bottone di annullamento
    $(document).on('click', '.btn-cancel', function() {
        console.log("annulla");
        tabellaAppuntametiDaCompletareAggiornata();            
    });

    $(document).on('click', '#btn_annullaModificaAppointment', function() {
        tabellaAppuntametiDaCompletareAggiornata();            
    });

    // Gestore di eventi per il click sul pulsante di conferma di modifica nel modal Servizi
    $(document).on('click', '#confirm_modificaAppointment', function() {
        var appuntamentoId = $('#appuntamento-id-modifica').val();
        var appuntamentoTarga = $('#appuntamento-targa-modifica').val().trim();
        var appuntamentoServizio = $('#appuntamento-servizio-modifica').val().trim();
        var appuntamentoData = $('#appuntamento-data-modifica').val().trim();
        
        console.log("TARGA, SERVIZIO, DATA: ", appuntamentoTarga, appuntamentoServizio, appuntamentoData);

        $.ajax({
            url: '/appointments/' + appuntamentoId,
            type: 'PUT',
            data: {targa: appuntamentoTarga, servizio: appuntamentoServizio, data: appuntamentoData},
            success: function(response) {
                var table = $.parseHTML(response.appuntamenti_daCompletare);

                $('#appuntamentiDaCompletare-table').find('table').html(table);

                $('#confirmModificationModalAppointment').modal('hide');

                displaySuccessAlert("Dati modificati con successo.");
            },
            error: function(xhr) {
                var successMessage = xhr.responseJSON.success;
                var errorMessage = xhr.responseJSON.error;
                var table = xhr.responseJSON.appuntamenti_daCompletare;

                $('#appuntamentiDaCompletare-table').find('table').html(table);

                if (successMessage === undefined) {
                    displayErrorAlert(errorMessage);
                } else {
                    displayWarningAlert(successMessage + " " + errorMessage);
                }
                
                $('#confirmModificationModalAppointment').modal('hide');
            }
        });
    });

    $(document).on('click', '#sincronizzazione-link', function(event) {
        event.preventDefault(); 

        $.ajax({
            url: '/google-calendar/synchronize',
            type: 'GET',
            success: function(response) {
                displaySuccessAlert(response.message);
            },
            error: function(xhr) {
                var errorMessage = xhr.responseJSON.message;
                displayErrorAlert(errorMessage);
            }
        });
    });
    
     // click sul menu laterale "Appuntamenti"
    $('#appuntamenti-link').click(function(event) {
        event.preventDefault(); 
        
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                var corpo =  $(response.corpo).find('#main').html();
                $('#main').html(corpo); 
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});