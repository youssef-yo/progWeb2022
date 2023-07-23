$(document).ready(function() { 
    // tabella veicoli aggiornata

    function tabellaVeicoliAggiornata() {
        $.ajax({
            url: '/vehicles',
            type: 'GET',
            success: function(response) {
                var tableHtml = $(response.corpo).find('#veicoli-table').html();

                $('#veicoli-table').html(tableHtml);
                
            },
            error: function(xhr) {
                console.log("Errore");
            }
        });
    }
    //setup eventi pagina veicoli 
    function setupEventPageVehicles() {
        // Gestore di eventi per il click sul bottone di eliminazione dei Servizi
        $(document).on('click', '[data-bs-toggle="modal"][data-bs-target="#confirmDeleteModalVehicle"]', function() {
            var veicoloId = $(this).data('bs-id');

            // Assegna l'ID del servizio all'input nascosto nel modal di conferma
            $('#veicolo-id-cancella').val(veicoloId);
        });

        // Gestore di eventi per il click sul pulsante di conferma di eliminazione nel modal Servizi
        $('#confirm_deleteVeicolo').click(function() {
            var veicoloId = $('#veicolo-id-cancella').val();
    
            $.ajax({
                url: '/vehicles/' + veicoloId,
                type: 'DELETE',
                success: function(response) {
                    var table = $.parseHTML(response.table);

                    $('#veicoli-table').find('table').html(table);

                    $('#confirmDeleteModalVehicle').modal('hide');
                    displaySuccessAlert("Veicolo eliminato.");
                },
                error: function(xhr) {
                    $('#confirmDeleteModalVehicle').modal('hide');
                    var errorMessage = xhr.responseJSON.message;
                    displayErrorAlert(errorMessage);
                }
            });
        });

        $('#btnAddVeicolo').click(function() {
            event.preventDefault();
    
            var targa = $('#targa');
            var anno = $('#anno_immatricolazione');
            var km = $('#km');

        
            if (targa.val().trim() === '') {
                targa.addClass('is-invalid'); 
                return;
            } else {
                targa.removeClass('is-invalid');
            }
    
            if (anno.val().trim() === '') {
                anno.addClass('is-invalid'); 
                return;
            } else {
                anno.removeClass('is-invalid');
            }

            if (km.val().trim() === '') {
                km.addClass('is-invalid'); 
                return;
            } else {
                km.removeClass('is-invalid');
            }
    
            if(targa !== "" && anno !== "" && km !== "") {
                $.ajax({
                    url: '/vehicles',
                    method: 'POST',
                    data: {targa: targa.val().trim(), anno: anno.val().trim(), km: km.val().trim()},
                    success: function(response) {
                        var table = $.parseHTML(response.table);
        
                        $('#veicoli-table').find('table').html(table);
    
                        targa.val("");
                        anno.val("");
                        km.val("");

                        displaySuccessAlert("Veicolo aggiunto.");
                    },
                    error: function(xhr, status, error) {    
                        var errorMessage = xhr.responseJSON.message;
                        displayErrorMessage(errorMessage);
                    }
                });
            }
        });

        // Gestione del click sul bottone "modifica"
        $(document).on('click', '#btn_modificaVeicolo', function() {
            var row = $(this).closest('tr');
            var targa = row.find('td:eq(0)').text();
            var anno = row.find('td:eq(1)').text();
            var km = row.find('td:eq(2)').text();
            
            // Creazione degli input per la modifica
            var targaInput = $('<input>').addClass('form-control').attr('type', 'text').val(targa);
            var annoInput = $('<input>').addClass('form-control').attr('type', 'number').val(anno);
            var kmInput = $('<input>').addClass('form-control').attr('type', 'number').attr('min', 0).val(km);

            // Sostituzione delle label con gli input
            row.find('td:eq(0)').html(targaInput);
            row.find('td:eq(1)').html(annoInput);
            row.find('td:eq(2)').html(kmInput);

            // Creazione dei bottoni di conferma e annullamento
            var btnSave = $('<button>').addClass('btn btn-success btn-save').attr('id', 'btn_saveMoficaVehicle').html('<i class="bi bi-check"></i>');
            var btnCancel = $('<button>').addClass('btn btn-danger btn-cancel').html('<i class="bi bi-x"></i>');

            // Creazione del btn-group con i bottoni di conferma e annullamento
            var btnGroup = $('<div>').addClass('btn-group').append(btnSave, btnCancel);

            // Aggiunta del btn-group alla riga
            row.find('td:eq(3)').html(btnGroup);
        });

        // Gestione del click sul bottone di conferma
        $(document).on('click', '#btn_saveMoficaVehicle', function() {
            var row = $(this).closest('tr');
            var veicoloId = row.data('id');
            var targaInput = row.find('input:eq(0)');
            var annoInput = row.find('input:eq(1)');
            var kmInput = row.find('input:eq(2)');
            var targa = targaInput.val();
            var anno = annoInput.val();
            var km = kmInput.val();

            var lunghezzaAnno = anno.toString().length;
            var lunghezzaKm = km.toString().length;

            if (lunghezzaAnno != 4 || km < 0 || lunghezzaKm == 0 || targa.length == 0) {
                displayErrorMessage("Inserisci dei valori validi!");
            } else {
                 // Sostituisci gli input con i nuovi valori dei campi
                row.find('td:eq(0)').text(targa);
                row.find('td:eq(1)').text(anno);
                row.find('td:eq(2)').text(km);

                //Apri modal
                $('#veicolo-id-modifica').val(veicoloId);
                $('#veicolo-targa-modifica').val(targa);
                $('#veicolo-anno-modifica').val(anno);
                $('#veicolo-km-modifica').val(km);

                $('#confirmModificationModalVehicle').modal('show');
                
                // Ripristina il bottone "modifica"
                $('.btn-group').html('<button type="button" class="btn btn-outline-primary btn-edit" id="btn_modificaVeicolo"><i class="bi bi-pencil"></i></button>');
            }
        });

        // Gestione del click sul bottone di annullamento
        $(document).on('click', '.btn-cancel', function() {
            tabellaVeicoliAggiornata();            
        });

        $(document).on('click', '#btn_annullaModifica', function() {
            tabellaVeicoliAggiornata();            
        });

        // Gestore di eventi per il click sul pulsante di conferma di modifica nel modal Servizi
        $('#confirmModificationModalVehicle').on('click', '#confirm_modificaVeicolo', function() {
            var veicoloId = $('#veicolo-id-modifica').val();
            var veicoloTarga = $('#veicolo-targa-modifica').val().trim();
            var veicoloAnno = $('#veicolo-anno-modifica').val().trim();
            var veicoloKm = $('#veicolo-km-modifica').val().trim();

            console.log("")
            $.ajax({
                url: '/vehicles/' + veicoloId,
                type: 'PUT',
                data: {targa: veicoloTarga, anno: veicoloAnno, km: veicoloKm},
                success: function(response) {
                    var table = $.parseHTML(response.table);

                    $('#veicoli-table').find('table').html(table);

                    $('#confirmModificationModalVehicle').modal('hide');
                    displaySuccessAlert("Dati modificati con successo.");
                },
                error: function(xhr) {
                    var errorMessage = xhr.responseJSON.message;
                    displayErrorMessage(errorMessage);
                    $('#confirmModificationModalVehicle').modal('hide');
                }
            });
        });
    }

     // click sul menu laterale "Veicoli"
     $('#veicoli-link').click(function(event) {
        event.preventDefault(); 
        
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            type: 'GET',
            success: function(response) {
                var corpo =  $(response.corpo).find('#main').html();
                $('#main').html(corpo); 

                setupEventPageVehicles();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});