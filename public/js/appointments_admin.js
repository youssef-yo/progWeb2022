$(document).ready(function() { 
    // tabella veicoli aggiornata

    function tabellaAppuntametiDaCompletareAggiornata() {
        $.ajax({
            url: '/admin/appointments',
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
            url: '/admin/appointments',
            type: 'GET',
            success: function(response) {
                var tableHtml = $(response.corpo).find('#appuntamentiCompletati-table').html();

                $('#appuntamentiCompletati-table').html(tableHtml);
                
            },
            error: function(xhr) {
                console.log("Errore");
            }
        });
    }

    //setup eventi pagina veicoli 
    function setupEventPageAppointments() {

        $(document).on('click', '#btn_concludiAppuntamento', function() {
            var appuntamentoId = $(this).data('bs-id');
            console.log("ID appuntamento: ", appuntamentoId);

            $('#appuntamento-id-completa').val(appuntamentoId);
            $('#confirmCompleteModal').modal('show');
        });

        $(document).on('click', '#annulla_ModalAppuntamentoFinito', function() {
            tabellaAppuntametiDaCompletareAggiornata();            
        });

        $(document).on('click', '#confirm-appuntamento', function() {
            var appuntamentoId = $('#appuntamento-id-completa').val();
            var nota = $('#nota').val().trim();
            console.log("ID appuntamento, Nota: ", appuntamentoId, nota);

            $.ajax({
                url: 'admin/appointments/' + appuntamentoId,
                type: 'GET',
                data: {note: nota},
                success: function(response) {
                    tabellaAppuntametiDaCompletareAggiornata();
                    tabellaAppuntametiCompletatiAggiornata();

                    $('#confirmCompleteModal').modal('hide');
                    displaySuccessAlert("Appuntamento completato.");
                },
                error: function(xhr) {
                    var errorMessage = xhr.responseJSON.message;
                    displayErrorAlert(errorMessage);
                    $('#confirmCompleteModal').modal('hide');
                }
            });
        });
    }

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

                setupEventPageAppointments();
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});