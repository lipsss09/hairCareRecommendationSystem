<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin - HairCare | @yield('title', 'Dashboard')</title>
    <link rel="icon" href="{{ asset('assets/images/icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Sidebar */
        .admin-sidebar {
            width: 240px;
            min-height: 100vh;
            background: linear-gradient(180deg, #1a1a2e 0%, #16213e 100%);
        }
        .admin-sidebar .nav-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 20px;
            color: #94a3b8;
            font-size: 0.95rem;
            border-radius: 10px;
            margin: 4px 12px;
            transition: all 0.2s ease;
        }
        .admin-sidebar .nav-link:hover,
        .admin-sidebar .nav-link.active {
            background: rgba(236, 72, 153, 0.15);
            color: #f9a8d4;
        }
        .admin-sidebar .nav-link.active {
            background: rgba(236, 72, 153, 0.25);
            color: #fbcfe8;
            font-weight: 600;
        }
        .admin-sidebar .nav-link i {
            width: 20px;
            text-align: center;
        }
        /* Main */
        .admin-main {
            flex: 1;
            background: #f8f4f0;
            min-height: 100vh;
        }
        .admin-header {
            background: white;
            border-bottom: 1px solid #e5e7eb;
            padding: 16px 32px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;
        }
        .admin-header button {
            background: #f3f4f6;
            border: none;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background 0.2s;
        }
        .admin-header button:hover {
            background: #fce7f3;
        }
        .admin-content {
            padding: 32px;
        }
    </style>
</head>
<body class="bg-gray-100">

<div class="flex">
    {{-- SIDEBAR --}}
    <aside class="admin-sidebar flex flex-col">
        {{-- Logo --}}
        <div class="flex items-center gap-3 px-6 py-5">
            <img src="{{ asset('assets/images/icon.png') }}" class="h-9 w-9" alt="logo">
            <span class="text-pink-300 font-bold text-lg">Hair Care</span>
        </div>

        {{-- Navigation --}}
        <nav class="flex-1 mt-4">
            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fa-solid fa-house"></i> Dashboard
            </a>
            <a href="{{ route('admin.produk') }}"
               class="nav-link {{ request()->routeIs('admin.produk*') ? 'active' : '' }}">
                <i class="fa-solid fa-box"></i> Produk
            </a>
            <a href="{{ route('admin.pengguna') }}"
               class="nav-link {{ request()->routeIs('admin.pengguna*') ? 'active' : '' }}">
                <i class="fa-solid fa-users"></i> Pengguna
            </a>
            <a href="{{ route('admin.kategori') }}"
               class="nav-link {{ request()->routeIs('admin.kategori*') ? 'active' : '' }}">
                <i class="fa-solid fa-tags"></i> Kategori
            </a>
        </nav>
    </aside>

    {{-- MAIN AREA --}}
    <div class="admin-main">
        {{-- HEADER --}}
        <header class="admin-header">
            <button title="Profile">
                <i class="fa-solid fa-user text-gray-600"></i>
            </button>
            <form method="POST" action="/logout" class="inline">
                @csrf
                <button type="submit" title="Logout">
                    <i class="fa-solid fa-right-from-bracket text-gray-600"></i>
                </button>
            </form>
        </header>

        {{-- CONTENT --}}
        <div class="admin-content">
            @yield('content')
        </div>
    </div>
</div>

@yield('scripts')
</body>
</html>
