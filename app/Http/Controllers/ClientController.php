<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\Vehicle;
use App\Models\Appointment;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    protected $googleCalendarController;

    public function __construct(GoogleCalendarController $googleCalendarController)
    {
        $this->googleCalendarController = $googleCalendarController;
    }

    public function index()
    {
        $dl = new DataLayer();
        $services = $dl->listServices();
        $garage = $dl->garageInfo();
        return view('client.home')->with('services', $services)->with('garage', $garage);
    }

    public function vehicles() {
        $dl = new DataLayer();
        $id_client = $dl->getIdClientByEmail(Session::get('loggedEmail'));

        $vehicles = $dl->listVehiclesOfClient($id_client);
        $services = $dl->listServices();
        $garage = $dl->garageInfo();
        $view = view('client.vehicles', compact('vehicles', 'services', 'garage'))->render();
        $table = view('client.vehicles_table', compact('vehicles'))->render();
        return response()->json(['corpo' => $view, 'table' => $table]);
    }

    public function deleteVehicle($id) {
        $dl = new DataLayer();
        $id_client = $dl->getIdClientByEmail(Session::get('loggedEmail'));

        $vehicle = Vehicle::find($id);

        if (!$vehicle) {
            return response()->json(['message' => 'Veicolo non trovato.'], 404);
        }

        $hasUncompletedAppointments = Appointment::where('vehicle_id', $id)
            ->where('completed', false)
            ->exists();

        if ($hasUncompletedAppointments) {
            // Ci sono appuntamenti non completati, non consentire l'eliminazione del veicolo
            return response()->json(['message' => 'Impossibile eliminare il veicolo: ci sono appuntamenti non completati associati ad esso.'], 400);
        }

        // Non ci sono appuntamenti non completati, procedi con l'eliminazione del veicolo e degli appuntamenti completati
        DB::beginTransaction();

        try {
            // Elimina gli appuntamenti completati
            Appointment::where('vehicle_id', $id)
                ->where('completed', true)
                ->delete();

            $vehicle->delete();

            DB::commit();

            $vehicles = $dl->listVehiclesOfClient($id_client);

            $view = view('client.vehicles_table', compact('vehicles'))->render();

            return response()->json(['table' => $view]);
        } catch (\Exception $e) {
            DB::rollback();

            // Errore durante l'eliminazione
            return response()->json(['message' => 'Si è verificato un errore durante l\'eliminazione del veicolo.'], 500);
        }

    }

    public function addVehicle(Request $req) {
        Session::start();
        $dl = new DataLayer();

        if($dl->findVechicleByTarga($req->input('targa'))) {
            return response()->json(['message' => 'Un veicolo con la stessa targa esiste già.'], 422);
        } else {
            $id_client = $dl->getIdClientByEmail(Session::get('loggedEmail'));
            
            // check if $id_client is null ...
            
            $dl->addVehicle($req->input('targa'), $req->input('anno'), $req->input('km'), $id_client);
            
            $vehicles = $dl->listVehiclesOfClient($id_client);

            $view = view('client.vehicles_table', compact('vehicles'))->render();

            return response()->json(['table' => $view]);
        }
    }

    public function updateVehicle(Request $req, $id) {
        $dl = new DataLayer();

        $id_client = $dl->getIdClientByEmail(Session::get('loggedEmail'));

        if($dl->findServiceById($id)) {
           
            $dl->editVehicle($id, $req->input('targa'), $req->input('anno'), $req->input('km'), $id_client);
            
            $vehicles = $dl->listVehiclesOfClient($id_client);

            $view = view('client.vehicles_table', compact('vehicles'))->render();

            return response()->json(['table' => $view]);
        } else {
            return response()->json(['message' => 'Il veicolo che si vuole modificare non è stato trovato.'], 422);
        }
    }

    // APPUNTAMENTI

    public function appointments() {
        $dl = new DataLayer();
        $id_client = $dl->getIdClientByEmail(Session::get('loggedEmail'));

        $appointments_uncompleted = $dl->listAppointmentsUncompletedOfClient($id_client);
        $appointments_completed = $dl->listAppointmentsCompletedOfClient($id_client);
        $vehicles = $dl->listVehiclesOfClient($id_client);
        $services = $dl->listServices();
        $garage = $dl->garageInfo();

        $view = view('client.appointments', compact('appointments_uncompleted', 'appointments_completed', 'vehicles', 'services', 'garage'))->render();
        return response()->json(['corpo' => $view]);
    }

    public function deleteAppointment($id) {
        $dl = new DataLayer();
        $id_client = $dl->getIdClientByEmail(Session::get('loggedEmail'));
        
        $eventId = $dl->getEventIdOfAppointment($id);
        $dl->deleteAppointment($id);
        
        try {
            if($eventId != null) {
                $this->googleCalendarController->deleteEvent($id_client, $eventId);
            }             
        } catch (\Exception $e) {
            // TODO comunicare all'utente che non si è trovato l'evento su google calendar
        }

        $appointments_uncompleted = $dl->listAppointmentsUncompletedOfClient($id_client);

        $view = view('client.appointments_uncompleted_table', compact('appointments_uncompleted'))->render();

        return response()->json(['success' => 'Appuntamento eliminato correttamente.','appuntamenti_daCompletare' => $view]);
    }

    public static function buildDescriptionString($targa) {
        $dl = new DataLayer();
        $garage_info = $dl->garageInfo();
        
        $description = "Appuntamento richiesto per il veicolo targato " . $targa .
            " presso " . $garage_info->denomination . " - telefono: " . $garage_info->phone;

        return $description;
    }

    public function addAppointment(Request $req) {
        $dl = new DataLayer();
        $id_client = $dl->getIdClientByEmail(Session::get('loggedEmail'));

        $already_created = $dl->checkAppointmentAlreadyCreated($id_client, $req->input('targa'), $req->input('servizio'), $req->input('data'));
        $capacity_ok = $dl->checkCapacity($req->input('data'));

        if ($already_created) {
            return response()->json(['error' => 'Esiste già un appuntamento per questo veicolo per lo stesso servizio e giorno selezionati.'], 422);
        } else if ($capacity_ok) {
            $garage_info = $dl->garageInfo();
            $description = $this->buildDescriptionString($req->input("targa"));
            
            try {
                $eventId = $this->googleCalendarController->addEvent($id_client, $req->input('servizio'), $description, $req->input('data'));
            } catch (\Exception $e) {
                $dl->addAppointment($req->input('targa'), $req->input('servizio'), $req->input('data'), null);

                $appointments_uncompleted = $dl->listAppointmentsUncompletedOfClient($id_client);
                $view = view('client.appointments_uncompleted_table', compact('appointments_uncompleted'))->render();

                return response()->json(['success' => 'Appuntamento aggiunto correttamente sul portale.', 
                    'error' => 'Non è stato possibile aggiungerlo su Google Calendar.', 
                    'appuntamenti_daCompletare' => $view], 422);
            }

            $dl->addAppointment($req->input('targa'), $req->input('servizio'), $req->input('data'), $eventId);
        
            $appointments_uncompleted = $dl->listAppointmentsUncompletedOfClient($id_client);
            $view = view('client.appointments_uncompleted_table', compact('appointments_uncompleted'))->render();

            return response()->json(['appuntamenti_daCompletare' => $view]);
        } else {
            return response()->json(['error' => 'Non è possibile prenotare per il giorno selezionato. Non ci sono posti disponibili.'], 422);
        }
        
    }

    public function updateAppointment(Request $req, $id) {
        $dl = new DataLayer();
        $id_client = $dl->getIdClientByEmail(Session::get('loggedEmail'));

        $already_created = $dl->checkAppointmentAlreadyCreated($id_client, $req->input('targa'), $req->input('servizio'), $req->input('data'));
        $capacity_ok = $dl->checkCapacity($req->input('data'));

        if ($already_created) {
            $appointments_uncompleted = $dl->listAppointmentsUncompletedOfClient($id_client);
            $view = view('client.appointments_uncompleted_table', compact('appointments_uncompleted'))->render();

            return response()->json(['appuntamenti_daCompletare' => $view, 'error' => 'Esiste già un appuntamento per questo veicolo per lo stesso servizio e giorno selezionati.'], 422);
        } else if ($capacity_ok) {
            if($dl->findAppointmentById($id)) {
            
                $appointment_updated = $dl->editAppointment($id, $req->input('targa'), $req->input('servizio'), $req->input('data'));
                
                $appointments_uncompleted = $dl->listAppointmentsUncompletedOfClient($id_client);

                $view = view('client.appointments_uncompleted_table', compact('appointments_uncompleted'))->render();

                $title = $dl->getTitleOfServiceById($appointment_updated->service_id);
                $description = $this->buildDescriptionString($req->input('targa'));

                try {
                    $this->googleCalendarController->updateEvent($appointment_updated->id_event_google, $title, $description, $appointment_updated->date);
                } catch(\Exception $e) {
                    return response()->json(['error' => 'Non è stato possibile accedere a Google Calendar.',
                            'success' => 'Appuntamento modificato.', 
                            'appuntamenti_daCompletare' => $view], 422);
                }
                

                return response()->json(['appuntamenti_daCompletare' => $view]);
            } else {
                return response()->json(['error' => 'L\'appuntamento che si vuole modificare non è stato trovato.'], 422);
            }
        } else {
            return response()->json(['error' => 'Non è possibile prenotare per il giorno selezionato. Non ci sono posti disponibili.'], 422);
        }
    }
}
