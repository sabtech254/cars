@extends('layouts.admin')

@section('main-content')
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Site Settings</h1>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Settings Form -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">General Settings</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.settings.update') }}" method="POST">
                    @csrf

                    <!-- Site Information -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Site Information</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="site_name" class="form-label">Site Name</label>
                                <input type="text" class="form-control @error('site_name') is-invalid @enderror" 
                                    id="site_name" name="site_name" 
                                    value="{{ old('site_name', $settings['site_name'] ?? '') }}" required>
                                @error('site_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="currency_symbol" class="form-label">Currency Symbol</label>
                                <input type="text" class="form-control @error('currency_symbol') is-invalid @enderror" 
                                    id="currency_symbol" name="currency_symbol" 
                                    value="{{ old('currency_symbol', $settings['currency_symbol'] ?? '') }}" required>
                                @error('currency_symbol')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="site_description" class="form-label">Site Description</label>
                            <textarea class="form-control @error('site_description') is-invalid @enderror" 
                                id="site_description" name="site_description" rows="3" required>{{ old('site_description', $settings['site_description'] ?? '') }}</textarea>
                            @error('site_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Contact Information -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Contact Information</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="contact_email" class="form-label">Contact Email</label>
                                <input type="email" class="form-control @error('contact_email') is-invalid @enderror" 
                                    id="contact_email" name="contact_email" 
                                    value="{{ old('contact_email', $settings['contact_email'] ?? '') }}" required>
                                @error('contact_email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="contact_phone" class="form-label">Contact Phone</label>
                                <input type="text" class="form-control @error('contact_phone') is-invalid @enderror" 
                                    id="contact_phone" name="contact_phone" 
                                    value="{{ old('contact_phone', $settings['contact_phone'] ?? '') }}" required>
                                @error('contact_phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea class="form-control @error('address') is-invalid @enderror" 
                                id="address" name="address" rows="2" required>{{ old('address', $settings['address'] ?? '') }}</textarea>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Social Media Links -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Social Media Links</h5>
                        
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="facebook_url" class="form-label">Facebook URL</label>
                                <input type="url" class="form-control @error('facebook_url') is-invalid @enderror" 
                                    id="facebook_url" name="facebook_url" 
                                    value="{{ old('facebook_url', $settings['facebook_url'] ?? '') }}">
                                @error('facebook_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="twitter_url" class="form-label">Twitter URL</label>
                                <input type="url" class="form-control @error('twitter_url') is-invalid @enderror" 
                                    id="twitter_url" name="twitter_url" 
                                    value="{{ old('twitter_url', $settings['twitter_url'] ?? '') }}">
                                @error('twitter_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="instagram_url" class="form-label">Instagram URL</label>
                                <input type="url" class="form-control @error('instagram_url') is-invalid @enderror" 
                                    id="instagram_url" name="instagram_url" 
                                    value="{{ old('instagram_url', $settings['instagram_url'] ?? '') }}">
                                @error('instagram_url')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Site Configuration -->
                    <div class="mb-4">
                        <h5 class="border-bottom pb-2">Site Configuration</h5>
                        
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="featured_cars_limit" class="form-label">Featured Cars Limit</label>
                                <input type="number" class="form-control @error('featured_cars_limit') is-invalid @enderror" 
                                    id="featured_cars_limit" name="featured_cars_limit" 
                                    value="{{ old('featured_cars_limit', $settings['featured_cars_limit'] ?? '6') }}"
                                    min="1" max="20" required>
                                @error('featured_cars_limit')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="auction_duration_days" class="form-label">Default Auction Duration (Days)</label>
                                <input type="number" class="form-control @error('auction_duration_days') is-invalid @enderror" 
                                    id="auction_duration_days" name="auction_duration_days" 
                                    value="{{ old('auction_duration_days', $settings['auction_duration_days'] ?? '7') }}"
                                    min="1" max="30" required>
                                @error('auction_duration_days')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="material-icons align-middle">save</i> Save Settings
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
