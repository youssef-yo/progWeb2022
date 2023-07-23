<?php

namespace App\Http\Controllers;

use App\Services\GoogleCalendarService;
use App\Models\DataLayer;

use Google_Service_Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

use Google_Service_Calendar_EventDateTime;
use Google_Client;
use Google_Service_Calendar;
use Google_Service_Calendar_Event;

class GoogleCalendarController extends Controller
{
    protected $googleCalendarService;

    public function __construct(GoogleCalendarService $googleCalendarService)
    {
        $this->googleCalendarService = $googleCalendarService;
    }

    public function googleAuthorize()
    {
        $authUrl = $this->googleCalendarService->getClient()->createAuthUrl();
        return redirect()->away($authUrl);
    }

    public function callback(Request $request)
    {
        $dl = new DataLayer();
        $id_client = $dl->getIdClientByEmail(Session::get('loggedEmail'));

        $code = $request->get('code');
        $accessToken = $this->googleCalendarService->getClient()->fetchAccessTokenWithAuthCode($code);

        $dl->saveAccessTokenOfClient($id_client, $accessToken);

        // Ottenere il calendarId dell'utente
        $calendarId = $this->getCalendarId($accessToken);

        // Salva $calendarId nel tuo database per l'utente corrente
        // In questo modo, puoi associare il calendario dell'utente al tuo sistema

        // Puoi anche salvare altre informazioni utili nel tuo database, come l'ID dell'utente nel tuo sistema

        // Reindirizza l'utente alla pagina desiderata dopo l'autenticazione
        return redirect()->route('client.index');
    }

    private function getCalendarId($accessToken)
    {
        //dd($accessToken);
        $this->googleCalendarService->getClient()->setAccessToken($accessToken);
        $service = new \Google_Service_Calendar($this->googleCalendarService->getClient());
        $calendarList = $service->calendarList->listCalendarList();
        $primaryCalendar = $calendarList->getItems()[0];
        $calendarId = $primaryCalendar->getId();

        //dd($calendarId);
        return $calendarId;
    }

    public function addEvent($id_client, $eventSummary, $eventDescription, $date)
    {
        $dl = new DataLayer();
        // Crea un'istanza del client Google_Client
        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));

        // Ottieni il token di accesso dell'utente autenticato
        $accessToken = $dl->getAccessTokenOfClient($id_client);

        // Imposta il token di accesso sul client
        $client->setAccessToken($accessToken);

        if ($client->isAccessTokenExpired()) {
            // Se il token di accesso è scaduto, ottieni un nuovo token di accesso utilizzando il token di aggiornamento
            $refreshToken = $client->getRefreshToken();
            $client->fetchAccessTokenWithRefreshToken($refreshToken);

            // Aggiorna il token di accesso nel tuo database
            $newAccessToken = $client->getAccessToken();
            $dl->saveAccessTokenOfClient($id_client, $newAccessToken);
        }

        // Crea un'istanza del servizio Google Calendar
        $service = new Google_Service_Calendar($client);

        // Crea un nuovo oggetto Google_Service_Calendar_Event per rappresentare l'appuntamento
        $event = new Google_Service_Calendar_Event();
        $event->setSummary($eventSummary);
        $event->setDescription($eventDescription);

        // Imposta la data dell'appuntamento
        $start = new Google_Service_Calendar_EventDateTime();
        $start->setDate($date);
        $event->setStart($start);
        $end = new Google_Service_Calendar_EventDateTime();
        $end->setDate($date);
        $event->setEnd($end);

        // Aggiungi l'evento al calendario dell'utente
        $calendarId = 'primary'; // ID del calendario (puoi utilizzare 'primary' per il calendario principale dell'utente)
        $event = $service->events->insert($calendarId, $event);

        return $event->id;
    }

    public function deleteEvent($id_client, $eventId) {
        $dl = new DataLayer();
        // Crea un'istanza del client Google_Client
        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));

        // Ottieni il token di accesso dell'utente autenticato
        $accessToken = $dl->getAccessTokenOfClient($id_client);

        // Imposta il token di accesso sul client
        $client->setAccessToken($accessToken);

        if ($client->isAccessTokenExpired()) {
            // Se il token di accesso è scaduto, ottieni un nuovo token di accesso utilizzando il token di aggiornamento
            $refreshToken = $client->getRefreshToken();
            $client->fetchAccessTokenWithRefreshToken($refreshToken);

            // Aggiorna il token di accesso nel tuo database
            $newAccessToken = $client->getAccessToken();
            $dl->saveAccessTokenOfClient($id_client, $newAccessToken);
        }

        // Crea un'istanza del servizio Google Calendar
        $service = new Google_Service_Calendar($client);

        $event = $service->events->delete('primary', $eventId);
    }

    public function checkExistGoogleCalendarEventById($eventId) {
        $dl = new DataLayer();
        $id_client = $dl->getIdClientByEmail(Session::get('loggedEmail'));

        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect'));

        // Ottieni il token di accesso dell'utente autenticato
        $accessToken = $dl->getAccessTokenOfClient($id_client);

        // Imposta il token di accesso sul client
        $client->setAccessToken($accessToken);

        if ($client->isAccessTokenExpired()) {
            // Se il token di accesso è scaduto, ottieni un nuovo token di accesso utilizzando il token di aggiornamento
            $refreshToken = $client->getRefreshToken();
            $client->fetchAccessTokenWithRefreshToken($refreshToken);

            // Aggiorna il token di accesso nel tuo database
            $newAccessToken = $client->getAccessToken();
            $dl->saveAccessTokenOfClient($id_client, $newAccessToken);
        }

        // Crea un'istanza del servizio Google Calendar
        $service = new Google_Service_Calendar($client);
        $events = $service->events->listEvents("primary");

        foreach ($events->getItems() as $event) {
            if ($event->getId() === $eventId) {
                // L'evento esiste in Google Calendar
                return true;
            }
        }

        // L'evento non esiste in Google Calendar
        return false;      
    }

    public function updateEvent($eventId, $newSummary, $newDescription, $date) {
        $dl = new DataLayer();
        $id_client = $dl->getIdClientByEmail(Session::get('loggedEmail'));

        $client = new Google_Client();
        $client->setClientId(config('services.google.client_id'));
        $client->setClientSecret(config('services.google.client_secret'));
        $client->setRedirectUri(config('services.google.redirect_uri'));
        $client->setAccessType('offline');

        $accessToken = $dl->getAccessTokenOfClient($id_client);

        $client->setAccessToken($accessToken);

        if ($client->isAccessTokenExpired()) {
            // Se il token di accesso è scaduto, ottieni un nuovo token di accesso utilizzando il token di aggiornamento
            $refreshToken = $client->getRefreshToken();
            $client->fetchAccessTokenWithRefreshToken($refreshToken);

            // Aggiorna il token di accesso nel tuo database
            $newAccessToken = $client->getAccessToken();
            $dl->saveAccessTokenOfClient($id_client, $newAccessToken);
        }

        $service = new Google_Service_Calendar($client);

        $event = $service->events->get('primary', $eventId);

        // Modifica le proprietà dell'evento
        $event->setSummary($newSummary);
        $event->setDescription($newDescription);

        // Imposta la data dell'appuntamento
        $start = new Google_Service_Calendar_EventDateTime();
        $start->setDate($date);
        $event->setStart($start);
        $end = new Google_Service_Calendar_EventDateTime();
        $end->setDate($date);
        $event->setEnd($end);

        // Effettua l'aggiornamento dell'evento
        $updatedEvent = $service->events->update('primary', $event->getId(), $event);

        return $updatedEvent->getId();
    }

    public function synchronize() {
        // verifica se si ha l'access token associato all'utente loggato:
            //- Se si => procedi a sync
            //- Se no => reindirizza prima a google.authorize e poi sync

        $dl = new DataLayer();
        $id_client = $dl->getIdClientByEmail(Session::get('loggedEmail'));

        $accessToken = $dl->getAccessTokenOfClient($id_client);

        if($accessToken == null) {
            return response()->json(['message' => 'Autenticati prima a Google Calendar. Usa il menù in alto.'], 422);
        } else {
            $appointmentsToSync = $dl->listAppointmentsUncompletedOfClient($id_client);
            // Solo quelli non completati. Poichè l'amministratore potrebbe eliminare un servizio e gli appuntamenti
            // completati farebbero riferimento a qualcosa che non esiste più

            foreach ($appointmentsToSync as $appointment) {
                $checkExist = $this->checkExistGoogleCalendarEventById($dl->getEventIdOfAppointment($appointment->id));
                $description = ClientController::buildDescriptionString($appointment->plate_number);

                if ($checkExist == false) {                    
                    $googleCalendar_eventId = $this->addEvent($id_client, $appointment->title, $description, $appointment->date);
                    $dl->updateIdCalendarEventOfAppointment($appointment->id, $googleCalendar_eventId);
                } else { 
                    // esiste in Google Calendar, procediamo ad aggiornarlo nel caso l'appuntamento sulla piattaforma è stato modificato
                    $this->updateEvent($dl->getEventIdOfAppointment($appointment->id), $appointment->title, $description, $appointment->date); 
                }              
            }

            return response()->json(['message' => 'Sincronizzazione completata con successo.']);
        }
    }
}