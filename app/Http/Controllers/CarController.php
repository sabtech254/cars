<?php
namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::where('status', 'for_sale')
                   ->orderBy('created_at', 'desc')
                   ->paginate(12);
        
        return view('cars.index', compact('cars'));
    }

    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }
}
public function index(Request $request)
{
    $query = Car::where('status', 'for_sale');

    // Apply filters
    if ($request->filled('make')) {
        $query->where('make', $request->make);
    }
    
    if ($request->filled('year')) {
        $query->where('year', $request->year);
    }
    
    if ($request->filled('min_price')) {
        $query->where('price', '>=', $request->min_price);
    }
    
    if ($request->filled('max_price')) {
        $query->where('price', '<=', $request->max_price);
    }

    // Apply sorting
    switch ($request->sort) {
        case 'price_asc':
            $query->orderBy('price', 'asc');
            break;
        case 'price_desc':
            $query->orderBy('price', 'desc');
            break;
        case 'year_desc':
            $query->orderBy('year', 'desc');
            break;
        case 'year_asc':
            $query->orderBy('year', 'asc');
            break;
        default:
            $query->orderBy('created_at', 'desc');
    }

    $cars = $query->paginate(12)->withQueryString();
    
    return view('cars.index', compact('cars'));
}
// app/Http/Controllers/CarController.php
// Add these methods to your existing CarController

public function adminIndex()
{
    $cars = Car::orderBy('created_at', 'desc')->paginate(10);
    return view('admin.cars.index', compact('cars'));
}

public function create()
{
    return view('admin.cars.create');
}

public function store(Request $request)
{
    $validated = $request->validate([
        'make' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        'price' => 'required|numeric|min:0',
        'mileage' => 'required|integer|min:0',
        'condition' => 'required|string',
        'transmission' => 'required|string',
        'fuel_type' => 'required|string',
        'engine_size' => 'required|string',
        'color' => 'required|string',
        'description' => 'required|string',
        'features' => 'required|array',
        'status' => 'required|in:for_sale,sold,bidding',
        'is_featured' => 'boolean',
        'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // Handle image upload
    if ($request->hasFile('images')) {
        $imageNames = [];
        foreach ($request->file('images') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/cars'), $imageName);
            $imageNames[] = $imageName;
        }
        $validated['images'] = $imageNames;
    }

    Car::create($validated);

    return redirect()->route('admin.cars.index')
        ->with('success', 'Car added successfully');
}

public function edit(Car $car)
{
    return view('admin.cars.edit', compact('car'));
}

public function update(Request $request, Car $car)
{
    $validated = $request->validate([
        'make' => 'required|string|max:255',
        'model' => 'required|string|max:255',
        'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
        'price' => 'required|numeric|min:0',
        'mileage' => 'required|integer|min:0',
        'condition' => 'required|string',
        'transmission' => 'required|string',
        'fuel_type' => 'required|string',
        'engine_size' => 'required|string',
        'color' => 'required|string',
        'description' => 'required|string',
        'features' => 'required|array',
        'status' => 'required|in:for_sale,sold,bidding',
        'is_featured' => 'boolean',
        'images.*' => 'image|mimes:jpeg,png,jpg|max:2048'
    ]);

    // Handle image upload
    if ($request->hasFile('images')) {
        $imageNames = [];
        foreach ($request->file('images') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images/cars'), $imageName);
            $imageNames[] = $imageName;
        }
        $validated['images'] = array_merge($car->images ?? [], $imageNames);
    }

    $car->update($validated);

    return redirect()->route('admin.cars.index')
        ->with('success', 'Car updated successfully');
}

public function destroy(Car $car)
{
    // Delete associated images
    if (!empty($car->images)) {
        foreach ($car->images as $image) {
            $path = public_path('images/cars/' . $image);
            if (file_exists($path)) {
                unlink($path);
            }
        }
    }

    $car->delete();

    return redirect()->route('admin.cars.index')
        ->with('success', 'Car deleted successfully');
}