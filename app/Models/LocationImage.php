<?php

namespace App\Models;

use App\Models\Locations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class LocationImage extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function location()
  {
    return $this->belongsTo(Locations::class);
  }
}
