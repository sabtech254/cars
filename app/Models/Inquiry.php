<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Car;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'subject',
        'message',
        'status',
        'email',
        'phone'
    ];

    /**
     * Get the user that made the inquiry.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the car that was inquired about.
     */
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}
