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
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Car Details</h6>
                <span class="text-danger">* Required fields</span>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Basic Information -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Basic Information</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label">Title/Listing Name *</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                    id="title" name="title" value="{{ old('title') }}" required
                                    placeholder="e.g., 2023 Toyota Camry SE - Low Mileage">
                                @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="listing_type" class="form-label">Listing Type *</label>
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
                    </div>

                    <!-- Car Details -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Car Details</h5>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="make" class="form-label">Make *</label>
                                <input type="text" class="form-control @error('make') is-invalid @enderror" 
                                    id="make" name="make" value="{{ old('make') }}" required
                                    placeholder="e.g., Toyota">
                                @error('make')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="model" class="form-label">Model *</label>
                                <input type="text" class="form-control @error('model') is-invalid @enderror" 
                                    id="model" name="model" value="{{ old('model') }}" required
                                    placeholder="e.g., Camry">
                                @error('model')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="year" class="form-label">Year *</label>
                                <input type="number" class="form-control @error('year') is-invalid @enderror" 
                                    id="year" name="year" value="{{ old('year') }}" required 
                                    min="1900" max="{{ date('Y') + 1 }}"
                                    placeholder="e.g., 2023">
                                @error('year')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="condition" class="form-label">Condition *</label>
                                <select class="form-select @error('condition') is-invalid @enderror" 
                                    id="condition" name="condition" required>
                                    <option value="">Select Condition</option>
                                    <option value="new" {{ old('condition') === 'new' ? 'selected' : '' }}>New</option>
                                    <option value="used" {{ old('condition') === 'used' ? 'selected' : '' }}>Used</option>
                                </select>
                                @error('condition')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Technical Specifications -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Technical Specifications</h5>
                        <div class="row">
                            <div class="col-md-3 mb-3">
                                <label for="transmission" class="form-label">Transmission *</label>
                                <select class="form-select @error('transmission') is-invalid @enderror" 
                                    id="transmission" name="transmission" required>
                                    <option value="">Select Transmission</option>
                                    <option value="manual" {{ old('transmission') === 'manual' ? 'selected' : '' }}>Manual</option>
                                    <option value="automatic" {{ old('transmission') === 'automatic' ? 'selected' : '' }}>Automatic</option>
                                </select>
                                @error('transmission')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="fuel_type" class="form-label">Fuel Type *</label>
                                <select class="form-select @error('fuel_type') is-invalid @enderror" 
                                    id="fuel_type" name="fuel_type" required>
                                    <option value="">Select Fuel Type</option>
                                    <option value="petrol" {{ old('fuel_type') === 'petrol' ? 'selected' : '' }}>Petrol</option>
                                    <option value="diesel" {{ old('fuel_type') === 'diesel' ? 'selected' : '' }}>Diesel</option>
                                    <option value="hybrid" {{ old('fuel_type') === 'hybrid' ? 'selected' : '' }}>Hybrid</option>
                                    <option value="electric" {{ old('fuel_type') === 'electric' ? 'selected' : '' }}>Electric</option>
                                </select>
                                @error('fuel_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="mileage" class="form-label">Mileage *</label>
                                <div class="input-group">
                                    <input type="number" class="form-control @error('mileage') is-invalid @enderror" 
                                        id="mileage" name="mileage" value="{{ old('mileage') }}" required min="0"
                                        placeholder="e.g., 15000">
                                    <span class="input-group-text">miles</span>
                                </div>
                                @error('mileage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="body_type" class="form-label">Body Type *</label>
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

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="engine_size" class="form-label">Engine Size</label>
                                <div class="input-group">
                                    <input type="text" class="form-control @error('engine_size') is-invalid @enderror" 
                                        id="engine_size" name="engine_size" value="{{ old('engine_size') }}"
                                        placeholder="e.g., 2.5">
                                    <span class="input-group-text">L</span>
                                </div>
                                @error('engine_size')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="color" class="form-label">Color *</label>
                                <input type="text" class="form-control @error('color') is-invalid @enderror" 
                                    id="color" name="color" value="{{ old('color') }}" required
                                    placeholder="e.g., Midnight Blue">
                                @error('color')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Pricing and Auction -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Pricing Information</h5>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price *</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                                        id="price" name="price" value="{{ old('price') }}" required min="0" step="0.01"
                                        placeholder="e.g., 25000">
                                </div>
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3 auction-fields" style="display: none;">
                                <label for="auction_end" class="form-label">Auction End Date *</label>
                                <input type="datetime-local" class="form-control @error('auction_end') is-invalid @enderror" 
                                    id="auction_end" name="auction_end" value="{{ old('auction_end') }}">
                                @error('auction_end')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Additional Features -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Additional Information</h5>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description *</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="4" required
                                placeholder="Provide a detailed description of the car, including its features, history, and condition...">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="features" class="form-label">Features (one per line)</label>
                            <textarea class="form-control @error('features') is-invalid @enderror" 
                                id="features" name="features" rows="4"
                                placeholder="e.g.,
Leather Seats
Navigation System
Backup Camera
Bluetooth Connectivity">{{ old('features') }}</textarea>
                            @error('features')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured" 
                                    {{ old('is_featured') ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Feature this car on the homepage</label>
                            </div>
                        </div>
                    </div>

                    <!-- Images -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Car Images</h5>
                        <div class="mb-3">
                            <label for="images" class="form-label">Upload Images *</label>
                            <input type="file" class="form-control @error('images') is-invalid @enderror" 
                                id="images" name="images[]" multiple accept="image/*" required>
                            <div class="form-text">
                                - You can select multiple images<br>
                                - Supported formats: JPG, JPEG, PNG<br>
                                - Maximum size per image: 2MB<br>
                                - Recommended: Upload at least 5 images from different angles
                            </div>
                            @error('images')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Preview Images -->
                        <div id="imagePreview" class="row mb-3"></div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="material-icons align-middle">save</i> Create Car Listing
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
                auctionFields.style.display = 'block';
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
