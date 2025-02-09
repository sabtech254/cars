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
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="text-center mb-4">
                <h4>Admin Dashboard</h4>
            </div>
            
            <div class="sidebar-heading">Main</div>
            <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="material-icons">dashboard</i> Dashboard
            </a>
            
            <div class="sidebar-heading">Inventory Management</div>
            <a href="{{ route('cars.index') }}" class="sidebar-link {{ request()->routeIs('cars.*') ? 'active' : '' }}">
                <i class="material-icons">directions_car</i> Cars
            </a>
            <a href="{{ route('cars.create') }}" class="sidebar-link">
                <i class="material-icons">add_circle</i> Add New Car
            </a>
            
            <div class="sidebar-heading">Sales & Inquiries</div>
            <a href="{{ route('bids.index') }}" class="sidebar-link {{ request()->routeIs('bids.*') ? 'active' : '' }}">
                <i class="material-icons">gavel</i> Bids
            </a>
            <a href="{{ route('inquiries.index') }}" class="sidebar-link {{ request()->routeIs('inquiries.*') ? 'active' : '' }}">
                <i class="material-icons">contact_mail</i> Inquiries
            </a>
            
            <div class="sidebar-heading">Content Management</div>
            <a href="{{ route('blogs.index') }}" class="sidebar-link {{ request()->routeIs('blogs.*') ? 'active' : '' }}">
                <i class="material-icons">article</i> Blog Posts
            </a>
            <a href="{{ route('blogs.create') }}" class="sidebar-link">
                <i class="material-icons">post_add</i> New Blog Post
            </a>
            
            <div class="sidebar-heading">Users & Settings</div>
            <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                <i class="material-icons">people</i> Users
            </a>
            <a href="{{ route('admin.settings') }}" class="sidebar-link {{ request()->routeIs('admin.settings') ? 'active' : '' }}">
                <i class="material-icons">settings</i> Settings
            </a>
            
            <div class="sidebar-heading">Reports</div>
            <a href="{{ route('admin.reports.sales') }}" class="sidebar-link">
                <i class="material-icons">bar_chart</i> Sales Reports
            </a>
            <a href="{{ route('admin.reports.inventory') }}" class="sidebar-link">
                <i class="material-icons">inventory</i> Inventory Reports
            </a>
            
            <div class="mt-4 p-3">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100">
                        <i class="material-icons align-middle">logout</i> Logout
                    </button>
                </form>
            </div>
        </nav>

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

            {{ $slot }}
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
