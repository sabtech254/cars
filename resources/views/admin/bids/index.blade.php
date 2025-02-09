@extends('layouts.admin')

@section('main-content')
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Manage Bids</h1>
        </div>

        <!-- Bids List -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">All Bids</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Car</th>
                                <th>Bidder</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($bids as $bid)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            @php
                                                $images = json_decode($bid->car->images);
                                                $mainImage = $images[0] ?? '';
                                            @endphp
                                            <img src="{{ asset('storage/' . $mainImage) }}" 
                                                alt="{{ $bid->car->title }}" 
                                                class="img-thumbnail me-2" 
                                                style="width: 50px; height: 40px; object-fit: cover;">
                                            <div>
                                                <div class="font-weight-bold">{{ $bid->car->title }}</div>
                                                <small class="text-muted">{{ $bid->car->make }} {{ $bid->car->model }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $bid->user->name }}</td>
                                    <td>${{ number_format($bid->amount) }}</td>
                                    <td>
                                        <span class="badge {{ $bid->status == 'active' ? 'bg-success' : ($bid->status == 'rejected' ? 'bg-danger' : 'bg-secondary') }}">
                                            {{ ucfirst($bid->status) }}
                                        </span>
                                    </td>
                                    <td>{{ $bid->created_at->format('M d, Y H:i') }}</td>
                                    <td>
                                        <div class="btn-group">
                                            @if($bid->status == 'active')
                                                <form action="{{ route('admin.bids.approve', $bid) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-success" title="Approve Bid">
                                                        <i class="material-icons">check</i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.bids.reject', $bid) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('PUT')
                                                    <button type="submit" class="btn btn-sm btn-danger" title="Reject Bid">
                                                        <i class="material-icons">close</i>
                                                    </button>
                                                </form>
                                            @endif
                                            <a href="{{ route('admin.bids.show', $bid) }}" class="btn btn-sm btn-primary" title="View Details">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">
                                        <div class="text-muted">
                                            <i class="material-icons" style="font-size: 3rem;">local_offer</i>
                                            <p class="mt-2">No bids found</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-end mt-3">
                    {{ $bids->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
