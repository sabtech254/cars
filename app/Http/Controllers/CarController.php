<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index(Request $request)
    {
        $query = Car::query();

        // Apply filters
        if ($request->make) {
            $query->where('make', $request->make);
        }

        if ($request->body_type) {
            $query->where('body_type', $request->body_type);
        }

        if ($request->price_range) {
            [$min, $max] = explode('-', $request->price_range);
            if ($max === '+') {
                $query->where('price', '>=', $min);
            } else {
                $query->whereBetween('price', [$min, $max]);
            }
        }

        // Apply sorting
        switch ($request->sort) {
            case 'price_low':
                $query->orderBy('price', 'asc');
                break;
            case 'price_high':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->latest();
                break;
        }

        $cars = $query->paginate(12);
        $makes = Car::distinct()->pluck('make');

        return view('cars.index', compact('cars', 'makes'));
    }

    public function create()
    {
        return view('cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'make' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'condition' => 'required|in:new,used',
            'transmission' => 'required|string',
            'fuel_type' => 'required|string',
            'mileage' => 'nullable|integer|min:0',
            'body_type' => 'required|string',
            'color' => 'required|string',
            'is_featured' => 'boolean',
            'features' => 'nullable|string',
            'images.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle features
        $features = $validated['features'] ? explode("\n", trim($validated['features'])) : [];
        
        // Handle image uploads
        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                $images[] = Storage::url($path);
            }
        }

        // Create car
        $car = new Car($validated);
        $car->user_id = auth()->id();
        $car->features = json_encode($features);
        $car->images = json_encode($images);
        $car->status = 'available';
        $car->save();

        return redirect()->route('cars.show', $car)
            ->with('success', 'Car listed successfully!');
    }

    public function show(Car $car)
    {
        // Get similar cars (same make or body type)
        $similarCars = Car::where('id', '!=', $car->id)
            ->where(function($query) use ($car) {
                $query->where('make', $car->make)
                    ->orWhere('body_type', $car->body_type);
            })
            ->limit(4)
            ->get();

        return view('cars.show', compact('car', 'similarCars'));
    }

    public function edit(Car $car)
    {
        $this->authorize('update', $car);
        return view('cars.edit', compact('car'));
    }

    public function update(Request $request, Car $car)
    {
        $this->authorize('update', $car);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'make' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'condition' => 'required|in:new,used',
            'transmission' => 'required|string',
            'fuel_type' => 'required|string',
            'mileage' => 'nullable|integer|min:0',
            'body_type' => 'required|string',
            'color' => 'required|string',
            'is_featured' => 'boolean',
            'features' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Handle features
        if (isset($validated['features'])) {
            $features = $validated['features'] ? explode("\n", trim($validated['features'])) : [];
            $car->features = json_encode($features);
        }

        // Handle new images
        if ($request->hasFile('images')) {
            $images = json_decode($car->images, true) ?? [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                $images[] = Storage::url($path);
            }
            $car->images = json_encode($images);
        }

        $car->update($validated);

        return redirect()->route('cars.show', $car)
            ->with('success', 'Car updated successfully!');
    }

    public function destroy(Car $car)
    {
        $this->authorize('delete', $car);
        
        // Delete images from storage
        $images = json_decode($car->images, true) ?? [];
        foreach ($images as $image) {
            Storage::delete(str_replace('/storage/', 'public/', $image));
        }

        $car->delete();

        return redirect()->route('cars.index')
            ->with('success', 'Car deleted successfully!');
    }

    public function home()
    {
        $featuredCars = Car::where('is_featured', true)
            ->where('status', 'available')
            ->latest()
            ->take(6)
            ->get();

        $recentCars = Car::where('status', 'available')
            ->latest()
            ->take(6)
            ->get();

        $makes = Car::distinct()->pluck('make');

        return view('welcome', compact('featuredCars', 'recentCars', 'makes'));
    }
}
