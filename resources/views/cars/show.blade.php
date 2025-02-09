<x-app-layout>
    <div class="container py-4">
        <div class="row">
            <!-- Car Images -->
            <div class="col-md-8">
                <div id="carImageCarousel" class="carousel slide mb-4" data-bs-ride="carousel">
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
                <div class="card mb-4">
                    <div class="card-body">
                        <h2 class="card-title">{{ $car->title }}</h2>
                        <p class="h3 text-primary mb-4">${{ number_format($car->price, 2) }}</p>
                        
                        <div class="mb-4">
                            <h5>Key Details</h5>
                            <ul class="list-unstyled">
                                <li><strong>Make:</strong> {{ $car->make }}</li>
                                <li><strong>Model:</strong> {{ $car->model }}</li>
                                <li><strong>Year:</strong> {{ $car->year }}</li>
                                <li><strong>Mileage:</strong> {{ number_format($car->mileage) }} km</li>
                                <li><strong>Condition:</strong> {{ ucfirst($car->condition) }}</li>
                                <li><strong>Body Type:</strong> {{ ucfirst($car->body_type) }}</li>
                                <li><strong>Transmission:</strong> {{ ucfirst($car->transmission) }}</li>
                                <li><strong>Fuel Type:</strong> {{ ucfirst($car->fuel_type) }}</li>
                            </ul>
                        </div>

                        <div class="d-grid gap-2">
                            @auth
                                <a href="{{ route('bids.create', $car) }}" class="btn btn-primary">
                                    <i class="material-icons align-middle">gavel</i> Place Bid
                                </a>
                                @if(auth()->user()->is_admin)
                                    <a href="{{ route('cars.edit', $car) }}" class="btn btn-secondary">
                                        <i class="material-icons align-middle">edit</i> Edit Car
                                    </a>
                                    <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger w-100" onclick="return confirm('Are you sure you want to delete this car?')">
                                            <i class="material-icons align-middle">delete</i> Delete Car
                                        </button>
                                    </form>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="btn btn-primary">Login to Place Bid</a>
                            @endauth
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Contact Information</h5>
                        <p class="card-text">
                            <i class="material-icons align-middle">phone</i> +1234567890<br>
                            <i class="material-icons align-middle">email</i> info@cardealer.com<br>
                            <i class="material-icons align-middle">location_on</i> 123 Car Street, Auto City
                        </p>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="col-12 mt-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Description</h5>
                        <p class="card-text">{{ $car->description }}</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-4">
            <a href="{{ route('cars.index') }}" class="btn btn-outline-primary">
                <i class="material-icons align-middle">arrow_back</i> Back to Cars
            </a>
        </div>
    </div>
</x-app-layout>
