<x-app-layout>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h1 class="text-center mb-4">About Us</h1>
                        
                        <div class="mb-4">
                            <h4>Welcome to Our Car Dealership</h4>
                            <p>We are dedicated to providing the best experience for our customers in their journey to find the perfect vehicle. With years of experience in the automotive industry, we pride ourselves on our commitment to excellence and customer satisfaction.</p>
                        </div>

                        <div class="mb-4">
                            <h4>Our Mission</h4>
                            <p>To provide high-quality vehicles and exceptional customer service while maintaining transparency and integrity in all our dealings.</p>
                        </div>

                        <div class="mb-4">
                            <h4>Why Choose Us?</h4>
                            <div class="row g-4 mt-2">
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <i class="material-icons text-primary me-2">verified</i>
                                        <div>
                                            <h5>Quality Assurance</h5>
                                            <p>All our vehicles undergo thorough inspection</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <i class="material-icons text-primary me-2">support_agent</i>
                                        <div>
                                            <h5>Expert Support</h5>
                                            <p>Professional guidance throughout your purchase</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <i class="material-icons text-primary me-2">local_offer</i>
                                        <div>
                                            <h5>Best Prices</h5>
                                            <p>Competitive pricing and financing options</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex align-items-start">
                                        <i class="material-icons text-primary me-2">update</i>
                                        <div>
                                            <h5>Quick Process</h5>
                                            <p>Streamlined buying and selling process</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('cars.index') }}" class="btn btn-primary">Browse Our Cars</a>
                            <a href="{{ route('contact') }}" class="btn btn-outline-primary ms-2">Contact Us</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
