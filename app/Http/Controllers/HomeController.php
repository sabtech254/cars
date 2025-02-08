<?php
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $featuredCars = Car::featured()->limit(6)->get();
        $latestCars = Car::latest()->limit(8)->get();
        
        return view('home.index', [
            'featuredCars' => $featuredCars,
            'latestCars' => $latestCars
        ]);
    }
}