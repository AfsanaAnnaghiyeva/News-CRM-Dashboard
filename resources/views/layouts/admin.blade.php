<!DOCTYPE html>
<html lang="az">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        body { background-color: #f8f9fa; overflow-x: hidden; }
        
        /* Sidebar tənzimləmələri */
        .sidebar { 
            min-height: 100vh; 
            background: #fff; 
            border-right: 1px solid #dee2e6;
            transition: all 0.3s;
        }

        .nav-link { 
            color: #495057; 
            border-radius: 8px; 
            margin-bottom: 5px; 
            padding: 10px 15px;
            display: flex;
            align-items: center;
        }
        
        .nav-link:hover, .nav-link.active { 
            background-color: #e9ecef; 
            color: #0d6efd; 
        }

        /* Mobil üçün burger menyu məntiqi */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                left: -100%;
                width: 250px;
                z-index: 1050;
            }
            .sidebar.show {
                left: 0;
            }
            main {
                margin-left: 0 !important;
            }
        }

        /* Dark Mode */
        body.dark-mode { background-color: #121212; color: #eee; }
        body.dark-mode .sidebar, body.dark-mode .navbar { background: #1e1e1e !important; border-color: #333 !important; }
        body.dark-mode .nav-link { color: #bbb; }
        body.dark-mode .nav-link:hover { background-color: #2a2a2a; }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <nav id="sidebar" class="col-md-3 col-lg-2 sidebar p-3 shadow-sm d-md-block collapse">
            <h5 class="fw-bold text-primary mb-4 px-2">TODO App</h5>
            
            <ul class="nav flex-column">
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.dashboard.*') ? 'active' : '' }}" href="{{route('admin.dashboard.index')}}"><i class="bi bi-house-door me-2"></i> Dashboard</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.category.*') ? 'active' : '' }}" href="{{route('admin.category.index')}}"><i class="bi bi-grid me-2"></i> Kateqoriya</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.post.*') ? 'active' : '' }}" href="{{route('admin.post.index')}}"><i class="bi bi-newspaper me-2"></i> Xəbərlər</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.comment.*') ? 'active' : '' }}" href="{{route('admin.comment.index')}}"><i class="bi bi-chat-left-dots me-2"></i> Şərhlər</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.service.*') ? 'active' : '' }}" href="{{route('admin.service.index')}}"><i class="bi bi-briefcase me-2"></i> Xidmətlər</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.customer.*') ? 'active' : '' }}" href="{{route('admin.customer.index')}}"><i class="bi bi-people me-2"></i> Müştərilər</a></li>
                <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.todo.*') ? 'active' : '' }}" href="{{route('admin.todo.index')}}"><i class="bi bi-check2-square me-2"></i> Tapşırıqlar</a></li>
                 <li class="nav-item"><a class="nav-link {{ request()->routeIs('admin.sale.*') ? 'active' : '' }}" href="{{route('admin.sale.index')}}"><i class="bi bi-graph-up-arrow me-2"></i> Satışlar</a></li>
            </ul>

            <div class="border-top pt-3 mt-4">
                <button class="btn btn-outline-secondary w-100" onclick="toggleDarkMode()">
                    <i id="modeIcon" class="bi bi-moon-stars me-2"></i> Mode
                </button>
            </div>
        </nav>

        <main class="col-md-9 ms-sm-auto col-lg-10 p-0">
            <nav class="navbar navbar-light bg-white border-bottom px-4 py-2 shadow-sm d-flex justify-content-between">
                <button class="navbar-toggler d-md-none border-0" type="button" onclick="toggleSidebar()">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="dropdown ms-auto">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle text-dark" data-bs-toggle="dropdown">
                        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->full_name }}&background=0d6efd&color=fff" width="32" height="32" class="rounded-circle me-2">
                        <span class="fw-bold small d-none d-sm-inline">{{ auth()->user()->full_name }}</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item text-danger" href="{{route('admin.auth.logout')}}">Çıxış</a></li>
                    </ul>
                </div>
            </nav>

            <div class="p-4">
                @yield('content')
            </div>
        </main>
    </div>
</div>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

@stack('scripts')

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }

    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
        const icon = document.getElementById('modeIcon');
        if (document.body.classList.contains('dark-mode')) {
            icon.classList.replace('bi-moon-stars', 'bi-sun');
        } else {
            icon.classList.replace('bi-sun', 'bi-moon-stars');
        }
    }
</script>
</body>
</html>