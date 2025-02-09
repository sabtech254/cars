@extends('layouts.app')

@section('content')
<!-- Hero Section with Slideshow -->
<div class="hero-section">
    <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"></button>
            <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{ asset('images/hero/luxury-car-1.jpg') }}" class="d-block w-100" alt="Luxury Car 1">
                <div class="carousel-caption">
                    <h1>Experience Luxury</h1>
                    <p>Discover our collection of premium vehicles</p>
                    <a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg">Browse Cars</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/hero/luxury-car-2.jpg') }}" class="d-block w-100" alt="Luxury Car 2">
                <div class="carousel-caption">
                    <h1>Premium Selection</h1>
                    <p>Find your dream car today</p>
                    <a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg">View Collection</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/hero/luxury-car-3.jpg') }}" class="d-block w-100" alt="Luxury Car 3">
                <div class="carousel-caption">
                    <h1>Ultimate Performance</h1>
                    <p>Experience power and precision</p>
                    <a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg">Explore Models</a>
                </div>
            </div>
            <div class="carousel-item">
                <img src="{{ asset('images/hero/luxury-car-4.jpg') }}" class="d-block w-100" alt="Luxury Car 4">
                <div class="carousel-caption">
                    <h1>Exclusive Deals</h1>
                    <p>Special offers on luxury vehicles</p>
                    <a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg">View Offers</a>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

<!-- Add custom styles for the hero section -->
<style>
.hero-section {
    margin-top: -24px; /* Offset the default navbar margin */
}

.carousel-item {
    height: 80vh;
    min-height: 500px;
    background: no-repeat center center scroll;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    background-size: cover;
}

.carousel-item img {
    object-fit: cover;
    height: 100%;
    width: 100%;
}

.carousel-caption {
    bottom: 20%;
    z-index: 2;
    text-align: center;
    padding: 20px;
}

.carousel-caption h1 {
    font-size: 4rem;
    font-weight: 700;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
    margin-bottom: 1rem;
}

.carousel-caption p {
    font-size: 1.5rem;
    text-shadow: 1px 1px 2px rgba(0,0,0,0.5);
    margin-bottom: 2rem;
}

.carousel-item::after {
    content: "";
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.4); /* Dark overlay for better text visibility */
}

.carousel-caption .btn-lg {
    padding: 15px 30px;
    font-size: 1.2rem;
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: all 0.3s ease;
}

.carousel-caption .btn-lg:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.3);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .carousel-caption h1 {
        font-size: 2.5rem;
    }
    .carousel-caption p {
        font-size: 1.1rem;
    }
    .carousel-caption .btn-lg {
        padding: 10px 20px;
        font-size: 1rem;
    }
}
</style>

<!-- Rest of your welcome page content -->
<div class="container mt-5">
    <!-- Featured Cars Section -->
    <section class="mb-5">
        <h2 class="mb-4">Featured Cars</h2>
        <div class="row">
            @foreach($featuredCars as $car)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ json_decode($car->images)[0] }}" class="card-img-top" alt="{{ $car->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->title }}</h5>
                        <p class="card-text">
                            <strong>Price:</strong> ${{ number_format($car->price, 2) }}<br>
                            <strong>Year:</strong> {{ $car->year }}<br>
                            <strong>Mileage:</strong> {{ number_format($car->mileage) }} km
                        </p>
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Recent Cars Section -->
    <section class="mb-5">
        <h2 class="mb-4">Recent Additions</h2>
        <div class="row">
            @foreach($recentCars as $car)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    <img src="{{ json_decode($car->images)[0] }}" class="card-img-top" alt="{{ $car->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->title }}</h5>
                        <p class="card-text">
                            <strong>Price:</strong> ${{ number_format($car->price, 2) }}<br>
                            <strong>Year:</strong> {{ $car->year }}<br>
                            <strong>Mileage:</strong> {{ number_format($car->mileage) }} km
                        </p>
                        <a href="{{ route('cars.show', $car) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>

    <!-- Quick Search Section -->
    <section class="bg-light p-4 rounded">
        <h2 class="mb-4">Quick Search</h2>
        <form action="{{ route('cars.index') }}" method="GET">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <select name="make" class="form-select">
                        <option value="">Select Make</option>
                        @foreach($makes as $make)
                        <option value="{{ $make }}">{{ $make }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <select name="body_type" class="form-select">
                        <option value="">Select Body Type</option>
                        <option value="sedan">Sedan</option>
                        <option value="suv">SUV</option>
                        <option value="truck">Truck</option>
                        <option value="coupe">Coupe</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <select name="price_range" class="form-select">
                        <option value="">Price Range</option>
                        <option value="0-10000">Under $10,000</option>
                        <option value="10000-20000">$10,000 - $20,000</option>
                        <option value="20000-30000">$20,000 - $30,000</option>
                        <option value="30000+">Over $30,000</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <button type="submit" class="btn btn-primary w-100">Search</button>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

@push('scripts')
<script>
    // Initialize the carousel with a 5-second interval
    document.addEventListener('DOMContentLoaded', function() {
        new bootstrap.Carousel(document.querySelector('#heroCarousel'), {
            interval: 5000
        });
    });
</script>
@endpush
