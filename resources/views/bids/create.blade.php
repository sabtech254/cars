@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Submit a Bid</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('bids.store') }}">
                        @csrf
                        <input type="hidden" name="car_id" value="{{ $car->id }}">

                        <div class="form-group mb-3">
                            <label for="amount">Bid Amount</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control" id="amount" name="amount" step="0.01" min="0" required>
                            </div>
                        </div>

                        <div class="form-group mb-3">
                            <label for="notes">Additional Notes (Optional)</label>
                            <textarea class="form-control" id="notes" name="notes" rows="3"></textarea>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit Bid</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
