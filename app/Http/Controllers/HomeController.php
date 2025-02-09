<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get 4 featured cars
        $featuredCars = Car::where('is_featured', true)
                          ->latest()
                          ->take(4)
                          ->get();

        // Get 6 recent cars
        $recentCars = Car::latest()
                        ->take(6)
                        ->get();

        // Get all unique makes for the search form
        $makes = Car::distinct()->pluck('make')->sort();

        return view('welcome', compact('featuredCars', 'recentCars', 'makes'));
    }
}
