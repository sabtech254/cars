<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Manufacturer;
use App\Models\User;
use App\Models\Bid;
use App\Models\CarImage;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'make',
        'model',
        'year',
        'mileage',
        'price',
        'description',
        'listing_type',
        'auction_end',
        'body_type',
        'condition',
        'transmission',
        'fuel_type',
        'color',
        'engine_size',
        'features',
        'is_featured',
        'status',
        'user_id'
    ];

    protected $casts = [
        'year' => 'integer',
        'mileage' => 'integer',
        'price' => 'decimal:2',
        'is_featured' => 'boolean',
        'auction_end' => 'datetime',
        'engine_size' => 'decimal:1'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(CarImage::class);
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
