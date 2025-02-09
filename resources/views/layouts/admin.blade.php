<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin Dashboard</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* Custom Admin Dashboard Styles */
        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }
        
        .sidebar {
            width: 250px;
            background-color: #1a1a1a;
            color: #fff;
            padding-top: 1rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        
        .main-content {
            flex: 1;
            margin-left: 250px;
            padding: 2rem;
            background-color: #f8f9fa;
        }
        
        .sidebar-link {
            color: #fff;
            text-decoration: none;
            padding: 0.75rem 1rem;
            display: flex;
            align-items: center;
            transition: background-color 0.3s;
        }
        
        .sidebar-link:hover {
            background-color: #2d2d2d;
            color: #fff;
        }
        
        .sidebar-link.active {
            background-color: #3498db;
        }
        
        .sidebar-link i {
            margin-right: 0.5rem;
        }
        
        .sidebar-heading {
            padding: 1rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: #6c757d;
        }

        .sidebar .nav-item .collapse-inner .collapse-item {
            padding: 0.5rem 1rem;
            margin: 0 0.5rem;
            display: block;
            color: #3a3b45;
            text-decoration: none;
            border-radius: 0.35rem;
            white-space: nowrap;
        }

        .sidebar .nav-item .collapse-inner .collapse-item:hover {
            background-color: #eaecf4;
        }

        .sidebar .nav-item .collapse-inner .collapse-item.active {
            color: #4e73df;
            font-weight: 600;
            background-color: #eaecf4;
        }

        .sidebar .nav-item .collapse-inner .collapse-header {
            margin: 0;
            white-space: nowrap;
            padding: 0.5rem 1.5rem;
            text-transform: uppercase;
            font-weight: 800;
            font-size: 0.65rem;
            color: #b7b9cc;
        }

        .sidebar .nav-item .collapse-inner {
            padding: 0.5rem 0;
            min-width: 10rem;
            font-size: 0.85rem;
        }

        .sidebar .nav-item .nav-link[data-bs-toggle="collapse"].collapsed::after {
            content: '\f105';
        }

        .sidebar .nav-item .nav-link[data-bs-toggle="collapse"]::after {
            width: 1rem;
            text-align: center;
            float: right;
            vertical-align: 0;
            border: 0;
            font-weight: 900;
            content: '\f107';
            font-family: 'Font Awesome 5 Free';
        }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
                <div class="sidebar-brand-icon">
                    <i class="material-icons">dashboard</i>
                </div>
                <div class="sidebar-brand-text mx-3">Admin Panel</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.dashboard') }}">
                    <i class="material-icons">home</i>
                    <span>Dashboard</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Inventory
            </div>

            <!-- Nav Item - Cars Menu -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.cars.*') ? '' : 'collapsed' }}" href="#" 
                    data-bs-toggle="collapse" data-bs-target="#collapseCars"
                    aria-expanded="{{ request()->routeIs('admin.cars.*') ? 'true' : 'false' }}" 
                    aria-controls="collapseCars">
                    <i class="material-icons">directions_car</i>
                    <span>Cars</span>
                </a>
                <div id="collapseCars" class="collapse {{ request()->routeIs('admin.cars.*') ? 'show' : '' }}" 
                    aria-labelledby="headingCars" data-bs-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Car Management</h6>
                        <a class="collapse-item d-flex align-items-center {{ request()->routeIs('admin.cars.sale') ? 'active' : '' }}" 
                            href="{{ route('admin.cars.sale') }}">
                            <i class="material-icons me-2" style="font-size: 1.1rem;">sell</i>
                            <span>Cars For Sale</span>
                        </a>
                        <a class="collapse-item d-flex align-items-center {{ request()->routeIs('admin.cars.auction') ? 'active' : '' }}" 
                            href="{{ route('admin.cars.auction') }}">
                            <i class="material-icons me-2" style="font-size: 1.1rem;">gavel</i>
                            <span>Cars For Auction</span>
                        </a>
                        <a class="collapse-item d-flex align-items-center {{ request()->routeIs('admin.bids.*') ? 'active' : '' }}" 
                            href="{{ route('admin.bids.index') }}">
                            <i class="material-icons me-2" style="font-size: 1.1rem;">local_offer</i>
                            <span>Manage Bids</span>
                        </a>
                        <a class="collapse-item d-flex align-items-center {{ request()->routeIs('admin.cars.create') ? 'active' : '' }}" 
                            href="{{ route('admin.cars.create') }}">
                            <i class="material-icons me-2" style="font-size: 1.1rem;">add_circle</i>
                            <span>Add New Car</span>
                        </a>
                    </div>
                </div>
            </li>

            <!-- Nav Item - Bids -->
            <li class="nav-item {{ request()->routeIs('admin.bids.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.bids.index') }}">
                    <i class="material-icons">gavel</i>
                    <span>Bids</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Users & Inquiries
            </div>

            <!-- Nav Item - Users -->
            <li class="nav-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.users.index') }}">
                    <i class="material-icons">people</i>
                    <span>Users</span>
                </a>
            </li>

            <!-- Nav Item - Inquiries -->
            <li class="nav-item {{ request()->routeIs('admin.inquiries.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.inquiries.index') }}">
                    <i class="material-icons">contact_mail</i>
                    <span>Inquiries</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Settings
            </div>

            <!-- Nav Item - Settings -->
            <li class="nav-item {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('admin.settings.index') }}">
                    <i class="material-icons">settings</i>
                    <span>Settings</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle">
                    <i class="material-icons">chevron_left</i>
                </button>
            </div>
        </ul>

        <!-- Main Content -->
        <main class="main-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('main-content')
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
