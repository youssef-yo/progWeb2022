<?php

namespace App\Models;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DataLayer
{

    // API - Google

    public function saveAccessTokenOfClient($id_client, $access_token) {
        $client = Client::find($id_client);

        $user = User::find($client->user_id);
        $user->accessTokenGoogle = $access_token;
        $user->save();
    }

    public function getAccessTokenOfClient($id_client) {
        $client = Client::find($id_client);

        $user = User::find($client->user_id);
        return $user->accessTokenGoogle;
    }

    public function getEventIdOfAppointment($id) {
        $appointment = Appointment::find($id);
        return $appointment->id_event_google;
    }

    public function updateIdCalendarEventOfAppointment($id_appointment, $id_googleEvent) {
        $appointment = Appointment::find($id_appointment);
        $appointment->id_event_google = $id_googleEvent;
        $appointment->save();
    }

    public function getTitleOfServiceById($id) {
        $service = Service::find($id);
        return $service->title;
    }
    //

    public function getUserName($email) {
        $users = User::where('email',$email)->get();
        if ($users->count() > 0) {
            return $users[0]->name;
        } else {
            return null;
        }
    }

    public function validUser($email, $password) {
        $users = User::where('email',$email)->get(['password']);
        
        if(count($users) == 0)
        {
            return false;
        }
        
        return (Hash::check($password, $users[0]->password));
    }

    public function checkUserAlreadyExist($email) {
        $users = User::where('email',$email)->get();

        if(count($users) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function isAdmin($email) {
        $users = User::where('email',$email)->get();
        
        if($users[0]->role == User::ROLE_ADMIN) {
            return true;
        } else {
            return false;
        }
    }

    public function getIdClientByEmail($email) {
        $user = User::where('email',$email)->first();

        if($user) {
            return $user->client->id;
        } else {
            return null;
        }
    }

    public function checkCapacity($date) {
        $capacity = Garage::first()->daily_capacity;

        $appointments = Appointment::where('date', $date)->get();

        if(count($appointments) < $capacity) {
            return true;
        } else {
            return false;
        }
    }

    public function updateGarageInfo($denomination, $place, $phone, $email, $daily_capacity) {
        $garage = Garage::first();

        $garage->denomination = $denomination;
        $garage->place = $place;
        $garage->phone = $phone;
        $garage->email = $email;
        $garage->daily_capacity = $daily_capacity;
        $garage->save();
    }
    
    public function addUser($firstname, $lastname, $phone, $email, $password) {
        $user = new User();
        $user->name = $firstname;
        $user->email = $email;
        $user->password = Hash::make($password);
        $user->role = User::ROLE_CLIENT;

        $user->save();

        $client = new Client();
        $client->firstname = $firstname;
        $client->lastname = $lastname;
        $client->phone = $phone;
        $client->user_id = $user->id;
        
        $client->save();        
    }

    public function garageInfo() {
        $garage = Garage::all();
        return $garage[0]; 
    }
    public function listClients() {        
        $clients = Client::orderBy('lastname','asc')->orderBy('firstname','asc')->get();
        return $clients;
    }

    public function listServices() {        
        $services = Service::orderBy('title','asc')->get();
        return $services;
    }

    public function listVehiclesOfClient($id_client) {        
        $vehicles = Vehicle::where("client_id", $id_client)->orderBy('registration_year','asc')->get();
        return $vehicles;
    }
    
    public function listAppointments() {        
        $appointments = Appointment::orderBy('date','asc')->get();
        return $appointments;
    }

    public function listAppointmentsCompleted() {           
        $appointments = DB::table('appointment')
            ->join('service', 'service_id', '=', 'service.id')
            ->join('vehicle', 'vehicle_id', '=', 'vehicle.id')
            ->join('client', 'vehicle.client_id','=', 'client.id')
            ->select('client.firstname', 'client.lastname', 'appointment.id', 'vehicle.plate_number', 'service.title', 'appointment.date', 'appointment.note')
            ->where('completed', true)->get(); 

        return $appointments;
    }

    public function listAppointmentsCompletedOfClient($id_client) {           
        $appointments = DB::table('appointment')
            ->join('service', 'service_id', '=', 'service.id')
            ->join('vehicle', 'vehicle_id', '=', 'vehicle.id')
            ->join('client', 'vehicle.client_id','=', 'client.id')
            ->select("client.id",'client.firstname', 'client.lastname', 'appointment.id', 'vehicle.plate_number', 'service.title', 'appointment.date', 'appointment.note')
            ->where('completed', true)
            ->where("client.id", $id_client)->get(); 

        return $appointments;
    }

    public function listAppointmentsUncompleted() {        
        $appointments = DB::table('appointment')
            ->join('service', 'service_id', '=', 'service.id')
            ->join('vehicle', 'vehicle_id', '=', 'vehicle.id')
            ->join('client', 'vehicle.client_id','=', 'client.id')
            ->select('client.firstname', 'client.lastname','appointment.id', 'vehicle.plate_number', 'service.title', 'appointment.date', 'appointment.note')
            ->where('completed', false)->get();

        return $appointments;
    }

    public function listAppointmentsUncompletedOfClient($id_client) {        
        $appointments = DB::table('appointment')
            ->join('service', 'service_id', '=', 'service.id')
            ->join('vehicle', 'vehicle_id', '=', 'vehicle.id')
            ->join('client', 'vehicle.client_id','=', 'client.id')
            ->select('client.firstname', 'client.lastname','appointment.id', 'vehicle.plate_number', 'service.title', 
                    'appointment.date', 'appointment.note')
            ->where('completed', false)
            ->where("client.id", $id_client)->get();

        return $appointments;
    }

    // servizi - administrator
    public function deleteService($id) {
        $service = Service::find($id);
        $service->delete();
    }

    public function findServiceByTitle($title) {
        $services = Service::where('title', $title)->get();

        if(count($services) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function findServiceById($id) {
        $services = Service::where('id', $id)->get();

        if(count($services) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function addService($title, $description) {
        $service = new Service;
        $service->title = $title;
        $service->description = $description;
        $service->save();
    }

    public function editService($id, $title, $description) {
        $service = Service::find($id);
        $service->title = $title;
        $service->description = $description;
        $service->save();
    }

    // veicoli - client
    public function deleteVehicle($id, $id_client) {
        $vehicle = Vehicle::find($id)->where("client_id", $id_client);
        $vehicle->delete();
    }

    public function findVechicleByTarga($targa) {
        $vehicles = Vehicle::where('plate_number', $targa)->get();

        if(count($vehicles) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function findVechiclById($id) {
        $vehicles = Vehicle::where('id', $id)->get();

        if(count($vehicles) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function addVehicle($targa, $anno, $km, $id_client) {
        $vehicle = new Vehicle;
        $vehicle->plate_number = $targa;
        $vehicle->registration_year = $anno;
        $vehicle->mileage = $km;
        $vehicle->client_id = $id_client; 
        $vehicle->save();
    }

    public function editVehicle($id, $targa, $anno, $km, $id_client) {
        $vehicle = Vehicle::find($id);
        
        if ($vehicle && $vehicle->client_id == $id_client) {
            $vehicle->plate_number = $targa;
            $vehicle->registration_year = $anno;
            $vehicle->mileage = $km;
            $vehicle->save();
        }
    }


    // Appuntamenti - client
    public function deleteAppointment($id) {
        $appointment = Appointment::find($id);
        $appointment->delete();
    }

    public function findAppointmentById($id) {
        $appointments = Appointment::where('id', $id)->get();

        if(count($appointments) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function getIdVeicoloByTarga($targa) {
        $vehicles = Vehicle::where('plate_number', $targa)->get();

        return $vehicles[0]->id;
    }

    public function getIdServizioByTitolo($servizio) {
        $services = Service::where('title', $servizio)->get();

        return $services[0]->id;
    }

    public function addAppointment($targa, $servizio, $data, $event_google) {
        $appointment = new Appointment;

        $id_veicolo = $this->getIdVeicoloByTarga($targa);
        $id_servizio = $this->getIdServizioByTitolo($servizio);

        $appointment->vehicle_id = $id_veicolo;
        $appointment->service_id = $id_servizio;
        $appointment->completed = false;
        $appointment->date = $data;
        $appointment->note = "Nessuna nota.";
        
        if($event_google != null) {
            $appointment->id_event_google = $event_google;
        }

        $appointment->save();
    }

    public function checkAppointmentAlreadyCreated($id_client, $targa, $servizio, $data) {
        $appointments = DB::table('appointment')
            ->join('service', 'service_id', '=', 'service.id')
            ->join('vehicle', 'vehicle_id', '=', 'vehicle.id')
            ->join('client', 'vehicle.client_id','=', 'client.id')
            ->select('client.id', 'vehicle.plate_number', 'service.title', 'appointment.date')
            ->where('client.id', $id_client)
            ->where('vehicle.plate_number', $targa)
            ->where('service.title', $servizio)
            ->where('appointment.date', $data)
            ->where('completed', false)->get(); 

        if (count($appointments) > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function editAppointment($id, $targa, $servizio, $data) {
        $appointment = Appointment::find($id);

        $id_veicolo = $this->getIdVeicoloByTarga($targa);
        $id_servizio = $this->getIdServizioByTitolo($servizio);

        $appointment->vehicle_id = $id_veicolo;
        $appointment->service_id = $id_servizio;
        $appointment->date = $data;
        $appointment->save();

        return $appointment;
    }

    public function completeAppointment($id, $note) {
        $appointment = Appointment::find($id);

        $appointment->completed = true;
        if($note != "") {
            $appointment->note = $note;
        } else {
            $appointment->note = "Nessuna nota.";
        }
        $appointment->save();
    }
}