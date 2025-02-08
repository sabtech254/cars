<div class="card h-100">
    <img src="{{ asset('images/cars/' . $car->image) }}" class="card-img-top" alt="{{ $car->make }} {{ $car->model }}">
    <div class="card-body">
        <h5 class="card-title">{{ $car->make }} {{ $car->model }}</h5>
        <p class="card-text">
            <strong>Price:</strong> ${{ number_format($car->price, 2) }}<br>
            <small class="text-muted">{{ $car->year }} • {{ $car->mileage }}km</small>
        </p>
        <a href="{{ route('cars.show', $car) }}" class="btn btn-primary">View Details</a>
    </div>
</div>