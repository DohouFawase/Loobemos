<?php

namespace App\Models;

use App\Models\Locations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_locations',
        'id_users',
        'date',
        'heure',
        'tel'
    ];

    public function locations()
    {
        return $this->belongsTo(Locations::class, 'id_locations');
    }

    
    
}
