<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manufacturer;
use App\Models\User;
use App\Models\Bid;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'make',
        'model',
        'year',
        'price',
        'description',
        'condition',
        'transmission',
        'fuel_type',
        'mileage',
        'body_type',
        'color',
        'is_featured',
        'status',
        'features',
        'images',
        'user_id',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'features' => 'array',
        'images' => 'array',
        'year' => 'integer',
        'price' => 'decimal:2',
        'mileage' => 'integer',
    ];

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function getHighestBidAttribute()
    {
        return $this->bids()->max('amount') ?? 0;
    }

    public function getAcceptedBidAttribute()
    {
        return $this->bids()->where('status', 'accepted')->first();
    }
}
