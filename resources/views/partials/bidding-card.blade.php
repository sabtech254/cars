<div class="card h-100">
    <div class="card-header bg-primary text-white">
        <div class="countdown" data-ends="{{ $car->auction_ends_at }}">
            Time Left: <span class="countdown-timer"></span>
        </div>
    </div>
    <img src="{{ asset('images/cars/' . $car->image) }}" class="card-img-top" alt="{{ $car->make }} {{ $car->model }}">
    <div class="card-body">
        <h5 class="card-title">{{ $car->make }} {{ $car->model }}</h5>
        <p class="card-text">
            <strong>Current Bid:</strong> ${{ number_format($car->current_bid, 2) }}<br>
            <small class="text-muted">{{ $car->bids_count }} bids</small>
        </p>
        <form action="{{ route('bidding.place') }}" method="POST" class="bid-form">
            @csrf
            <input type="hidden" name="car_id" value="{{ $car->id }}">
            <div class="input-group mb-3">
                <input type="number" class="form-control" name="bid_amount" placeholder="Enter bid amount" step="100">
                <button class="btn btn-primary" type="submit">Place Bid</button>
            </div>
        </form>
    </div>
</div>