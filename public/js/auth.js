$(document).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Imposta il token CSRF nell'header di tutte le richieste AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });

    $(document).on('click', '#register-link', function() {
        event.preventDefault();
        $.ajax({
            url: '/user/register',
            type: 'GET',
            success: function(response) {
                $('.alert.alert-danger').remove();
                $('.alert.alert-success').remove();
                var formHtml = $(response.corpo).find('#form').html();
                $('#form').html(formHtml);
            },
            error: function(xhr) {
                console.log("Errore");
            }
        });
    });

    $(document).on('submit', '#registrazione-form', function() {

        event.preventDefault();
        console.log("OKKKK");
        $('.alert.alert-danger').remove();
        $('.alert.alert-success').remove();

        var form = $(this); 
        var formData = form.serialize();

        console.log(formData);

        $.ajax({
            type: 'POST',
            url: '/user/register',
            data: formData,
            success: function(response) {
                $('.alert.alert-danger').remove();
                $('.alert.alert-success').remove();
                var formHtml = $(response.corpo).find('#form').html();
                console.log(formHtml);
                $('#form').html(formHtml);
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

function showAlert(msg, type_error) {
    var alert = document.createElement('div');

    if (type_error) {
        alert.className = 'alert alert-danger fixed-bottom fixed-right m-3 custom-alert';
    } else {
        alert.className = 'alert alert-success fixed-bottom fixed-right m-3 custom-alert';
    }

    // alert.className = 'alert alert-success alert-dismissible fade show alert-bottom-right custom-alert';

    alert.innerHTML = msg;

    // Aggiungi l'alert al body del documento
    document.body.appendChild(alert);

    // Rimuovi l'alert dopo 2 secondi
    setTimeout(function() {
      alert.remove();
    }, 2500);
}