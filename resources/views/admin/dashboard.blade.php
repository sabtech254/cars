@extends('layouts.admin')

@section('main-content')
    <div class="container-fluid">
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Dashboard Overview</h1>
            <div>
                <a href="{{ route('admin.cars.create') }}" class="btn btn-primary">
                    <i class="material-icons align-middle">add</i> Add New Car
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Cars</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCars }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="material-icons text-gray-300" style="font-size: 2rem;">directions_car</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Cars For Sale</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $carsForSale }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="material-icons text-gray-300" style="font-size: 2rem;">sell</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Cars For Auction</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $carsForAuction }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="material-icons text-gray-300" style="font-size: 2rem;">gavel</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Active Bids</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeBids }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="material-icons text-gray-300" style="font-size: 2rem;">local_offer</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity and Quick Actions -->
        <div class="row">
            <!-- Recent Activity -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                    </div>
                    <div class="card-body">
                        @if($recentActivities->count() > 0)
                            <div class="list-group list-group-flush">
                                @foreach($recentActivities as $activity)
                                    <div class="list-group-item">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h6 class="mb-1">{{ $activity->description }}</h6>
                                            <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mb-1">{{ $activity->user->name }}</p>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center text-muted my-3">No recent activity</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('admin.cars.create') }}" class="btn btn-primary btn-block">
                                <i class="material-icons align-middle">add_circle</i> Add New Car
                            </a>
                            <a href="{{ route('admin.cars.sale') }}" class="btn btn-success btn-block">
                                <i class="material-icons align-middle">sell</i> View Cars For Sale
                            </a>
                            <a href="{{ route('admin.cars.auction') }}" class="btn btn-warning btn-block">
                                <i class="material-icons align-middle">gavel</i> View Cars For Auction
                            </a>
                            <a href="{{ route('admin.inquiries.index') }}" class="btn btn-info btn-block">
                                <i class="material-icons align-middle">mail</i> View Inquiries
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Cars Row -->
        <div class="row">
            <!-- Recent Cars For Sale -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Recent Cars For Sale</h6>
                        <a href="{{ route('admin.cars.sale') }}" class="btn btn-sm btn-primary">View All</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Car</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentSaleCars as $car)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $images = json_decode($car->images);
                                                        $mainImage = $images[0] ?? '';
                                                    @endphp
                                                    <img src="{{ asset('storage/' . $mainImage) }}" 
                                                        alt="{{ $car->title }}" 
                                                        class="img-thumbnail me-2" 
                                                        style="width: 50px; height: 40px; object-fit: cover;">
                                                    <div>
                                                        <div class="font-weight-bold">{{ $car->title }}</div>
                                                        <small class="text-muted">{{ $car->make }} {{ $car->model }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">${{ number_format($car->price) }}</td>
                                            <td class="align-middle">
                                                <span class="badge {{ $car->status == 'available' ? 'bg-success' : 'bg-secondary' }}">
                                                    {{ ucfirst($car->status) }}
                                                </span>
                                            </td>
                                            <td class="align-middle">
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-sm btn-info">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <a href="{{ route('admin.cars.show', $car) }}" class="btn btn-sm btn-primary">
                                                        <i class="material-icons">visibility</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="material-icons" style="font-size: 3rem;">directions_car</i>
                                                    <p class="mt-2">No cars for sale</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Cars For Auction -->
            <div class="col-lg-6 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Recent Cars For Auction</h6>
                        <a href="{{ route('admin.cars.auction') }}" class="btn btn-sm btn-primary">View All</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Car</th>
                                        <th>Starting Price</th>
                                        <th>Current Bid</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentAuctionCars as $car)
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @php
                                                        $images = json_decode($car->images);
                                                        $mainImage = $images[0] ?? '';
                                                    @endphp
                                                    <img src="{{ asset('storage/' . $mainImage) }}" 
                                                        alt="{{ $car->title }}" 
                                                        class="img-thumbnail me-2" 
                                                        style="width: 50px; height: 40px; object-fit: cover;">
                                                    <div>
                                                        <div class="font-weight-bold">{{ $car->title }}</div>
                                                        <small class="text-muted">{{ $car->make }} {{ $car->model }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle">${{ number_format($car->price) }}</td>
                                            <td class="align-middle">
                                                @if($car->highest_bid)
                                                    ${{ number_format($car->highest_bid) }}
                                                @else
                                                    <span class="text-muted">No bids</span>
                                                @endif
                                            </td>
                                            <td class="align-middle">
                                                <div class="btn-group">
                                                    <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-sm btn-info">
                                                        <i class="material-icons">edit</i>
                                                    </a>
                                                    <a href="{{ route('admin.cars.show', $car) }}" class="btn btn-sm btn-primary">
                                                        <i class="material-icons">visibility</i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center py-4">
                                                <div class="text-muted">
                                                    <i class="material-icons" style="font-size: 3rem;">gavel</i>
                                                    <p class="mt-2">No cars for auction</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
