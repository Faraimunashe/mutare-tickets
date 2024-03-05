<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item">
            <a class="nav-link " href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        @if (Auth::user()->hasRole('user'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('user-issues') }}">
                    <i class="bi bi-dash-circle"></i>
                    <span>Faults</span>
                </a>
            </li>
        @endif

        @if (Auth::user()->hasRole('admin'))
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin-issues') }}">
                    <i class="bi bi-dash-circle"></i>
                    <span>Faults</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" href="{{ route('admin-users') }}">
                    <i class="bi bi-people"></i>
                    <span>Users</span>
                </a>
            </li>
        @endif

        <li class="nav-item">
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
            </form>
            <a class="nav-link collapsed" href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <i class="bi bi-lock"></i>
            <span>Logout</span>
            </a>
        </li>
    </ul>
</aside>
