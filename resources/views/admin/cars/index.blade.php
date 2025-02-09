@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Manage Cars</h1>
        <div>
            <a href="{{ route('cars.create') }}" class="btn btn-primary">
                <i class="material-icons align-middle">add</i> Add New Car
            </a>
        </div>
    </div>

    <!-- Filters -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('cars.index') }}" method="GET" class="row g-3">
                <div class="col-md-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All Status</option>
                        <option value="available" {{ request('status') == 'available' ? 'selected' : '' }}>Available</option>
                        <option value="sold" {{ request('status') == 'sold' ? 'selected' : '' }}>Sold</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="make" class="form-label">Make</label>
                    <select name="make" id="make" class="form-select">
                        <option value="">All Makes</option>
                        @foreach($makes as $make)
                            <option value="{{ $make }}" {{ request('make') == $make ? 'selected' : '' }}>{{ $make }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="featured" class="form-label">Featured</label>
                    <select name="featured" id="featured" class="form-select">
                        <option value="">All</option>
                        <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Featured</option>
                        <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Not Featured</option>
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="material-icons align-middle">filter_list</i> Apply Filters
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Cars Table -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Make/Model</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Added</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($cars as $car)
                            <tr>
                                <td>
                                    @php
                                        $images = json_decode($car->images);
                                        $mainImage = $images[0] ?? '';
                                    @endphp
                                    <img src="{{ asset('storage/' . $mainImage) }}" 
                                        alt="{{ $car->title }}" 
                                        class="img-thumbnail" 
                                        style="width: 80px; height: 60px; object-fit: cover;">
                                </td>
                                <td>{{ $car->title }}</td>
                                <td>{{ $car->make }} {{ $car->model }}</td>
                                <td>${{ number_format($car->price) }}</td>
                                <td>
                                    <span class="badge {{ $car->status == 'available' ? 'bg-success' : 'bg-secondary' }}">
                                        {{ ucfirst($car->status) }}
                                    </span>
                                </td>
                                <td>
                                    <form action="{{ route('cars.toggle-featured', $car) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn btn-link p-0">
                                            <i class="material-icons {{ $car->is_featured ? 'text-warning' : 'text-muted' }}">
                                                {{ $car->is_featured ? 'star' : 'star_border' }}
                                            </i>
                                        </button>
                                    </form>
                                </td>
                                <td>{{ $car->created_at->diffForHumans() }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('cars.edit', $car) }}" class="btn btn-sm btn-info">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <a href="{{ route('cars.show', $car) }}" class="btn btn-sm btn-primary">
                                            <i class="material-icons">visibility</i>
                                        </a>
                                        <form action="{{ route('cars.destroy', $car) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" 
                                                onclick="return confirm('Are you sure you want to delete this car?')">
                                                <i class="material-icons">delete</i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="material-icons" style="font-size: 3rem;">directions_car</i>
                                        <p class="mt-2">No cars found</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {{ $cars->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
