<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    protected $table = 'garage'; 
    public $timestamps = false;

    use HasFactory;

    protected $fillable = ['denomination', 'place', 'phone', 'email', 'daily_capacity'];
}
