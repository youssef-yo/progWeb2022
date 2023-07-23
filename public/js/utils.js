function displayErrorMessage(errorMessage) {
    var alertDiv = $('<div>').addClass('alert alert-danger alert-dismissible fade show').attr('role', 'alert');
    var icon = $('<i>').addClass('bi bi-exclamation-octagon me-1');
    var messageText = $('<span>').text(errorMessage);
    var closeBtn = $('<button>').addClass('btn-close').attr('data-bs-dismiss', 'alert').attr('aria-label', 'Close');
  
    alertDiv.append(icon, messageText, closeBtn);
    $('#alert-container').append(alertDiv);
  
    setTimeout(function() {
      alertDiv.alert('close');
    }, 4000);
}

function displayErrorAlert(msg) {
    // Crea un elemento alert con le classi di Bootstrap
    var alert = document.createElement('div');
    alert.className = 'alert alert-danger alert-dismissible fixed-bottom fixed-right m-3 custom-alert';
    // alert.className = 'alert alert-success alert-dismissible fade show alert-bottom-right custom-alert';

    alert.innerHTML = msg;

    // Aggiungi l'alert al body del documento
    document.body.appendChild(alert);

    setTimeout(function() {
      alert.remove();
    }, 4000);
}

function displaySuccessAlert(msg) {
    // Crea un elemento alert con le classi di Bootstrap
    var alert = document.createElement('div');
    alert.className = 'alert alert-success alert-dismissible fixed-bottom fixed-right m-3 custom-alert';
    // alert.className = 'alert alert-success alert-dismissible fade show alert-bottom-right custom-alert';

    alert.innerHTML = msg;

    // Aggiungi l'alert al body del documento
    document.body.appendChild(alert);

    setTimeout(function() {
      alert.remove();
    }, 4000);
}

function displayWarningAlert(msg) {
  var alert = document.createElement('div');
  alert.className = 'alert alert-warning alert-dismissible fixed-bottom fixed-right m-3 custom-alert';

  alert.innerHTML = msg;

  document.body.appendChild(alert);

  setTimeout(function() {
    alert.remove();
  }, 3000);
}

$(document).ready(function() {
    var csrfToken = $('meta[name="csrf-token"]').attr('content');

    // Imposta il token CSRF nell'header di tutte le richieste AJAX
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': csrfToken
        }
    });
});