<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Client;
use App\Models\Vehicle;
use App\Models\Service;
use App\Models\Appointment;
use App\Models\Garage;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            ClientsTableSeeder::class,
            VehiclesTableSeeder::class,
            ServicesTableSeeder::class,
            AppointmentsTableSeeder::class,
            GarageTableSeeder::class,
        ]);
    }
}

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Paperino',
            'email' => 'paperino@example.com',
            'password' => bcrypt('password'),
            'role' => 'client',
        ]);

        // Aggiungi altri dati di esempio se necessario
    }
}

class GarageTableSeeder extends Seeder
{
    public function run()
    {
        Garage::create([
            'denomination' => 'Pat-Gomme',
            'place' => 'Via Angelo Antoni, 41 Sarezzo (BS)',
            'email' => 'info@patgomme.com',
            'phone' => '030 11111',
            'daily_capacity' => 3,
        ]);
    }
}

class ClientsTableSeeder extends Seeder
{
    public function run()
    {
        Client::create([
            'firstname' => 'Paperino',
            'lastname' => 'Paperino',
            'phone' => '333 444 5555',
            'user_id' => 2, // Assumi che l'utente con id 1 sia associato a questo cliente
        ]);

        // Aggiungi altri dati di esempio se necessario
    }
}

class VehiclesTableSeeder extends Seeder
{
    public function run()
    {
        Vehicle::create([
            'plate_number' => 'ABC123',
            'registration_year' => 2020,
            'mileage' => 5000,
            'client_id' => 1, // Assumi che il cliente con id 1 sia associato a questo veicolo
        ]);

        // Aggiungi altri dati di esempio se necessario
    }
}

class ServicesTableSeeder extends Seeder
{
    public function run()
    {
        Service::create([
            'title' => 'Cambio olio',
            'description' => 'Approfitta del servizio cambio olio',
        ]);

        Service::create([
            'title' => 'Cambio pneumatici',
            'description' => 'Sia per la stagione estiva che per la stagione invernale.',
        ]);

        Service::create([
            'title' => 'Inversione pneumatici',
            'description' => 'Controlla lo stato e rendi più duraturi i tuoi pneumatici.',
        ]);

        Service::create([
            'title' => 'Deposito pneumatici auto',
            'description' => "Se c'è spazio te li teniamo noi!",
        ]);

        // Aggiungi altri dati di esempio se necessario
    }
}

class AppointmentsTableSeeder extends Seeder
{
    public function run()
    {
        Appointment::create([
            'date' => '2023-06-18',
            'note' => 'Appointment note',
            'completed' => false,
            'vehicle_id' => 1, // Assumi che il veicolo con id 1 sia associato a questo appuntamento
            'service_id' => 1, // Assumi che il servizio con id 1 sia associato a questo appuntamento
        ]);

        // Aggiungi altri dati di esempio se necessario
    }
}
