<div class="swiper-container hero-slider">
    <div class="swiper-wrapper">
        <div class="swiper-slide">
            <div class="hero-slide" style="background-image: url('{{ asset('images/slider/slide1.jpg') }}')">
                <div class="container">
                    <div class="hero-content">
                        <h1>Find Your Dream Car</h1>
                        <p>Explore our extensive collection of premium vehicles</p>
                        <a href="{{ route('cars.index') }}" class="btn btn-primary btn-lg">Browse Cars</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add more slides as needed -->
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
</div>