<?php

namespace App\Models;

use App\Models\LocationImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Locations extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function images()
  {
    return $this->hasMany(LocationImage::class);
  }
}
