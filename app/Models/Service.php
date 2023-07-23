<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $table = 'service'; 
    public $timestamps = false;

    use HasFactory;

    protected $fillable = ['title', 'description', 'appointment_id'];

    public function appointments() {
        return $this->hasMany(Appointment::class, 'appointment_id', 'id');
    }
}
