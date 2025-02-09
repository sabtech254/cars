<?php

namespace App\Http\Controllers;

use App\Models\Bid;
use App\Models\Car;
use Illuminate\Http\Request;

class BidController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bids = Bid::with(['user', 'car'])->latest()->paginate(20);
        return view('bids.index', compact('bids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\Response
     */
    public function create(Car $car)
    {
        return view('bids.create', compact('car'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'car_id' => 'required|exists:cars,id',
            'amount' => 'required|numeric|min:0',
            'notes' => 'nullable|string|max:1000'
        ]);

        $bid = new Bid($validated);
        $bid->user_id = auth()->id();
        $bid->status = 'pending';
        $bid->save();

        return redirect()->route('cars.show', $request->car_id)
            ->with('success', 'Your bid has been submitted successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function show(Bid $bid)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function edit(Bid $bid)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bid $bid)
    {
        // Only admin can update bid status
        if (!auth()->user()->is_admin) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected'
        ]);

        $bid->update($validated);

        return back()->with('success', 'Bid status has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bid  $bid
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bid $bid)
    {
        //
    }
}
