<nav id="sidebar" class="sidebar js-sidebar fixed custom-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand fw-bold text-white text-center py-3 mb-3" href="#">
            <i class="fa fa-cogs me-2"></i>
            <span class="align-middle">Panel Administrator</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item @if (request()->routeIs('dashboard')) active @endif">
                <a class="sidebar-link" href="{{ route('dashboard') }}">
                    <i class="align-middle fa fa-home me-2"></i> 
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>
            <li class="sidebar-item @if (request()->routeIs('dataset.*')) active @endif">
                <a class="sidebar-link" href="{{ route('dataset.index') }}">
                    <i class="align-middle fa fa-server me-2"></i> 
                    <span class="align-middle">Data</span>
                </a>
            </li>

            @can('view-admin-settings')
                <li class="sidebar-item @if (request()->routeIs('kriteria.*')) active @endif">
                    <a class="sidebar-link" href="{{ route('kriteria.index') }}">
                        <i class="align-middle fa fa-clipboard-list me-2"></i> 
                        <span class="align-middle">Kriteria</span>
                    </a>
                </li>
            @endcan
        </ul>
    </div>
</nav>

<style>
    /* Sidebar wrapper */
    .custom-sidebar {
        width: 250px;
        background: linear-gradient(180deg, #007bff, #0056b3);
        color: #fff;
        min-height: 100vh;
        transition: all 0.3s ease-in-out;
    }

    .custom-sidebar .sidebar-content {
        padding: 0 0.75rem;
    }

    /* Brand text */
    .custom-sidebar .sidebar-brand {
        font-size: 1.2rem;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Link style */
    .custom-sidebar .sidebar-link {
        display: flex;
        align-items: center;
        padding: 12px 18px;
        margin: 6px 0;
        border-radius: 8px;
        font-weight: 600;
        color: #e0e0e0;
        transition: all 0.3s ease;
    }

    .custom-sidebar .sidebar-link:hover {
        background: rgba(255, 255, 255, 0.15);
        color: #fff;
        transform: translateX(5px);
        box-shadow: inset 3px 0 0 #00d4ff;
    }

    /* Active state */
    .custom-sidebar .sidebar-item.active .sidebar-link {
        background: rgba(255, 255, 255, 0.25);
        color: #fff;
        box-shadow: inset 4px 0 0 #00d4ff;
    }

    /* Icons */
    .custom-sidebar i {
        font-size: 1rem;
    }
</style>
