<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand" href="{{ route('home') }}">
            <i class="material-icons align-middle me-2">directions_car</i>
            {{ config('app.name', 'Laravel') }}
        </a>

        <!-- Mobile Toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Items -->
        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
                        Home
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('cars.*') ? 'active' : '' }}" href="{{ route('cars.index') }}">
                        Cars
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">
                        About
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('loan.calculator') ? 'active' : '' }}" href="{{ route('loan.calculator') }}">
                        Loan Calculator
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blogs.*') ? 'active' : '' }}" href="{{ route('blogs.index') }}">
                        Blog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">
                        <i class="material-icons align-middle">mail</i>
                        Contact Us
                    </a>
                </li>
            </ul>

            <!-- Right Side -->
            <ul class="navbar-nav ms-auto">
                @auth
                    @if(auth()->user()->is_admin)
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" href="{{ route('admin.dashboard') }}">
                            <i class="material-icons align-middle">dashboard</i>
                            Admin Dashboard
                        </a>
                    </li>
                    @endif
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="material-icons align-middle">account_circle</i>
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                    <i class="material-icons align-middle me-2">person</i>
                                    Profile
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="material-icons align-middle me-2">logout</i>
                                        Log Out
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="material-icons align-middle">login</i>
                            Log in
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="material-icons align-middle">person_add</i>
                            Register
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
