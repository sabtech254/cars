<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manufacturer;

class Car extends Model
{
    use HasFactory;

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }
}
