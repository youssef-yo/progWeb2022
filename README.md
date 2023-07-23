Per il progetto sono stati utilizzati i template di bootstrapmade.com:
- [sito vetrina](https://bootstrapmade.com/demo/Arsha/)
- [sito per la gestione delle attività di prenotazione](https://bootstrapmade.com/demo/NiceAdmin/)
  
## Breve idea
Essenzialmente ci sono 3 tipologie di utenti:
- <b>Visitatore</b>: può visualizzare la pagina web dell'officina dove troverà una breve descrizione dell'azienda, dei servizi offerti e una sezione dedicata ai giorni di apertura e ai recapiti
- <b>Registrato</b>: può aggiungere veicoli di sua proprietà e di prenotare i servizi dell'officina per un particolare veicolo. Inoltre può visualizzare lo storico degli appuntamenti. Se l'utente si è autenticato a Google Calendar, allora gli appuntamenti creati verranno aggiunti anche nel suo account di Google.
- <b>Amministratore</b>: gestire la lista dei servizi offerti, decidere la capacità massima giornaliera per le prenotazioni, gestire le prenotazioni arrivate dagli utenti (terminare la lavorazione aggiungendo eventualmente una nota).

## Google Calendar API
Per poter utilizzare le API in fase di test bisogna creare un progetto in https://console.cloud.google.com/ ed impostare la "Schermata consenso OAuth". 
Aggiornare le variabili nel file .env

## Clonare il progetto
Dopo aver clonato il progetto eseguire i seguenti comandi in ordine:
- composer update
- composer install
- php artisan key:generate

Dovrebbe crearsi il file .env che andrete a modificare per impostare le variabili per la connessione al db e per utilizzare le api di Google.
