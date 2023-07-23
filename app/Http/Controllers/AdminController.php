<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\Service;
use App\Models\Appointment;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $dl = new DataLayer();
        $clients = $dl->listClients();
        $services = $dl->listServices();
        $appointments = $dl->listAppointments();
        $garage = $dl->garageInfo();

        return view('administrator.home')->with('clients',$clients)
                                         ->with('services',$services)
                                         ->with('appointments',$appointments)
                                         ->with('garage', $garage);
    }

    public function updateGarageInfo(Request $req) {
        $dl = new DataLayer();

        $dl->updateGarageInfo($req->input('denomination'), $req->input('place'), $req->input('phone'), $req->input('email'),
            $req->input('daily_capacity'));

        return Redirect::to(route('admin.index'));
    }

    public function services() {
        $dl = new DataLayer();
        $services = $dl->listServices();
        $garage = $dl->garageInfo();
        // return view('administrator.services')->with('services',$services);
        $view = view('administrator.services', compact('services', 'garage'))->render();

        return response()->json(['corpo' => $view]);
    }

    public function deleteService($serviceId) {
        $dl = new DataLayer();
        
        $service = Service::find($serviceId);

        if (!$service) {
            // Servizio non trovato
            return response()->json(['message' => 'Servizio non trovato.'], 404);
        }

        $hasUncompletedAppointments = Appointment::where('service_id', $serviceId)
            ->where('completed', false)
            ->exists();

        if ($hasUncompletedAppointments) {
            // Ci sono appuntamenti non completati, non consentire l'eliminazione del servizio
            return response()->json(['message' => 'Impossibile eliminare il servizio: ci sono appuntamenti non completati associati ad esso.'], 400);
        }

        // Non ci sono appuntamenti non completati, procedi con l'eliminazione del servizio e degli appuntamenti completati
        DB::beginTransaction();

        try {
            // Elimina gli appuntamenti completati
            Appointment::where('service_id', $serviceId)
                ->where('completed', true)
                ->delete();

            // Elimina il servizio
            $service->delete();

            DB::commit();

            $services = $dl->listServices();

            $view = view('administrator.services_table', compact('services'))->render();

            return response()->json(['table' => $view]);
        } catch (\Exception $e) {
            DB::rollback();

            // Errore durante l'eliminazione
            return response()->json(['message' => 'Si è verificato un errore durante l\'eliminazione del servizio'], 500);
        }
    }

    public function addService(Request $req) {
        $dl = new DataLayer();

        if($dl->findServiceByTitle($req->input('title'))) {
            return response()->json(['message' => 'Il servizio con lo stesso titolo esiste già.'], 422);
        } else {
            $dl->addService($req->input('title'), $req->input('description'));
            
            $services = $dl->listServices();

            $view = view('administrator.services_table', compact('services'))->render();

            return response()->json(['table' => $view]);
        }
    }

    public function updateService(Request $req, $id) {
        $dl = new DataLayer();

        if($dl->findServiceById($id)) {
           
            $dl->editService($id, $req->input('title'), $req->input('description'));
            
            $services = $dl->listServices();

            $view = view('administrator.services_table', compact('services'))->render();

            return response()->json(['table' => $view]);
        } else {
            return response()->json(['message' => 'Il servizio che si vuole modificare non è stato trovato.'], 422);
        }
    }

    public function clients() {
        $dl = new DataLayer();
        $clients = $dl->listClients();
        $garage = $dl->garageInfo();
        // return view('administrator.clients')->with('clients',$clients);

        $view = view('administrator.clients', compact('clients', 'garage'))->render();

        return response()->json(['corpo' => $view]);
    }

    public function appointments() {
        $dl = new DataLayer();
        $appointments_uncompleted = $dl->listAppointmentsUncompleted();
        $appointments_completed = $dl->listAppointmentsCompleted();
        $garage = $dl->garageInfo();

        $view = view('administrator.appointments', compact('appointments_uncompleted', 'appointments_completed', 'garage'))->render();
        return response()->json(['corpo' => $view]);
    }
    
    public function completeAppointment(Request $req, $id) {
        $dl = new DataLayer();

        $dl->completeAppointment($id, $req->input("note"));

        $appointments_uncompleted = $dl->listAppointmentsUncompleted();
        $appointments_completed = $dl->listAppointmentsCompleted();
        $garage = $dl->garageInfo();

        $view = view('administrator.appointments', compact('appointments_uncompleted', 'appointments_completed', 'garage'))->render();
        return response()->json(['corpo' => $view]);
    }
}
