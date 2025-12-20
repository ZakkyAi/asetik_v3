<link rel="stylesheet" href="{{ asset('css/minimal.css') }}">
<nav class="navbar">
    <div class="navbar-content">
        <a href="{{ route('dashboard') }}" class="navbar-brand">Asetik</a>
        <div class="navbar-menu">
            @if(auth()->user()->level === 'admin')
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">Users</a>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">Products</a>
                <a href="{{ route('admin.records.index') }}" class="{{ request()->routeIs('admin.records.*') ? 'active' : '' }}">Records</a>
                <a href="{{ route('admin.repairs.index') }}" class="{{ request()->routeIs('admin.repairs.*') ? 'active' : '' }}">Repairs</a>
            @else
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('user.profile') }}" class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">Profile</a>
                <a href="{{ route('user.repair.apply') }}" class="{{ request()->routeIs('user.repair.apply') ? 'active' : '' }}">Apply Repair</a>
                <a href="{{ route('user.repair.pickup') }}" class="{{ request()->routeIs('user.repair.pickup') ? 'active' : '' }}">Pickup</a>
            @endif
        </div>
        <div class="user-info">
            <span>{{ auth()->user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    </div>
</nav>

<style>
    .navbar {
        background: #fff;
        border-bottom: 1px solid #000;
        padding: 0 20px;
    }
    .navbar-content {
        max-width: 1200px;
        margin: 0 auto;
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 50px;
    }
    .navbar-brand {
        font-size: 18px;
        font-weight: bold;
        color: #000;
        text-decoration: none;
    }
    .navbar-menu {
        display: flex;
        gap: 15px;
    }
    .navbar-menu a {
        color: #000;
        text-decoration: none;
        padding: 5px 10px;
    }
    .navbar-menu a.active {
        text-decoration: underline;
    }
    .user-info {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #000;
    }
    .logout-btn {
        background: #fff;
        border: 1px solid #000;
        color: #000;
        padding: 5px 10px;
        cursor: pointer;
    }
</style>
