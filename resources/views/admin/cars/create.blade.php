@extends('layouts.admin')

@section('main-content')
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Add New Car</h1>
            <a href="{{ route('admin.cars.sale') }}" class="btn btn-secondary">
                <i class="material-icons align-middle">arrow_back</i> Back to Cars
            </a>
        </div>

        <!-- Create Car Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Car Details</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Basic Information -->
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="listing_type" class="form-label">Listing Type</label>
                            <select class="form-select @error('listing_type') is-invalid @enderror" 
                                id="listing_type" name="listing_type" required>
                                <option value="">Select Type</option>
                                <option value="sale" {{ old('listing_type') === 'sale' ? 'selected' : '' }}>For Sale</option>
                                <option value="auction" {{ old('listing_type') === 'auction' ? 'selected' : '' }}>For Auction</option>
                            </select>
                            @error('listing_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Car Details -->
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="make" class="form-label">Make</label>
                            <input type="text" class="form-control @error('make') is-invalid @enderror" 
                                id="make" name="make" value="{{ old('make') }}" required>
                            @error('make')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="model" class="form-label">Model</label>
                            <input type="text" class="form-control @error('model') is-invalid @enderror" 
                                id="model" name="model" value="{{ old('model') }}" required>
                            @error('model')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="year" class="form-label">Year</label>
                            <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                id="year" name="year" value="{{ old('year') }}" required min="1900" max="{{ date('Y') + 1 }}">
                            @error('year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="price" class="form-label">Price</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                    id="price" name="price" value="{{ old('price') }}" required min="0" step="0.01">
                            </div>
                            @error('price')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="mileage" class="form-label">Mileage</label>
                            <div class="input-group">
                                <input type="number" class="form-control @error('mileage') is-invalid @enderror" 
                                    id="mileage" name="mileage" value="{{ old('mileage') }}" required min="0">
                                <span class="input-group-text">miles</span>
                            </div>
                            @error('mileage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="body_type" class="form-label">Body Type</label>
                            <select class="form-select @error('body_type') is-invalid @enderror" 
                                id="body_type" name="body_type" required>
                                <option value="">Select Type</option>
                                <option value="sedan" {{ old('body_type') === 'sedan' ? 'selected' : '' }}>Sedan</option>
                                <option value="suv" {{ old('body_type') === 'suv' ? 'selected' : '' }}>SUV</option>
                                <option value="hatchback" {{ old('body_type') === 'hatchback' ? 'selected' : '' }}>Hatchback</option>
                                <option value="truck" {{ old('body_type') === 'truck' ? 'selected' : '' }}>Truck</option>
                                <option value="van" {{ old('body_type') === 'van' ? 'selected' : '' }}>Van</option>
                            </select>
                            @error('body_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Auction End Date (shown only for auction listings) -->
                    <div class="row auction-fields" style="display: none;">
                        <div class="col-md-6 mb-3">
                            <label for="auction_end" class="form-label">Auction End Date</label>
                            <input type="datetime-local" class="form-control @error('auction_end') is-invalid @enderror" 
                                id="auction_end" name="auction_end" value="{{ old('auction_end') }}">
                            @error('auction_end')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                            id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Featured Status -->
                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" 
                                {{ old('is_featured') ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_featured">Feature this car</label>
                        </div>
                    </div>

                    <!-- Images -->
                    <div class="mb-3">
                        <label for="images" class="form-label">Images</label>
                        <input type="file" class="form-control @error('images') is-invalid @enderror" 
                            id="images" name="images[]" multiple accept="image/*" required>
                        <div class="form-text">You can select multiple images. Maximum size per image: 2MB</div>
                        @error('images')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Preview Images -->
                    <div id="imagePreview" class="row mb-3"></div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="material-icons align-middle">save</i> Create Car
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        // Show/hide auction end date based on listing type
        document.getElementById('listing_type').addEventListener('change', function() {
            const auctionFields = document.querySelector('.auction-fields');
            const auctionEnd = document.getElementById('auction_end');
            
            if (this.value === 'auction') {
                auctionFields.style.display = 'flex';
                auctionEnd.required = true;
            } else {
                auctionFields.style.display = 'none';
                auctionEnd.required = false;
            }
        });

        // Image preview
        document.getElementById('images').addEventListener('change', function() {
            const preview = document.getElementById('imagePreview');
            preview.innerHTML = '';

            for (const file of this.files) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-2 mb-2';
                    
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'img-thumbnail';
                    img.style = 'width: 100%; height: 150px; object-fit: cover;';
                    
                    col.appendChild(img);
                    preview.appendChild(col);
                }
                reader.readAsDataURL(file);
            }
        });

        // Trigger listing type change event on page load if value is preset
        window.addEventListener('load', function() {
            const listingType = document.getElementById('listing_type');
            if (listingType.value) {
                listingType.dispatchEvent(new Event('change'));
            }
        });
    </script>
    @endpush
@endsection
