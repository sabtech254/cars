@extends('layouts.admin')

@section('main-content')
<div class="container-fluid">
    <!-- Page Title -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Edit Car: {{ $car->title }}</h1>
        <a href="{{ route('admin.cars.index') }}" class="btn btn-secondary">
            <i class="material-icons align-middle">arrow_back</i> Back to Cars
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-body">
            <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <!-- Basic Information -->
                    <div class="col-md-8">
                        <h5 class="mb-4">Basic Information</h5>
                        
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                id="title" name="title" value="{{ old('title', $car->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="make" class="form-label">Make</label>
                                    <input type="text" class="form-control @error('make') is-invalid @enderror" 
                                        id="make" name="make" value="{{ old('make', $car->make) }}" required>
                                    @error('make')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="model" class="form-label">Model</label>
                                    <input type="text" class="form-control @error('model') is-invalid @enderror" 
                                        id="model" name="model" value="{{ old('model', $car->model) }}" required>
                                    @error('model')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="year" class="form-label">Year</label>
                                    <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                        id="year" name="year" value="{{ old('year', $car->year) }}" required>
                                    @error('year')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="mileage" class="form-label">Mileage</label>
                                    <input type="number" class="form-control @error('mileage') is-invalid @enderror" 
                                        id="mileage" name="mileage" value="{{ old('mileage', $car->mileage) }}" required>
                                    @error('mileage')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                        id="price" name="price" value="{{ old('price', $car->price) }}" required>
                                    @error('price')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="4" required>{{ old('description', $car->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Additional Information -->
                    <div class="col-md-4">
                        <h5 class="mb-4">Additional Information</h5>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                                <option value="available" {{ old('status', $car->status) == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="sold" {{ old('status', $car->status) == 'sold' ? 'selected' : '' }}>Sold</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="body_type" class="form-label">Body Type</label>
                            <select class="form-select @error('body_type') is-invalid @enderror" 
                                id="body_type" name="body_type" required>
                                <option value="sedan" {{ old('body_type', $car->body_type) == 'sedan' ? 'selected' : '' }}>Sedan</option>
                                <option value="suv" {{ old('body_type', $car->body_type) == 'suv' ? 'selected' : '' }}>SUV</option>
                                <option value="hatchback" {{ old('body_type', $car->body_type) == 'hatchback' ? 'selected' : '' }}>Hatchback</option>
                                <option value="truck" {{ old('body_type', $car->body_type) == 'truck' ? 'selected' : '' }}>Truck</option>
                                <option value="van" {{ old('body_type', $car->body_type) == 'van' ? 'selected' : '' }}>Van</option>
                            </select>
                            @error('body_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" 
                                    id="is_featured" name="is_featured" value="1" 
                                    {{ old('is_featured', $car->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Featured Car</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Add More Images</label>
                            <input type="file" class="form-control @error('images') is-invalid @enderror" 
                                id="images" name="images[]" multiple accept="image/*">
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Current Images -->
                        @if($car->images)
                            <div class="mb-3">
                                <label class="form-label">Current Images</label>
                                <div class="row g-2">
                                    @foreach(json_decode($car->images) as $index => $image)
                                        <div class="col-6">
                                            <div class="position-relative">
                                                <img src="{{ asset('storage/' . $image) }}" 
                                                    alt="Car Image {{ $index + 1 }}" 
                                                    class="img-thumbnail w-100"
                                                    style="height: 100px; object-fit: cover;">
                                                <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1"
                                                    onclick="removeImage({{ $index }})">
                                                    <i class="material-icons">close</i>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <input type="hidden" name="removed_images" id="removed_images" value="">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons align-middle">save</i> Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let removedImages = [];

    function removeImage(index) {
        removedImages.push(index);
        document.getElementById('removed_images').value = JSON.stringify(removedImages);
        event.target.closest('.col-6').style.display = 'none';
    }
</script>
@endpush
@endsection
