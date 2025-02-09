<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function dashboard()
    {
        $totalCars = Car::count();
        $availableCars = Car::where('status', 'available')->count();
        $soldCars = Car::where('status', 'sold')->count();
        $totalUsers = User::count();
        $featuredCars = Car::where('is_featured', true)->count();
        
        $recentCars = Car::latest()->take(5)->get();
        $recentUsers = User::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalCars',
            'availableCars',
            'soldCars',
            'totalUsers',
            'featuredCars',
            'recentCars',
            'recentUsers'
        ));
    }
}
