<x-admin-layout>
    <div class="container-fluid">
        <!-- Page Title -->
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3">Dashboard Overview</h1>
            <div>
                <a href="{{ route('cars.create') }}" class="btn btn-primary">
                    <i class="material-icons align-middle">add</i> Add New Car
                </a>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Cars</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCars }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="material-icons text-gray-300" style="font-size: 2rem;">directions_car</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Active Bids</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeBids }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="material-icons text-gray-300" style="font-size: 2rem;">gavel</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    New Inquiries</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $newInquiries }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="material-icons text-gray-300" style="font-size: 2rem;">contact_mail</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Total Users</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="material-icons text-gray-300" style="font-size: 2rem;">people</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity and Quick Actions -->
        <div class="row">
            <!-- Recent Activity -->
            <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                        <a href="#" class="btn btn-sm btn-primary">View All</a>
                    </div>
                    <div class="card-body">
                        <div class="list-group">
                            @foreach($recentActivities as $activity)
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $activity->title }}</h6>
                                    <small>{{ $activity->created_at->diffForHumans() }}</small>
                                </div>
                                <p class="mb-1">{{ $activity->description }}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a href="{{ route('cars.create') }}" class="btn btn-primary btn-block">
                                <i class="material-icons align-middle">add_circle</i> Add New Car
                            </a>
                            <a href="{{ route('blogs.create') }}" class="btn btn-info btn-block">
                                <i class="material-icons align-middle">post_add</i> Create Blog Post
                            </a>
                            <a href="{{ route('admin.users.create') }}" class="btn btn-success btn-block">
                                <i class="material-icons align-middle">person_add</i> Add New User
                            </a>
                            <a href="{{ route('admin.reports.generate') }}" class="btn btn-warning btn-block">
                                <i class="material-icons align-middle">assessment</i> Generate Report
                            </a>
                        </div>
                    </div>
                </div>

                <!-- System Status -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">System Status</h6>
                    </div>
                    <div class="card-body">
                        <div class="mb-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Server Load
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 25%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">25%</div>
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Storage Usage
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-info" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
