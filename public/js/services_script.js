$(document).ready(function() {
    // Funzione per inizializzare il filtro della tabella clienti
    function initClientTableFilter() {
        $('#filter-input').on('input', function() {
            var value = $(this).val().toLowerCase();
            $('#table_clienti tbody tr').filter(function() { 
                var customer = $(this).find('td:nth-child(2)').text().toLowerCase(); 
                $(this).toggle(customer.indexOf(value) > -1); // Nascondi o mostra la riga in base al testo filtrato
            });
        });
    }

    function setupEventPageServices() {
        // Gestore di eventi per il click sul bottone di eliminazione dei Servizi
        $(document).on('click', '[data-bs-toggle="modal"][data-bs-target="#confirmDeleteModal"]', function() {
            var servizioId = $(this).data('bs-id');

            // Assegna l'ID del servizio all'input nascosto nel modal di conferma
            $('#servizio-id-cancella').val(servizioId);
        });

        // Gestore di eventi per il click sul pulsante di conferma di eliminazione nel modal Servizi
        $('#confirm-delete').click(function() {
            var servizioId = $('#servizio-id-cancella').val();
    
            $.ajax({
                url: '/services/' + servizioId,
                type: 'DELETE',
                success: function(response) {
                    var table = $.parseHTML(response.table);

                    $('#servizi-table').find('table').html(table);

                    $('#confirmDeleteModal').modal('hide');
                    displaySuccessAlert("Servizio eliminato.");
                },
                error: function(xhr) {
                    $('#confirmDeleteModal').modal('hide');
                    var errorMessage = xhr.responseJSON.message;
                    displayErrorAlert(errorMessage);
                }
            });
        });

        $('#btnAddService').click(function() {
            event.preventDefault();
    
            var titolo = $('#titolo');
            var descrizione = $('#descrizione');
        
            if (titolo.val().trim() === '') {
                titolo.addClass('is-invalid'); // Aggiungi classe CSS per indicare un campo non valido
                return;
            } else {
                titolo.removeClass('is-invalid'); // Rimuovi classe CSS per campo non valido
            }
    
            if (descrizione.val().trim() === '') {
                descrizione.addClass('is-invalid'); // Aggiungi classe CSS per indicare un campo non valido
                return;
            } else {
                descrizione.removeClass('is-invalid'); // Rimuovi classe CSS per campo non valido
            }
    
            if(titolo !== "" && descrizione !== "") {
                $.ajax({
                    url: '/services',
                    method: 'POST',
                    data: {title: titolo.val().trim(), description: descrizione.val().trim()},
                    success: function(response) {
                        var table = $.parseHTML(response.table);
        
                        $('#servizi-table').find('table').html(table);
    
                        titolo.val("");
                        descrizione.val("");

                        displaySuccessAlert("Servizio aggiunto.");
                    },
                    error: function(xhr, status, error) {    
                        var errorMessage = xhr.responseJSON.message;
                        displayErrorMessage(errorMessage);
                    }
                });
            }
        });

        // Gestione del click sul bottone "modifica"
        $(document).on('click', '#btn_modificaServizio', function() {
            var row = $(this).closest('tr');
            var titolo = row.find('td:eq(0)').text();
            var descrizione = row.find('td:eq(1)').text();

            // Creazione degli input per la modifica
            var titoloInput = $('<input>').addClass('form-control').attr('type', 'text').attr('maxlength', 255).attr('id', 'titolo-input').val(titolo);
            var descrizioneInput = $('<textarea>').addClass('form-control').attr('id', 'descrizione-input').val(descrizione);

            // Sostituzione delle label con gli input
            row.find('td:eq(0)').html(titoloInput);
            row.find('td:eq(1)').html(descrizioneInput);

            // Creazione dei bottoni di conferma e annullamento
            var btnSave = $('<button>').addClass('btn btn-success btn-save').attr('id', 'btn_saveMoficaService').html('<i class="bi bi-check"></i>');
            var btnCancel = $('<button>').addClass('btn btn-danger btn-cancel').attr('id', 'btn_CancelModifica').html('<i class="bi bi-x"></i>');

            // Creazione del btn-group con i bottoni di conferma e annullamento
            var btnGroup = $('<div>').addClass('btn-group').append(btnSave, btnCancel);

            // Aggiunta del btn-group alla riga
            row.find('td:eq(2)').html(btnGroup);
        });

        // Gestione del click sul bottone di conferma
        $(document).on('click', '#btn_saveMoficaService', function() {
            var row = $(this).closest('tr');
            var servizioId = row.data('id');
            var titoloInput = row.find('#titolo-input');
            var descrizioneInput = row.find('#descrizione-input');
            var titolo = titoloInput.val();
            var descrizione = descrizioneInput.val();

            console.log("Titotlo, descrizione", titolo, descrizione);

            if (titolo.length == 0 || descrizione.length == 0 ){
                displayErrorMessage("Compila tutti i campi richiesti.");
            } else {
                // Sostituisci gli input con i nuovi valori dei campi
                row.find('td:eq(0)').text(titolo);
                row.find('td:eq(1)').text(descrizione);

                //Apri modal
                $('#servizio-id-modifica').val(servizioId);
                $('#servizio-titolo-modifica').val(titolo);
                $('#servizio-descrizione-modifica').val(descrizione);

                $('#confirmModificationModal').modal('show');
                
                // Ripristina il bottone "modifica"
                row.find('.btn-group').html('<button type="button" class="btn btn-outline-primary btn-edit" id="btn_modificaServizio"><i class="bi bi-pencil"></i></button>');
            }
        });

        // Gestione del click sul bottone di annullamento del Modal
        $(document).on('click', '#btn_annullaModifica', function() {
            //TODO: chiede al back-end la lista aggiornata
            $.ajax({
                url: '/services',
                type: 'GET',
                success: function(response) {
                    var tableHtml = $(response.corpo).find('#servizi-table').html();

                    $('#servizi-table').html(tableHtml);
                },
                error: function(xhr) {
                    //
                }
            });
        });

        // Gestione del click sul bottone di annullamento del btn-group
        $(document).on('click', '#btn_CancelModifica', function() {
            //TODO: chiede al back-end la lista aggiornata
            $.ajax({
                url: '/services',
                type: 'GET',
                success: function(response) {
                    var tableHtml = $(response.corpo).find('#servizi-table').html();

                    $('#servizi-table').html(tableHtml);
                },
                error: function(xhr) {
                    //
                }
            });
        });

        // Gestore di eventi per il click sul pulsante di conferma di modifica nel modal Servizi
        $('#confirmModificationModal').on('click', '#confirm-modifica', function() {
            var servizioId = $('#servizio-id-modifica').val();
            var servizioTitolo = $('#servizio-titolo-modifica').val().trim();
            var servizioDescrizione = $('#servizio-descrizione-modifica').val().trim();
            
            $.ajax({
                url: '/services/' + servizioId,
                type: 'PUT',
                data: {title: servizioTitolo, description: servizioDescrizione},
                success: function(response) {
                    var table = $.parseHTML(response.table);

                    $('#servizi-table').find('table').html(table);

                    $('#confirmModificationModal').modal('hide');

                    displaySuccessAlert("Dati modificati con successo");
                },
                error: function(xhr) {
                    var errorMessage = xhr.responseJSON.message;
                    displayErrorMessage(errorMessage);
                    $('#confirmModificationModal').modal('hide');
                }
            });
        });
    }
    
    // click sul menu laterale "Clienti"
    $('#clienti-link').click(function(event) {
        event.preventDefault(); 
        
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                var corpo =  $(response.corpo).find('#main').html();
                $('#main').html(corpo);

                initClientTableFilter();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });

    // click sul menu laterale "Servizi"
    $('#servizi-link').click(function(event) {
        event.preventDefault(); 
        
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                var corpo =  $(response.corpo).find('#main').html();
                $('#main').html(corpo); 

                setupEventPageServices();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});