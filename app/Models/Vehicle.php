<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicle'; 
    public $timestamps = false;

    use HasFactory;

    protected $fillable = ['plate_number', 'registration_year', 'mileage', 'client_id', 'appointment_id'];

    public function client() {
        return $this->belongsTo(Client::class, 'client_id', 'id');
    }

    public function appointments() {
        return $this->hasMany(Appointment::class, 'appointment_id', 'id');
    }

}
