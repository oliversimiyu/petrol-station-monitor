<!-- Top Navigation Bar -->
<nav class="navbar navbar-expand-md navbar-light bg-white border-bottom">
    <div class="container">
        <!-- Brand -->
        <a class="navbar-brand" href="{{ route('dashboard') }}">
            <i class="fas fa-gas-pump text-primary"></i>
            <span>Petrol Station Monitor</span>
        </a>

        <!-- Navigation Links -->
        <div class="d-flex align-items-center">
            <div class="nav-links me-3">
                <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <i class="fas fa-tachometer-alt me-2"></i>
                    Dashboard
                </a>
                <a href="{{ route('fuel-tanks.index') }}" class="nav-item {{ request()->routeIs('fuel-tanks.*') ? 'active' : '' }}">
                    <i class="fas fa-gas-pump me-2"></i>
                    Fuel Tanks
                </a>
                <a href="{{ route('analytics') }}" class="nav-item {{ request()->routeIs('analytics') ? 'active' : '' }}">
                    <i class="fas fa-chart-line me-2"></i>
                    Analytics
                </a>
            </div>

            <!-- User Menu -->
            @auth
            <div class="dropdown">
                <button class="btn dropdown-toggle user-menu" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user-circle me-2"></i>
                    <span>{{ Auth::user()->name }}</span>
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                Log Out
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            @else
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">
                        <i class="fas fa-sign-in-alt me-2"></i>Login
                    </a>
                </li>
                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus me-2"></i>Register
                        </a>
                    </li>
                @endif
            </ul>
            @endauth
        </div>
    </div>
</nav>

@push('styles')
<style>
.navbar {
    padding: 0.75rem 0;
}

.navbar-brand {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-weight: 600;
}

.navbar-brand i {
    font-size: 1.25rem;
}

.nav-links {
    display: flex;
    align-items: center;
    gap: 1.5rem;
}

.nav-item {
    color: #6b7280;
    text-decoration: none;
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
    transition: all 0.2s;
    display: flex;
    align-items: center;
}

.nav-item:hover {
    color: #1e40af;
    background-color: #f3f4f6;
}

.nav-item.active {
    color: #1e40af;
    background-color: #e5e7eb;
    font-weight: 500;
}

.user-menu {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.5rem 0.75rem;
    font-weight: 500;
    color: #4b5563;
    background: none;
    border: none;
}

.user-menu:hover,
.user-menu:focus {
    background-color: #f3f4f6;
}

.dropdown-menu {
    margin-top: 0.5rem;
    padding: 0.5rem;
    border: none;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
    border-radius: 0.5rem;
}

.dropdown-item {
    padding: 0.5rem 0.75rem;
    border-radius: 0.375rem;
    display: flex;
    align-items: center;
}

.dropdown-item:hover {
    background-color: #f3f4f6;
}

.dropdown-item.text-danger:hover {
    background-color: #fee2e2;
}
</style>
@endpush
