@extends('layouts.app')

@section('content')
<div class="container py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('cars.index') }}">Cars</a></li>
            <li class="breadcrumb-item active">{{ $car->year }} {{ $car->make }} {{ $car->model }}</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-8">
            <!-- Car Images -->
            <div class="card mb-4">
                <div class="swiper car-gallery">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <img src="{{ asset('images/cars/' . ($car->image ?? 'default.jpg')) }}" class="card-img-top" alt="{{ $car->make }} {{ $car->model }}">
                        </div>
                        <!-- Add more images here -->
                    </div>
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
            </div>

            <!-- Car Details -->
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-title">{{ $car->year }} {{ $car->make }} {{ $car->model }}</h2>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Price:</strong> ${{ number_format($car->price, 2) }}</p>
                            <p class="mb-1"><strong>Mileage:</strong> {{ number_format($car->mileage) }} miles</p>
                            <p class="mb-1"><strong>Transmission:</strong> {{ $car->transmission }}</p>
                            <p class="mb-1"><strong>Fuel Type:</strong> {{ $car->fuel_type }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-1"><strong>Engine Size:</strong> {{ $car->engine_size }}</p>
                            <p class="mb-1"><strong>Color:</strong> {{ $car->color }}</p>
                            <p class="mb-1"><strong>Condition:</strong> {{ $car->condition }}</p>
                            <p class="mb-1"><strong>Status:</strong> {{ ucfirst($car->status) }}</p>
                        </div>
                    </div>

                    <h4>Description</h4>
                    <p>{{ $car->description }}</p>

                    <h4>Features</h4>
                    <div class="row">
                        @foreach($car->features as $feature)
                            <div class="col-md-4 mb-2">
                                <i class="fas fa-check text-success"></i> {{ $feature }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Contact Form -->
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">Interested in this car?</h4>
                    <form action="{{ route('inquiries.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $car->id }}">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="tel" class="form-control" name="phone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea class="form-control" name="message" rows="4" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Send Inquiry</button>
                    </form>
                </div>
            </div>

            <!-- Similar Cars -->
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Similar Cars</h4>
                    <!-- Add similar cars here -->
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    // Initialize Swiper
    const swiper = new Swiper('.car-gallery', {
        loop: true,
        pagination: {
            el: '.swiper-pagination',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
        },
    });
</script>
@endpush
@endsection