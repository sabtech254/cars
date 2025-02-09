<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Admin</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <!-- Admin Sidebar -->
        <div class="flex">
            <aside class="w-64 min-h-screen bg-white shadow-md">
                <div class="px-4 py-5 border-b">
                    <div class="flex items-center">
                        <i class="material-icons text-primary mr-2">admin_panel_settings</i>
                        <span class="text-lg font-semibold">Admin Panel</span>
                    </div>
                </div>

                <nav class="mt-4">
                    <div class="px-4 space-y-2">
                        <a href="{{ route('admin.dashboard') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.dashboard') ? 'bg-gray-100' : '' }}">
                            <i class="material-icons mr-3">dashboard</i>
                            <span>Dashboard</span>
                        </a>

                        <a href="{{ route('cars.index') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('cars.*') ? 'bg-gray-100' : '' }}">
                            <i class="material-icons mr-3">directions_car</i>
                            <span>Cars</span>
                        </a>

                        <a href="{{ route('admin.users.index') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.users.*') ? 'bg-gray-100' : '' }}">
                            <i class="material-icons mr-3">people</i>
                            <span>Users</span>
                        </a>

                        <a href="{{ route('admin.inquiries.index') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.inquiries.*') ? 'bg-gray-100' : '' }}">
                            <i class="material-icons mr-3">mail</i>
                            <span>Inquiries</span>
                        </a>

                        <a href="{{ route('admin.settings') }}" 
                           class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100 {{ request()->routeIs('admin.settings') ? 'bg-gray-100' : '' }}">
                            <i class="material-icons mr-3">settings</i>
                            <span>Settings</span>
                        </a>
                    </div>
                </nav>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-8">
                {{ $slot }}
            </main>
        </div>
    </div>
</body>
</html>
