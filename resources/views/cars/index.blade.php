<x-app-layout>
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Browse Cars</h1>
            @auth
                <a href="{{ route('cars.create') }}" class="btn btn-primary">Post a Car</a>
            @endauth
        </div>

        <!-- Filters -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('cars.index') }}" method="GET" class="row g-3">
                            <div class="col-md-3">
                                <label for="make" class="form-label">Make</label>
                                <select name="make" id="make" class="form-select">
                                    <option value="">All Makes</option>
                                    @foreach($makes as $make)
                                    <option value="{{ $make }}" {{ request('make') == $make ? 'selected' : '' }}>
                                        {{ $make }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="body_type" class="form-label">Body Type</label>
                                <select name="body_type" id="body_type" class="form-select">
                                    <option value="">All Types</option>
                                    <option value="sedan" {{ request('body_type') == 'sedan' ? 'selected' : '' }}>Sedan</option>
                                    <option value="suv" {{ request('body_type') == 'suv' ? 'selected' : '' }}>SUV</option>
                                    <option value="truck" {{ request('body_type') == 'truck' ? 'selected' : '' }}>Truck</option>
                                    <option value="coupe" {{ request('body_type') == 'coupe' ? 'selected' : '' }}>Coupe</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="price_range" class="form-label">Price Range</label>
                                <select name="price_range" id="price_range" class="form-select">
                                    <option value="">Any Price</option>
                                    <option value="0-10000" {{ request('price_range') == '0-10000' ? 'selected' : '' }}>Under $10,000</option>
                                    <option value="10000-20000" {{ request('price_range') == '10000-20000' ? 'selected' : '' }}>$10,000 - $20,000</option>
                                    <option value="20000-30000" {{ request('price_range') == '20000-30000' ? 'selected' : '' }}>$20,000 - $30,000</option>
                                    <option value="30000+" {{ request('price_range') == '30000+' ? 'selected' : '' }}>Over $30,000</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="sort" class="form-label">Sort By</label>
                                <select name="sort" id="sort" class="form-select">
                                    <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Newest First</option>
                                    <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Price: Low to High</option>
                                    <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Price: High to Low</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Apply Filters</button>
                                <a href="{{ route('cars.index') }}" class="btn btn-secondary">Clear Filters</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Cars Grid -->
        <div class="row">
            @foreach($cars as $car)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <div id="carousel-{{ $car->id }}" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach(json_decode($car->images) as $index => $image)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                <img src="{{ $image }}" class="d-block w-100" alt="{{ $car->title }}">
                            </div>
                            @endforeach
                        </div>
                        @if(count(json_decode($car->images)) > 1)
                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $car->id }}" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $car->id }}" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                        @endif
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->title }}</h5>
                        <p class="card-text">
                            <strong>Price:</strong> ${{ number_format($car->price, 2) }}<br>
                            <strong>Year:</strong> {{ $car->year }}<br>
                            <strong>Mileage:</strong> {{ number_format($car->mileage) }} km<br>
                            <strong>Condition:</strong> {{ ucfirst($car->condition) }}
                        </p>
                        <div class="d-grid gap-2">
                            <a href="{{ route('cars.show', $car) }}" class="btn btn-primary">View Details</a>
                            @auth
                            <a href="{{ route('bids.create', $car) }}" class="btn btn-outline-primary">Place Bid</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="row">
            <div class="col-12">
                {{ $cars->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
