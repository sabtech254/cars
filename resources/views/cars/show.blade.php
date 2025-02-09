@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <!-- Car Images -->
        <div class="col-md-8">
            <div id="carImageCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    @foreach(json_decode($car->images) as $index => $image)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ $image }}" class="d-block w-100" alt="Car Image {{ $index + 1 }}">
                    </div>
                    @endforeach
                </div>
                @if(count(json_decode($car->images)) > 1)
                <button class="carousel-control-prev" type="button" data-bs-target="#carImageCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carImageCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
                @endif
            </div>
        </div>

        <!-- Car Details -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">{{ $car->title }}</h2>
                    <h3 class="text-primary">${{ number_format($car->price, 2) }}</h3>
                    
                    @auth
                    <div class="mb-3">
                        <a href="{{ route('bids.create', $car) }}" class="btn btn-primary btn-lg w-100">Place Bid</a>
                    </div>
                    @else
                    <div class="mb-3">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg w-100">Login to Bid</a>
                    </div>
                    @endauth

                    <hr>

                    <h4>Quick Info</h4>
                    <ul class="list-unstyled">
                        <li><strong>Make:</strong> {{ $car->make }}</li>
                        <li><strong>Model:</strong> {{ $car->model }}</li>
                        <li><strong>Year:</strong> {{ $car->year }}</li>
                        <li><strong>Mileage:</strong> {{ number_format($car->mileage) }} km</li>
                        <li><strong>Condition:</strong> {{ ucfirst($car->condition) }}</li>
                        <li><strong>Body Type:</strong> {{ ucfirst($car->body_type) }}</li>
                        <li><strong>Transmission:</strong> {{ ucfirst($car->transmission) }}</li>
                        <li><strong>Fuel Type:</strong> {{ ucfirst($car->fuel_type) }}</li>
                        <li><strong>Color:</strong> {{ ucfirst($car->color) }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Description and Features -->
    <div class="row mt-4">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h4>Description</h4>
                    <p>{{ $car->description }}</p>

                    @if($car->features)
                    <h4 class="mt-4">Features</h4>
                    <ul class="list-group list-group-flush">
                        @foreach(json_decode($car->features) as $feature)
                        <li class="list-group-item">{{ $feature }}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
            </div>
        </div>

        <!-- Contact Seller -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4>Contact Seller</h4>
                    <p>Posted by: {{ $car->user->name }}</p>
                    @auth
                    <form action="{{ route('contact.seller') }}" method="POST">
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Message</button>
                    </form>
                    @else
                    <p>Please <a href="{{ route('login') }}">login</a> to contact the seller.</p>
                    @endauth
                </div>
            </div>
        </div>
    </div>

    <!-- Similar Cars -->
    <div class="row mt-4">
        <div class="col-12">
            <h3>Similar Cars</h3>
            <div class="row">
                @foreach($similarCars as $similarCar)
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="{{ json_decode($similarCar->images)[0] }}" class="card-img-top" alt="{{ $similarCar->title }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $similarCar->title }}</h5>
                            <p class="card-text">
                                <strong>Price:</strong> ${{ number_format($similarCar->price, 2) }}<br>
                                <strong>Year:</strong> {{ $similarCar->year }}
                            </p>
                            <a href="{{ route('cars.show', $similarCar) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
