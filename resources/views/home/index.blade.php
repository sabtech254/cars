@extends('layouts.app')

@section('title', 'Welcome to Car Dealer')

@section('content')
    @include('partials.slideshow')
    
    <!-- Bidding Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="mb-4">Live Auctions</h2>
            <div class="row">
                @foreach($biddingCars as $car)
                    <div class="col-md-4 mb-4">
                        @include('partials.bidding-card', ['car' => $car])
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Featured Cars -->
    <section class="py-5">
        <div class="container">
            <h2 class="mb-4">Featured Cars</h2>
            <div class="row">
                @foreach($featuredCars as $car)
                    <div class="col-md-4 mb-4">
                        @include('partials.car-card', ['car' => $car])
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Latest Cars -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="mb-4">Latest Arrivals</h2>
            <div class="row">
                @foreach($latestCars as $car)
                    <div class="col-md-3 mb-4">
                        @include('partials.car-card', ['car' => $car])
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection