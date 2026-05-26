<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Surat Kominfo</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="{{ asset('css/style.css') }}?v={{ time() }}" rel="stylesheet">
</head>
<body class="bg-light-gray">
    @auth
    <div class="d-flex" id="wrapper">
        <!-- Sidebar -->
        <div class="sidebar-bg text-white" id="sidebar-wrapper">
            <div class="sidebar-heading text-center py-4 fs-5 fw-bold border-bottom border-light border-opacity-10">
                <div class="bg-white rounded-circle p-2 d-inline-flex align-items-center justify-content-center mb-2 shadow-sm" style="width: 56px; height: 56px;">
                    <img src="{{ asset('images/logo-kominfo.svg') }}" alt="Logo Kominfo" style="width: 40px; height: auto;">
                </div>
                <div class="d-block">E-SURAT</div>
                <div class="fs-6 fw-normal opacity-75" style="font-size: 0.8rem !important;">INTERNAL MANAGEMENT</div>
            </div>
            <div class="list-group list-group-flush my-3">
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.dashboard') ? 'active-sidebar' : '' }}">
                        <i class="bi bi-grid me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.opd-accounts.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.opd-accounts.*') ? 'active-sidebar' : '' }}">
                        <i class="bi bi-people me-2"></i> Kelola Akun OPD
                    </a>
                    <a href="{{ route('admin.surat-keluar.create') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.surat-keluar.create') ? 'active-sidebar' : '' }}">
                        <i class="bi bi-envelope-plus me-2"></i> Kirim Surat
                    </a>
                    <a href="{{ route('admin.surat-keluar.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.surat-keluar.index') ? 'active-sidebar' : '' }}">
                        <i class="bi bi-send-check me-2"></i> Surat Keluar
                    </a>
                @else
                    <a href="{{ route('opd.dashboard') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('opd.dashboard') ? 'active-sidebar' : '' }}">
                        <i class="bi bi-grid me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('opd.surat.create') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('opd.surat.create') ? 'active-sidebar' : '' }}">
                        <i class="bi bi-envelope-plus me-2"></i> Kirim Surat
                    </a>
                    <a href="{{ route('opd.surat-masuk.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('opd.surat-masuk.*') ? 'active-sidebar' : '' }}">
                        <i class="bi bi-envelope-check me-2"></i> Surat Masuk Kominfo
                    </a>
                @endif
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.history') : route('opd.history') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.history') || request()->routeIs('opd.history') ? 'active-sidebar' : '' }}">
                    <i class="bi bi-clock-history me-2"></i> Riwayat
                </a>
                <a href="{{ route('profile') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('profile') ? 'active-sidebar' : '' }}">
                    <i class="bi bi-person me-2"></i> Profil
                </a>
            </div>
            <div class="mt-auto p-3" style="position: absolute; bottom: 0; width: 100%;">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="list-group-item list-group-item-action bg-transparent text-danger fw-bold border-0 w-100 text-start">
                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                    </button>
                </form>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Sidebar Overlay -->
        <div class="sidebar-overlay" id="sidebar-overlay"></div>

        <!-- Page Content -->
        <div id="page-content-wrapper" class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 px-4 sticky-top shadow-sm" style="z-index: 1030;">
                <div class="container-fluid p-0 d-flex align-items-center">
                    <button class="btn btn-light d-lg-none me-3" id="menu-toggle">
                        <i class="bi bi-list fs-4"></i>
                    </button>
                    

                    
                    <div class="ms-auto d-flex align-items-center">
                        <a href="{{ Auth::user()->role === 'opd' ? route('opd.surat-masuk.index') : '#' }}" class="text-muted fs-5 me-3 position-relative">
                            <i class="bi bi-bell"></i>
                            @if(isset($unreadSuratCount) && $unreadSuratCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.55rem; padding: 0.25em 0.4em;">
                                    {{ $unreadSuratCount }}
                                    <span class="visually-hidden">unread letters</span>
                                </span>
                            @endif
                        </a>

                        <div class="d-flex align-items-center border-start ps-4">
                            <div class="text-end me-3 d-none d-sm-block">
                                <div class="fw-bold text-dark">{{ Auth::user()->name }}</div>
                                <div class="text-muted" style="font-size: 0.8rem;">{{ Auth::user()->email }}</div>
                            </div>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=EBF4FF&color=1E3A8A" alt="Profile" class="rounded-circle" width="40" height="40">
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container-fluid px-4 py-4 content-area">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                
                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </div>
        </div>
        <!-- /#page-content-wrapper -->
    </div>
    @else
        @yield('content')
    @endauth

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const wrapper = document.getElementById('wrapper');
            const menuToggle = document.getElementById('menu-toggle');
            const overlay = document.getElementById('sidebar-overlay');

            if (menuToggle) {
                menuToggle.onclick = function() {
                    wrapper.classList.toggle('toggled');
                };
            }

            if (overlay) {
                overlay.onclick = function() {
                    wrapper.classList.remove('toggled');
                };
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
