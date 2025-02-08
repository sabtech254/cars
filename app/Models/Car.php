<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'make',
        'model',
        'year',
        'price',
        'mileage',
        'condition',
        'transmission',
        'fuel_type',
        'engine_size',
        'color',
        'description',
        'features',
        'is_featured',
        'status'
    ];

    protected $casts = [
        'features' => 'array',
        'is_featured' => 'boolean'
    ];

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeBidding($query)
    {
        return $query->where('status', 'bidding');
    }

    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2);
    }
}