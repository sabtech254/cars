@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Cars</h2>
        <a href="{{ route('admin.cars.create') }}" class="btn btn-primary">Add New Car</a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Make/Model</th>
                            <th>Year</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $car)
                            <tr>
                                <td>{{ $car->id }}</td>
                                <td>{{ $car->make }} {{ $car->model }}</td>
                                <td>{{ $car->year }}</td>
                                <td>${{ number_format($car->price, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $car->status === 'sold' ? 'success' : 'primary' }}">
                                        {{ ucfirst($car->status) }}
                                    </span>
                                </td>
                                <td>
                                    @if($car->is_featured)
                                        <span class="badge bg-warning">Featured</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('admin.cars.edit', $car) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                                        <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">
                {{ $cars->links() }}
            </div>
        </div>
    </div>
</div>
@endsection