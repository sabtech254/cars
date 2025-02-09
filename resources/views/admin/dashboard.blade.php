<x-app-layout>
    <div class="container-fluid px-4 py-5">
        <!-- Stats Grid -->
        <div class="row g-4 mb-5">
            <!-- Total Cars -->
            <div class="col-xl-3 col-sm-6">
                <div class="card bg-primary text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-2">Total Cars</p>
                                <h3 class="mb-0">{{ $totalCars }}</h3>
                            </div>
                            <div class="rounded-circle bg-primary-light p-3">
                                <i class="material-icons">directions_car</i>
                            </div>
                        </div>
                        <div class="mt-3 small">
                            <span class="text-white-50">Available: {{ $availableCars }}</span>
                            <span class="text-white-50 ms-3">Sold: {{ $soldCars }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Featured Cars -->
            <div class="col-xl-3 col-sm-6">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-2">Featured Cars</p>
                                <h3 class="mb-0">{{ $featuredCars }}</h3>
                            </div>
                            <div class="rounded-circle bg-success-light p-3">
                                <i class="material-icons">star</i>
                            </div>
                        </div>
                        <div class="mt-3 small">
                            <span class="text-white-50">Currently featured</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Users -->
            <div class="col-xl-3 col-sm-6">
                <div class="card bg-info text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-2">Total Users</p>
                                <h3 class="mb-0">{{ $totalUsers }}</h3>
                            </div>
                            <div class="rounded-circle bg-info-light p-3">
                                <i class="material-icons">people</i>
                            </div>
                        </div>
                        <div class="mt-3 small">
                            <span class="text-white-50">Registered users</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Revenue -->
            <div class="col-xl-3 col-sm-6">
                <div class="card bg-warning text-white">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <p class="mb-2">Total Revenue</p>
                                <h3 class="mb-0">${{ number_format($soldCars * 1000, 2) }}</h3>
                            </div>
                            <div class="rounded-circle bg-warning-light p-3">
                                <i class="material-icons">attach_money</i>
                            </div>
                        </div>
                        <div class="mt-3 small">
                            <span class="text-white-50">From {{ $soldCars }} sales</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="row g-4">
            <!-- Recent Cars -->
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">Recent Cars</h5>
                            <a href="{{ route('cars.index') }}" class="btn btn-sm btn-primary">View All</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">Car</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentCars as $car)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ json_decode($car->images)[0] }}" alt="{{ $car->title }}" 
                                                    class="rounded" style="width: 45px; height: 45px; object-fit: cover;">
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1">{{ $car->title }}</p>
                                                    <p class="text-muted mb-0">{{ $car->make }} {{ $car->model }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>${{ number_format($car->price, 2) }}</td>
                                        <td>
                                            <span class="badge badge-{{ $car->status === 'available' ? 'success' : 'warning' }} rounded-pill">
                                                {{ ucfirst($car->status) }}
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('cars.show', $car) }}" class="btn btn-link btn-sm px-2">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a href="{{ route('cars.edit', $car) }}" class="btn btn-link btn-sm px-2">
                                                <i class="material-icons">edit</i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Users -->
            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-transparent">
                        <h5 class="mb-0">Recent Users</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th scope="col">User</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Joined</th>
                                        <th scope="col">Role</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentUsers as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" 
                                                    style="width: 35px; height: 35px;">
                                                    {{ strtoupper(substr($user->name, 0, 1)) }}
                                                </div>
                                                <div class="ms-3">
                                                    <p class="fw-bold mb-1">{{ $user->name }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->created_at->diffForHumans() }}</td>
                                        <td>
                                            <span class="badge badge-{{ $user->is_admin ? 'danger' : 'info' }} rounded-pill">
                                                {{ $user->is_admin ? 'Admin' : 'User' }}
                                            </span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .bg-primary-light { background-color: rgba(255, 255, 255, 0.2); }
        .bg-success-light { background-color: rgba(255, 255, 255, 0.2); }
        .bg-info-light { background-color: rgba(255, 255, 255, 0.2); }
        .bg-warning-light { background-color: rgba(255, 255, 255, 0.2); }
        .card { border: none; border-radius: 10px; }
        .card-header { border-bottom: none; }
        .table > :not(caption) > * > * { padding: 1rem; }
        .material-icons { font-size: 24px; }
    </style>
    @endpush
</x-app-layout>
