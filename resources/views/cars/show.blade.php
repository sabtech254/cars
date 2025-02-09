<x-app-layout>
    <div class="container py-8">
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
                            <li><strong>Status:</strong> {{ ucfirst($car->status) }}</li>
                        </ul>

                        <hr>

                        <!-- Contact Seller Form -->
                        @auth
                            @if(auth()->id() !== $car->user_id)
                                <div class="mt-4">
                                    <h4>Contact Seller</h4>
                                    <form action="{{ route('cars.contact', $car) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="phone" class="form-label">Your Phone Number</label>
                                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                                id="phone" name="phone" value="{{ old('phone') }}" required>
                                            @error('phone')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="message" class="form-label">Message</label>
                                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                                id="message" name="message" rows="4" required>{{ old('message') }}</textarea>
                                            @error('message')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <button type="submit" class="btn btn-success w-100">Send Message</button>
                                    </form>
                                </div>
                            @endif
                        @else
                            <div class="mt-4">
                                <p class="text-center">Please <a href="{{ route('login') }}">login</a> to contact the seller.</p>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        <!-- Car Description -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Description</h3>
                        <p>{{ $car->description }}</p>
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
                    <div class="col-md-4 mb-4">
                        <div class="card">
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

    @if(session('success'))
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Success</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ session('success') }}
            </div>
        </div>
    </div>
    @endif
</x-app-layout>
