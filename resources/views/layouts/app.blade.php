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
    <style>
        /* Force styling for the notification pop-up chat bubble */
        .notification-popup-toast {
            position: absolute !important;
            top: 50% !important;
            right: calc(100% + 12px) !important;
            transform: translateY(-50%) !important;
            background: #1E3A8A !important;
            color: #ffffff !important;
            padding: 8px 16px !important;
            border-radius: 12px !important;
            font-size: 0.8rem !important;
            font-weight: 500 !important;
            white-space: nowrap !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.18) !important;
            z-index: 9999 !important;
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
            pointer-events: none !important;
            opacity: 0;
            animation: showToast 3s forwards !important;
        }
        /* Chat bubble tail pointing right towards the bell */
        .notification-popup-toast::after {
            content: '' !important;
            position: absolute !important;
            top: 50% !important;
            left: 100% !important;
            transform: translateY(-50%) !important;
            border-width: 6px !important;
            border-style: solid !important;
            border-color: transparent transparent transparent #1E3A8A !important;
        }
        @keyframes showToast {
            0% { opacity: 0; transform: translateY(-50%) translateX(8px); }
            15% { opacity: 1; transform: translateY(-50%) translateX(0); }
            85% { opacity: 1; transform: translateY(-50%) translateX(0); }
            100% { opacity: 0; transform: translateY(-50%) translateX(8px); }
        }

        /* ===== CRITICAL LAYOUT FIX: Sidebar Fixed, Content Scrolls ===== */
        html, body {
            height: 100% !important;
            height: 100dvh !important;
            overflow: hidden !important;
            margin: 0 !important;
        }
        #wrapper {
            display: flex !important;
            height: 100vh !important;
            height: 100dvh !important;
            overflow: hidden !important;
        }
        #sidebar-wrapper {
            height: 100vh !important;
            height: 100dvh !important;
            min-height: 100vh !important;
            min-height: 100dvh !important;
            width: 250px !important;
            flex-shrink: 0 !important;
            overflow: hidden !important;
            display: flex !important;
            flex-direction: column !important;
            position: relative !important;
        }
        #sidebar-wrapper .list-group {
            overflow-y: auto !important;
            scrollbar-width: none !important; /* Firefox */
        }
        #sidebar-wrapper .list-group::-webkit-scrollbar {
            display: none !important; /* Chrome, Safari, Opera */
        }
        #page-content-wrapper {
            flex: 1 !important;
            height: 100vh !important;
            height: 100dvh !important;
            overflow-y: auto !important;
            overflow-x: hidden !important;
            min-width: 0 !important;
        }

        @media (max-width: 991.98px) {
            .content-area {
                padding: 6rem 1rem 2rem 1rem !important;
            }
            #sidebar-wrapper {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                bottom: 0 !important;
                height: auto !important;
                z-index: 1050 !important;
                margin-left: -250px;
                transition: margin 0.25s ease-out;
            }
            #wrapper.toggled #sidebar-wrapper {
                margin-left: 0 !important;
            }
        }
        @media (max-width: 767.98px) {
            .table td, .table th {
                font-size: 0.78rem !important;
                padding: 0.6rem 0.4rem !important;
            }
        }
    </style>
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
            <div class="list-group list-group-flush my-3 flex-grow-1">
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.dashboard') ? 'active-sidebar' : '' }}">
                        <i class="bi bi-grid me-2"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.opd-accounts.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.opd-accounts.*') ? 'active-sidebar' : '' }}">
                        <i class="bi bi-people me-2"></i> Kelola Akun OPD
                    </a>
                    <a href="{{ route('admin.categories.index') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.categories.*') ? 'active-sidebar' : '' }}">
                        <i class="bi bi-tags me-2"></i> Kelola Kategori
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
                        <i class="bi bi-envelope-check me-2"></i> Surat Masuk
                    </a>
                @endif
                <a href="{{ Auth::user()->role === 'admin' ? route('admin.history') : route('opd.history') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('admin.history') || request()->routeIs('opd.history') ? 'active-sidebar' : '' }}">
                    <i class="bi bi-clock-history me-2"></i> Riwayat
                </a>
                <a href="{{ route('profile') }}" class="list-group-item list-group-item-action bg-transparent text-white {{ request()->routeIs('profile') ? 'active-sidebar' : '' }}">
                    <i class="bi bi-person me-2"></i> Profil
                </a>
            </div>
            <div class="mt-auto p-3 border-top border-light border-opacity-10">
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
            <!-- Floating Mobile Menu Toggle (top-left) -->
            <button class="btn btn-primary d-lg-none shadow-sm position-fixed rounded-circle" id="menu-toggle" style="width: 48px; height: 48px; display: flex; align-items: center; justify-content: center; top: 12px; left: 12px; z-index: 1060;">
                <i class="bi bi-list fs-3"></i>
            </button>

            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom py-3 px-4 sticky-top shadow-sm d-none d-lg-flex" style="z-index: 1030;">
                <div class="container-fluid p-0 d-flex align-items-center">
                    

                    
                    <div class="ms-auto d-flex align-items-center">
                        <div class="dropdown me-3">
                            <a href="#" class="text-muted fs-5 position-relative text-decoration-none" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-bell notification-bell text-primary-blue"></i>
                                @if(isset($unreadSuratCount) && $unreadSuratCount > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger notification-badge animation-pulse" style="font-size: 0.55rem; padding: 0.25em 0.4em;">
                                        {{ $unreadSuratCount }}
                                    </span>
                                    <div class="notification-popup-toast">
                                        <i class="bi bi-chat-dots-fill text-warning"></i> 
                                        <span><strong>{{ $unreadSuratCount }}</strong> Notifikasi Baru</span>
                                    </div>
                                @endif
                            </a>
                             <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0" aria-labelledby="notificationDropdown" style="width: 340px; max-height: 400px; overflow-y: auto;">
                                <li><h6 class="dropdown-header fw-bold text-primary-blue d-flex justify-content-between align-items-center mb-0 py-2">
                                    <span>Notifikasi Baru</span>
                                    @if(isset($unreadSuratCount) && $unreadSuratCount > 0)
                                        <span class="badge bg-danger rounded-pill">{{ $unreadSuratCount }}</span>
                                    @endif
                                </h6></li>
                                <li><hr class="dropdown-divider my-1"></li>
                                @if(isset($unreadSurats) && $unreadSurats->count() > 0)
                                    @foreach($unreadSurats as $unread)
                                        @if(Auth::user()->role === 'opd')
                                            <li>
                                                <a class="dropdown-item py-3 border-bottom" href="{{ route('opd.surat-masuk.show', $unread->id) }}" style="transition: background-color 0.2s;">
                                                    <div class="d-flex align-items-start">
                                                        <div class="rounded-circle me-3 d-flex align-items-center justify-content-center bg-primary bg-opacity-10 text-primary" style="width: 36px; height: 36px; min-width: 36px;">
                                                            <i class="bi bi-envelope-open" style="font-size: 1.1rem;"></i>
                                                        </div>
                                                        <div style="white-space: normal; width: 100%;">
                                                            <div class="fw-bold text-dark" style="font-size: 0.85rem; line-height: 1.2;">{{ $unread->nomor_surat }}</div>
                                                            <div class="text-muted small mt-1 text-truncate" style="max-width: 220px; font-size: 0.78rem;">{{ $unread->perihal }}</div>
                                                            <div class="text-muted mt-1 d-flex justify-content-between align-items-center" style="font-size: 0.7rem;">
                                                                <span>Dari: Kominfo</span>
                                                                <span class="text-secondary fw-semibold">{{ $unread->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a class="dropdown-item py-3 border-bottom" href="{{ route('admin.surat.show', $unread->id) }}" style="transition: background-color 0.2s;">
                                                    <div class="d-flex align-items-start">
                                                        <div class="rounded-circle me-3 d-flex align-items-center justify-content-center bg-warning bg-opacity-10 text-warning" style="width: 36px; height: 36px; min-width: 36px;">
                                                            <i class="bi bi-envelope-exclamation" style="font-size: 1.1rem;"></i>
                                                        </div>
                                                        <div style="white-space: normal; width: 100%;">
                                                            <div class="fw-bold text-dark" style="font-size: 0.85rem; line-height: 1.2;">{{ $unread->nomor_surat }}</div>
                                                            <div class="text-muted small mt-1 text-truncate" style="max-width: 220px; font-size: 0.78rem;">{{ $unread->keterangan ?? 'Perihal tidak diisi' }}</div>
                                                            <div class="text-muted mt-1 d-flex justify-content-between align-items-center" style="font-size: 0.7rem;">
                                                                <span class="text-truncate" style="max-width: 130px;">Dari: {{ $unread->user->name }}</span>
                                                                <span class="text-secondary fw-semibold">{{ $unread->created_at->diffForHumans() }}</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li>
                                        <a class="dropdown-item text-center text-primary fw-semibold py-2" href="{{ Auth::user()->role === 'opd' ? route('opd.surat-masuk.index') : route('admin.history') }}" style="font-size: 0.8rem;">
                                            Lihat Semua Surat <i class="bi bi-arrow-right ms-1"></i>
                                        </a>
                                    </li>
                                @else
                                    <li><div class="dropdown-item text-center text-muted py-4"><i class="bi bi-envelope-open text-muted fs-3 mb-2 d-block"></i>Tidak ada notifikasi baru</div></li>
                                @endif
                            </ul>
                        </div>

                        <div class="d-flex align-items-center border-start ps-4">
                            <div class="text-end me-3 d-none d-sm-block">
                                <div class="fw-bold text-dark">{{ Auth::user()->role === 'admin' ? 'Administrator' : Auth::user()->name }}</div>
                                @if(Auth::user()->role === 'admin')
                                    <div class="text-secondary fw-medium" style="font-size: 0.75rem;">Dinas Komunikasi dan Informatika Bandar Lampung</div>
                                @elseif(Auth::user()->nama_instansi)
                                    <div class="text-secondary fw-medium" style="font-size: 0.75rem;">{{ Auth::user()->nama_instansi }}</div>
                                @endif
                                <div class="text-muted" style="font-size: 0.8rem;">{{ Auth::user()->email }}</div>
                            </div>
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->role === 'admin' ? 'Administrator' : Auth::user()->name) }}&background=EBF4FF&color=1E3A8A" alt="Profile" class="rounded-circle" width="40" height="40">
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

    @auth
    <script>
        // Realtime Polling (Every 10 seconds)
        setInterval(function() {
            if (document.hidden) return; // Skip polling if tab is inactive
            
            fetch(window.location.href)
                .then(response => response.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    // 1. Update Notification Bell in Navbar
                    const oldDropdown = document.getElementById('notificationDropdown')?.parentElement;
                    const newDropdown = doc.getElementById('notificationDropdown')?.parentElement;
                    if (oldDropdown && newDropdown && oldDropdown.innerHTML !== newDropdown.innerHTML) {
                        oldDropdown.innerHTML = newDropdown.innerHTML;
                    }
                    
                    // 2. Update Dashboard Stats Cards (total, pending, selesai)
                    const oldStatCards = document.querySelectorAll('.stat-card');
                    const newStatCards = doc.querySelectorAll('.stat-card');
                    if (oldStatCards.length === newStatCards.length) {
                        oldStatCards.forEach((card, i) => {
                            const oldNumber = card.querySelector('h2');
                            const newNumber = newStatCards[i].querySelector('h2');
                            if (oldNumber && newNumber && oldNumber.textContent !== newNumber.textContent) {
                                oldNumber.textContent = newNumber.textContent;
                            }
                        });
                    }
                    
                    // 3. Update Table List of Letters (Daftar Surat)
                    const oldTableBody = document.querySelector('table tbody');
                    const newTableBody = doc.querySelector('table tbody');
                    if (oldTableBody && newTableBody) {
                        // Avoid replacing if user has checked any checkbox to prevent losing state
                        const activeCheckboxes = document.querySelectorAll('.surat-checkbox:checked');
                        if (activeCheckboxes.length === 0) {
                            if (oldTableBody.innerHTML !== newTableBody.innerHTML) {
                                oldTableBody.innerHTML = newTableBody.innerHTML;
                            }
                        }
                    }
                })
                .catch(err => console.debug('Realtime sync error:', err));
        }, 10000);
    </script>
    @endauth
    @stack('scripts')
</body>
</html>
