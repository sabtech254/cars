<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Car;

class Bid extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'amount',
        'status',
        'notes'
    ];

    /**
     * Get the user that made the bid.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the car that was bid on.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
