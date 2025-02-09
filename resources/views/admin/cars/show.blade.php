@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Car Details</h1>
        <div>
            <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-info">
                <i class="material-icons align-middle">edit</i> Edit Car
            </a>
            <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">
                <i class="material-icons align-middle">arrow_back</i> Back to Cars
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Car Images -->
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Images</h6>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        @foreach(json_decode($car->images) as $image)
                            <div class="col-6">
                                <img src="{{ asset('storage/' . $image) }}" 
                                    alt="Car Image" 
                                    class="img-fluid rounded"
                                    style="width: 100%; height: 200px; object-fit: cover;">
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Car Details -->
        <div class="col-md-6 mb-4">
            <div class="card shadow h-100">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Details</h6>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th style="width: 150px;">Title</th>
                            <td>{{ $car->title }}</td>
                        </tr>
                        <tr>
                            <th>Make</th>
                            <td>{{ $car->make }}</td>
                        </tr>
                        <tr>
                            <th>Model</th>
                            <td>{{ $car->model }}</td>
                        </tr>
                        <tr>
                            <th>Year</th>
                            <td>{{ $car->year }}</td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td>${{ number_format($car->price) }}</td>
                        </tr>
                        <tr>
                            <th>Mileage</th>
                            <td>{{ number_format($car->mileage) }} km</td>
                        </tr>
                        <tr>
                            <th>Body Type</th>
                            <td>{{ ucfirst($car->body_type) }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>
                                <span class="badge {{ $car->status == 'available' ? 'bg-success' : 'bg-secondary' }}">
                                    {{ ucfirst($car->status) }}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Featured</th>
                            <td>
                                <i class="material-icons {{ $car->is_featured ? 'text-warning' : 'text-muted' }}">
                                    {{ $car->is_featured ? 'star' : 'star_border' }}
                                </i>
                            </td>
                        </tr>
                        <tr>
                            <th>Added</th>
                            <td>{{ $car->created_at->format('M d, Y H:i') }}</td>
                        </tr>
                        <tr>
                            <th>Last Updated</th>
                            <td>{{ $car->updated_at->format('M d, Y H:i') }}</td>
                        </tr>
                    </table>

                    <div class="mt-4">
                        <h6 class="font-weight-bold">Description</h6>
                        <p class="text-muted">{{ $car->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
