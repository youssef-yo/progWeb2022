<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'client'; 
    public $timestamps = false;

    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'phone', 'user_id', 'vehicle_id'];

    public function vehicles() {
        return $this->hasMany(Vehicle::class, 'vehicle_id', 'id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
