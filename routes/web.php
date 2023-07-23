<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleCalendarController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontController::class, 'getHome'])->name('home');
Route::get('/user/login', [AuthController::class, 'authentication'])->name('user.loginPage')->middleware('guest'); // prima era user.login ma dava errore
Route::post('/user/login', [AuthController::class, 'login'])->name('user.login');
Route::get('/user/logout', [AuthController::class, 'logout'])->name('user.logout');
Route::get('/user/register', [AuthController::class, 'registration'])->name('user.registerPage');
Route::post('/user/register', [AuthController::class, 'registerUser'])->name('user.register');

Route::middleware(['authUser'])->group(function () {

    //Da mettere middleware per amministratore
    Route::middleware(['authAdmin'])->group(function () {
        Route::get('admin', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/services', [AdminController::class, 'addService'])->name('service.store');
        Route::put('/services/{id}', [AdminController::class, 'updateService'])->name('services.update');
        Route::delete('/services/{id}', [AdminController::class, 'deleteService'])->name('services.destroy');
        Route::get('/services', [AdminController::class, 'services'])->name('services');

        Route::get('/clients', [AdminController::class, 'clients'])->name('clients');
        Route::get('/admin/appointments', [AdminController::class, 'appointments'])->name('admin.appointments');
        Route::get('/admin/appointments/{id}', [AdminController::class, 'completeAppointment'])->name('admin.completeAppointment');

        Route::post('/garage', [AdminController::class, 'updateGarageInfo'])->name('garage.update');
    });

    Route::middleware(['authClient'])->group(function () {
        // homepage cliente
        Route::get('/garage', [ClientController::class, 'index'])->name('client.index');

        // Veicoli - cliente
        Route::post('/vehicles', [ClientController::class, 'addVehicle'])->name('vehicles.store');
        Route::put('/vehicles/{id}', [ClientController::class, 'updateVehicle'])->name('vehicles.update');
        Route::delete('/vehicles/{id}', [ClientController::class, 'deleteVehicle'])->name('vehicles.destroy');
        Route::get('/vehicles', [ClientController::class, 'vehicles'])->name('vehicles');

        // Appuntamenti - cliente
        Route::post('/appointments', [ClientController::class, 'addAppointment'])->name('appointments.store');
        Route::put('/appointments/{id}', [ClientController::class, 'updateAppointment'])->name('appointments.update');
        Route::delete('/appointments/{id}', [ClientController::class, 'deleteAppointment'])->name('appointments.destroy');
        Route::get('/appointments', [ClientController::class, 'appointments'])->name('appointments');

        Route::get('/google-calendar/synchronize', [GoogleCalendarController::class, 'synchronize'])->name('google.synchronize');
        // Api - Google
        Route::get('/google-calendar/authorize', [GoogleCalendarController::class, 'googleAuthorize'])->name('google.authorize');
        Route::get('/google-calendar/callback', [GoogleCalendarController::class, 'callback'])->name('google.callback');
    });  
});





