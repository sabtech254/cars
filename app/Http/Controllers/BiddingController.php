<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Bid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BiddingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $biddingCars = Car::with(['bids' => function($query) {
            $query->latest();
        }])->bidding()->get();
        
        return view('bidding.index', compact('biddingCars'));
    }

    public function placeBid(Request $request)
    {
        $validatedData = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'bid_amount' => 'required|numeric|min:0'
        ]);

        $car = Car::findOrFail($validatedData['car_id']);
        
        // Check if bid amount is higher than current highest bid
        $highestBid = $car->bids()->max('bid_amount') ?? $car->starting_price;
        
        if ($validatedData['bid_amount'] <= $highestBid) {
            return back()->with('error', 'Bid amount must be higher than current highest bid.');
        }

        $bid = new Bid([
            'car_id' => $validatedData['car_id'],
            'bid_amount' => $validatedData['bid_amount'],
            'user_id' => Auth::id()
        ]);

        $bid->save();

        return back()->with('success', 'Your bid has been placed successfully!');
    }
}