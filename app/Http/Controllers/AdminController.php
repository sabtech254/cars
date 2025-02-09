<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\User;
use App\Models\Bid;
use App\Models\Inquiry;
use App\Models\Activity;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'admin']);
    }

    public function index()
    {
        // Get statistics
        $totalCars = Car::count();
        $activeBids = Bid::where('status', 'active')->count() ?? 0;
        $newInquiries = Inquiry::where('status', 'new')->count() ?? 0;
        $totalUsers = User::count();

        // Get recent activities
        $recentActivities = Activity::with('user')
            ->latest()
            ->take(5)
            ->get();

        // Return view with all required variables
        return view('admin.dashboard', compact(
            'totalCars',
            'activeBids',
            'newInquiries',
            'totalUsers',
            'recentActivities'
        ));
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
