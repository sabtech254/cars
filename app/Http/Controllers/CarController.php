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

        // Check if request is from admin panel
        if ($request->is('admin*')) {
            // Apply admin-specific filters
            if ($request->status) {
                $query->where('status', $request->status);
            }

            if ($request->featured !== null) {
                $query->where('is_featured', $request->featured);
            }

            // Get unique makes for filter dropdown
            $makes = Car::distinct()->pluck('make')->sort();

            // Apply filters
            if ($request->make) {
                $query->where('make', $request->make);
            }

            $cars = $query->latest()->paginate(15);
            
            return view('admin.cars.index', compact('cars', 'makes'));
        }

        // Regular user view filters
        if ($request->make) {
            $query->where('make', $request->make);
        }

        if ($request->body_type) {
            $query->where('body_type', $request->body_type);
        }

        if ($request->price_range) {
            [$min, $max] = explode('-', $request->price_range);
            if ($max === 'plus') {
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
        
        // Define body types
        $bodyTypes = [
            'Sedan',
            'SUV',
            'Hatchback',
            'Wagon',
            'Coupe',
            'Convertible',
            'Van',
            'Truck',
            'Other'
        ];

        return view('cars.index', compact('cars', 'makes', 'bodyTypes'));
    }

    /**
     * Show the form for creating a new car.
     */
    public function create()
    {
        // If request is from admin panel
        if (request()->is('admin*')) {
            return view('admin.cars.create');
        }

        // Regular user car creation
        return view('cars.create');
    }

    /**
     * Store a newly created car in storage.
     */
    public function store(Request $request)
    {
        // If request is from admin panel
        if ($request->is('admin*')) {
            $request->validate([
                'title' => 'required|string|max:255',
                'make' => 'required|string|max:50',
                'model' => 'required|string|max:50',
                'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
                'mileage' => 'required|integer|min:0',
                'price' => 'required|numeric|min:0',
                'description' => 'required|string',
                'listing_type' => 'required|in:sale,auction',
                'auction_end' => 'required_if:listing_type,auction|nullable|date|after:now',
                'body_type' => 'required|in:sedan,suv,hatchback,truck,van',
                'images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            ]);

            $data = $request->except(['images', 'is_featured']);
            $data['is_featured'] = $request->has('is_featured');
            $data['status'] = 'available';

            // Handle images
            if ($request->hasFile('images')) {
                $imagePaths = [];
                foreach ($request->file('images') as $image) {
                    $path = $image->store('cars', 'public');
                    $imagePaths[] = $path;
                }
                $data['images'] = json_encode($imagePaths);
            }

            Car::create($data);

            return redirect()->route('admin.cars.' . $request->listing_type)
                ->with('success', 'Car created successfully.');
        }

        // Regular user car creation
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

    /**
     * Toggle the featured status of a car.
     *
     * @param  \App\Models\Car  $car
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleFeatured(Car $car)
    {
        $car->update(['is_featured' => !$car->is_featured]);
        
        return redirect()->back()->with('success', 
            $car->is_featured ? 'Car marked as featured.' : 'Car removed from featured.');
    }

    /**
     * Display a listing of cars in admin panel.
     */
    public function adminIndex(Request $request)
    {
        $query = Car::query();

        // Apply filters
        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->featured !== null) {
            $query->where('is_featured', $request->featured);
        }

        if ($request->make) {
            $query->where('make', $request->make);
        }

        // Get unique makes for filter dropdown
        $makes = Car::distinct()->pluck('make')->sort();

        $cars = $query->latest()->paginate(15);
        
        return view('admin.cars.index', compact('cars', 'makes'));
    }

    /**
     * Display the specified car in admin panel.
     */
    public function adminShow(Car $car)
    {
        return view('admin.cars.show', compact('car'));
    }

    /**
     * Show the form for editing the specified car.
     */
    public function adminEdit(Car $car)
    {
        return view('admin.cars.edit', compact('car'));
    }

    /**
     * Update the specified car in storage.
     */
    public function adminUpdate(Request $request, Car $car)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'make' => 'required|string|max:50',
            'model' => 'required|string|max:50',
            'year' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'mileage' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'description' => 'required|string',
            'status' => 'required|in:available,sold',
            'body_type' => 'required|in:sedan,suv,hatchback,truck,van',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->except(['images', 'is_featured', 'removed_images']);
        $data['is_featured'] = $request->has('is_featured');

        // Handle image removal
        if ($request->removed_images) {
            $currentImages = json_decode($car->images);
            $removedIndexes = json_decode($request->removed_images);
            $newImages = array_values(array_diff_key($currentImages, array_flip($removedIndexes)));
            
            // Delete removed images from storage
            foreach ($removedIndexes as $index) {
                if (isset($currentImages[$index])) {
                    Storage::delete('public/' . $currentImages[$index]);
                }
            }
            
            $data['images'] = json_encode($newImages);
        }

        // Handle new images
        if ($request->hasFile('images')) {
            $currentImages = json_decode($car->images ?? '[]');
            $newImages = [];

            foreach ($request->file('images') as $image) {
                $path = $image->store('cars', 'public');
                $newImages[] = $path;
            }

            $data['images'] = json_encode(array_merge($currentImages, $newImages));
        }

        $car->update($data);

        return redirect()->route('admin.cars.edit', $car)
            ->with('success', 'Car updated successfully.');
    }

    /**
     * Display a listing of cars for sale in admin panel.
     */
    public function adminSaleIndex(Request $request)
    {
        $query = Car::where('listing_type', 'sale');

        // Apply filters
        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->featured !== null) {
            $query->where('is_featured', $request->featured);
        }

        if ($request->make) {
            $query->where('make', $request->make);
        }

        // Get unique makes for filter dropdown
        $makes = Car::distinct()->pluck('make')->sort();

        $cars = $query->latest()->paginate(15);
        
        return view('admin.cars.sale', compact('cars', 'makes'));
    }

    /**
     * Display a listing of cars for auction in admin panel.
     */
    public function adminAuctionIndex(Request $request)
    {
        $query = Car::where('listing_type', 'auction');

        // Apply filters
        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->featured !== null) {
            $query->where('is_featured', $request->featured);
        }

        if ($request->make) {
            $query->where('make', $request->make);
        }

        // Get unique makes for filter dropdown
        $makes = Car::distinct()->pluck('make')->sort();

        $cars = $query->latest()->paginate(15);
        
        return view('admin.cars.auction', compact('cars', 'makes'));
    }
}
