<footer class="bg-dark text-light py-5 mt-auto">
    <div class="container">
        <div class="row">
            <!-- Company Info -->
            <div class="col-lg-4 mb-4 mb-lg-0">
                <h5 class="text-primary mb-4">AutoMarket</h5>
                <p class="mb-4">Your trusted destination for buying and selling quality vehicles. We connect car enthusiasts with their dream cars.</p>
                <div class="social-links">
                    <a href="#" class="text-light me-3"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-light me-3"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-light me-3"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-light"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                <h6 class="text-uppercase mb-4">Quick Links</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="{{ route('home') }}" class="text-light text-decoration-none">Home</a></li>
                    <li class="mb-2"><a href="{{ route('cars.index') }}" class="text-light text-decoration-none">Cars</a></li>
                    <li class="mb-2"><a href="{{ route('auctions') }}" class="text-light text-decoration-none">Auctions</a></li>
                    <li class="mb-2"><a href="{{ route('about') }}" class="text-light text-decoration-none">About Us</a></li>
                    <li class="mb-2"><a href="{{ route('contact') }}" class="text-light text-decoration-none">Contact</a></li>
                </ul>
            </div>

            <!-- Car Categories -->
            <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                <h6 class="text-uppercase mb-4">Car Categories</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">New Cars</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Used Cars</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Electric Vehicles</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">Luxury Cars</a></li>
                    <li class="mb-2"><a href="#" class="text-light text-decoration-none">SUVs & Crossovers</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-lg-3 col-md-6">
                <h6 class="text-uppercase mb-4">Contact Info</h6>
                <ul class="list-unstyled mb-0">
                    <li class="mb-2">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        123 Car Street, Auto City, AC 12345
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-phone me-2"></i>
                        +1 (234) 567-8900
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-envelope me-2"></i>
                        info@automarket.com
                    </li>
                    <li class="mb-2">
                        <i class="fas fa-clock me-2"></i>
                        Mon - Sat: 9:00 AM - 6:00 PM
                    </li>
                </ul>
            </div>
        </div>

        <hr class="my-4 bg-light">

        <!-- Bottom Footer -->
        <div class="row align-items-center">
            <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                <p class="mb-0">&copy; {{ date('Y') }} AutoMarket. All rights reserved.</p>
            </div>
            <div class="col-md-6 text-center text-md-end">
                <ul class="list-inline mb-0">
                    <li class="list-inline-item"><a href="#" class="text-light text-decoration-none">Privacy Policy</a></li>
                    <li class="list-inline-item mx-3">|</li>
                    <li class="list-inline-item"><a href="#" class="text-light text-decoration-none">Terms of Use</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>
