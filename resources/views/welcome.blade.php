<x-app-layout>
    <!-- Hero Section with Slideshow -->
    <div class="relative">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($featuredCars->take(4) as $index => $car)
                    @php
                        $images = json_decode($car->images);
                        $mainImage = $images[0] ?? '';
                    @endphp
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="relative" style="height: 500px; width: 100%; overflow: hidden;">
                            <img src="{{ $mainImage }}" 
                                 alt="{{ $car->title }}"
                                 class="absolute inset-0 w-full h-full object-cover"
                                 style="object-position: center;">
                            <div class="absolute inset-0 bg-black bg-opacity-40"></div>
                            <div class="absolute inset-0 flex items-center justify-center">
                                <div class="text-center text-white px-4">
                                    <h1 class="text-4xl md:text-6xl font-bold mb-4">{{ $car->title }}</h1>
                                    <p class="text-xl md:text-2xl mb-6">Starting at ${{ number_format($car->price) }}</p>
                                    <a href="{{ route('cars.show', $car) }}" 
                                       class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition duration-300">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Carousel Controls -->
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>

            <!-- Carousel Indicators -->
            <div class="carousel-indicators">
                @foreach($featuredCars->take(4) as $index => $car)
                    <button type="button" 
                            data-bs-target="#heroCarousel" 
                            data-bs-slide-to="{{ $index }}" 
                            class="{{ $index === 0 ? 'active' : '' }}"
                            aria-current="{{ $index === 0 ? 'true' : 'false' }}"
                            aria-label="Slide {{ $index + 1 }}">
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Featured Cars Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold mb-6">Featured Cars</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($featuredCars->take(6) as $car)
                @include('components.car-card', ['car' => $car])
            @endforeach
        </div>
        <div class="text-center mt-6">
            <a href="{{ route('cars.index', ['featured' => 1]) }}" class="text-blue-600 hover:text-blue-800">
                View All Featured Cars →
            </a>
        </div>
    </div>

    <!-- Recent Cars Section -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <h2 class="text-2xl font-bold mb-6">Recent Cars</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($recentCars->take(6) as $car)
                @include('components.car-card', ['car' => $car])
            @endforeach
        </div>
        <div class="text-center mt-6">
            <a href="{{ route('cars.index', ['sort' => 'newest']) }}" class="text-blue-600 hover:text-blue-800">
                View All Recent Cars →
            </a>
        </div>
    </div>

    <!-- Search Section -->
    <div class="bg-white py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center">Find Your Perfect Car</h2>
                <form action="{{ route('cars.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label for="make" class="block text-gray-700 font-bold mb-2">Make</label>
                        <select name="make" id="make" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500">
                            <option value="">All Makes</option>
                            @foreach($makes as $make)
                                <option value="{{ $make }}">{{ $make }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="price_range" class="block text-gray-700 font-bold mb-2">Price Range</label>
                        <select name="price_range" id="price_range" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500">
                            <option value="">Any Price</option>
                            <option value="0-50000">Under $50,000</option>
                            <option value="50000-100000">$50,000 - $100,000</option>
                            <option value="100000-plus">Over $100,000</option>
                        </select>
                    </div>
                    <div>
                        <label for="body_type" class="block text-gray-700 font-bold mb-2">Body Type</label>
                        <select name="body_type" id="body_type" class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500">
                            <option value="">All Types</option>
                            <option value="Sedan">Sedan</option>
                            <option value="SUV">SUV</option>
                            <option value="Coupe">Coupe</option>
                            <option value="Convertible">Convertible</option>
                        </select>
                    </div>
                    <div class="md:col-span-3">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded transition duration-300">
                            Search Cars
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Why Choose Us Section -->
    <div class="bg-gray-100 py-12">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-12 text-center">Why Choose Us</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                        <i class="material-icons text-blue-600 text-3xl">verified</i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Quality Verified</h3>
                    <p class="text-gray-600">All our vehicles undergo rigorous quality checks</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                        <i class="material-icons text-blue-600 text-3xl">attach_money</i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Best Prices</h3>
                    <p class="text-gray-600">Competitive prices and flexible financing options</p>
                </div>
                <div class="text-center">
                    <div class="bg-blue-100 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                        <i class="material-icons text-blue-600 text-3xl">support_agent</i>
                    </div>
                    <h3 class="text-xl font-bold mb-2">24/7 Support</h3>
                    <p class="text-gray-600">Expert support available around the clock</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
