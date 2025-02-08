@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">My Profile</h5>
                    <p class="card-text">{{ Auth::user()->name }}</p>
                    <p class="card-text">{{ Auth::user()->email }}</p>
                    <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit Profile</a>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">My Bids</h5>
                </div>
                <div class="card-body">
                    @if($bids->count() > 0)
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Car</th>
                                        <th>Bid Amount</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bids as $bid)
                                    <tr>
                                        <td>{{ $bid->car->make }} {{ $bid->car->model }}</td>
                                        <td>${{ number_format($bid->bid_amount, 2) }}</td>
                                        <td>{{ $bid->created_at->format('M d, Y H:i') }}</td>
                                        <td>
                                            @if($bid->is_winning)
                                                <span class="badge bg-success">Winning</span>
                                            @else
                                                <span class="badge bg-secondary">Outbid</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-center">You haven't placed any bids yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection