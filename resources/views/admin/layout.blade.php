<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Raja Bakery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --adm-bg: #F7E7C9;
            --adm-brown: #a3520f;
            --adm-brown-dark: #873e05;
            --adm-gold: #f3a821;
            --adm-orange: #fd9a02;
            --adm-text: #24190f;
            --adm-muted: #6b533e;
            --adm-card-border: #e0d4c3;
            --adm-line: #ead9bc;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', system-ui, -apple-system, sans-serif;
            background: var(--adm-bg);
            color: var(--adm-text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.5;
        }

        .adm-container {
            width: min(1180px, calc(100% - 48px));
            margin: 0 auto;
        }

        /* ── Header & Navbar ── */
        .adm-header {
            background: #fff;
            border-bottom: 1.5px solid var(--adm-card-border);
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 2px 12px rgba(163, 82, 15, 0.05);
        }

        .adm-header-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 14px 0;
            border-bottom: 1px solid #f0e6d8;
        }

        .adm-brand-wrap {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
            color: var(--adm-brown);
        }

        .adm-brand-logo {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            overflow: hidden;
            background: var(--adm-gold);
            border: 2px solid var(--adm-brown);
            box-shadow: inset 0 0 0 3px #fff3d4;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .adm-brand-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .adm-brand-name {
            font-size: 20px;
            font-weight: 800;
            letter-spacing: .02em;
            color: var(--adm-brown);
        }

        .adm-badge {
            background: var(--adm-gold);
            color: var(--adm-brown);
            font-size: 11px;
            font-weight: 800;
            padding: 3px 10px;
            border-radius: 99px;
            letter-spacing: .06em;
            text-transform: uppercase;
        }

        .adm-user-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .adm-btn-site {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            color: var(--adm-brown);
            font-size: 13px;
            font-weight: 600;
            padding: 6px 14px;
            border-radius: 20px;
            border: 1.5px solid var(--adm-card-border);
            background: #fff;
            transition: all .2s;
        }

        .adm-btn-site:hover {
            border-color: var(--adm-brown);
            color: var(--adm-orange);
            background: #fff9f2;
        }

        .adm-user-pill {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            font-weight: 600;
            color: var(--adm-text);
            background: #fdf6ed;
            padding: 6px 14px;
            border-radius: 20px;
            border: 1px solid var(--adm-line);
        }

        .adm-user-icon {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: var(--adm-gold);
            color: var(--adm-brown);
            display: grid;
            place-items: center;
            font-size: 12px;
        }

        .adm-btn-logout {
            background: #fde8e6;
            color: #b91c1c;
            border: 1px solid #fecaca;
            padding: 6px 16px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            transition: all .2s;
        }

        .adm-btn-logout:hover {
            background: #b91c1c;
            color: #fff;
        }

        /* ── Sub Navigation Tabs ── */
        .adm-nav-bar {
            display: flex;
            align-items: center;
            gap: 8px;
            overflow-x: auto;
            padding: 4px 0;
        }

        .adm-nav-link {
            text-decoration: none;
            color: var(--adm-brown);
            font-size: 13.5px;
            font-weight: 600;
            padding: 10px 16px;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            white-space: nowrap;
            transition: all .15s ease;
            position: relative;
        }

        .adm-nav-link:hover {
            color: var(--adm-orange);
            background: #fff8ee;
        }

        .adm-nav-link.active {
            color: var(--adm-brown);
            background: #fbeed9;
            font-weight: 700;
        }

        .adm-nav-link.active::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 16px;
            right: 16px;
            height: 3px;
            background: var(--adm-orange);
            border-radius: 3px 3px 0 0;
        }

        /* ── Main Content Area ── */
        .adm-main {
            flex: 1;
            padding: 32px 0 60px;
        }

        .adm-page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
            margin-bottom: 24px;
        }

        .adm-page-title {
            font-size: 26px;
            font-weight: 800;
            color: var(--adm-brown);
            letter-spacing: -.01em;
        }

        .adm-page-subtitle {
            font-size: 14px;
            color: var(--adm-muted);
            margin-top: 4px;
        }

        /* ── Flash Alerts ── */
        .adm-alert {
            padding: 12px 18px;
            border-radius: 12px;
            margin-bottom: 24px;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .adm-alert-ok {
            background: #e2f5ea;
            color: #14532d;
            border: 1px solid #bbf7d0;
        }

        .adm-alert-err {
            background: #fde8e6;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* ── Cards ── */
        .adm-card {
            background: #fff;
            border: 1.5px solid var(--adm-card-border);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 20px rgba(163, 82, 15, 0.05);
        }

        .adm-card-clickable {
            text-decoration: none;
            color: inherit;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
        }

        .adm-card-clickable:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(163, 82, 15, 0.12);
            border-color: var(--adm-gold);
        }

        /* ── Grid ── */
        .adm-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .adm-grid-4 {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        /* ── Buttons ── */
        .adm-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--adm-brown);
            color: #fff !important;
            padding: 10px 20px;
            border-radius: 10px;
            font: inherit;
            font-size: 14px;
            font-weight: 700;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: all .15s ease;
            white-space: nowrap;
        }

        .adm-btn:hover {
            background: var(--adm-brown-dark);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(163, 82, 15, 0.25);
        }

        .adm-btn-outline {
            background: #fff;
            color: var(--adm-brown) !important;
            border: 1.5px solid var(--adm-brown);
        }

        .adm-btn-outline:hover {
            background: #fdf6ed;
            color: var(--adm-brown-dark) !important;
        }

        .adm-btn-sm {
            padding: 6px 14px;
            font-size: 13px;
            border-radius: 8px;
        }

        .adm-btn-danger {
            background: #dc2626;
            color: #fff !important;
            border: none;
        }

        .adm-btn-danger:hover {
            background: #b91c1c;
            box-shadow: 0 4px 12px rgba(220, 38, 38, 0.25);
        }

        .adm-btn-danger-outline {
            background: #fff;
            color: #dc2626 !important;
            border: 1.5px solid #fca5a5;
        }

        .adm-btn-danger-outline:hover {
            background: #fef2f2;
            border-color: #dc2626;
        }

        /* ── Form Inputs ── */
        .adm-form-group {
            margin-bottom: 18px;
        }

        .adm-label {
            display: block;
            font-size: 13.5px;
            font-weight: 600;
            color: var(--adm-brown);
            margin-bottom: 6px;
        }

        .adm-input,
        .adm-select,
        .adm-textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid #d4c0a8;
            border-radius: 10px;
            font: inherit;
            font-size: 14.5px;
            background: #fff;
            color: var(--adm-text);
            outline: none;
            transition: border-color .15s ease, box-shadow .15s ease;
        }

        .adm-input:focus,
        .adm-select:focus,
        .adm-textarea:focus {
            border-color: var(--adm-brown);
            box-shadow: 0 0 0 3px rgba(163, 82, 15, 0.12);
        }

        .adm-checkbox-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 500;
            color: var(--adm-text);
            user-select: none;
        }

        .adm-checkbox-label input[type="checkbox"] {
            width: 18px;
            height: 18px;
            accent-color: var(--adm-brown);
            cursor: pointer;
        }

        /* ── Tables ── */
        .adm-table-wrap {
            background: #fff;
            border: 1.5px solid var(--adm-card-border);
            border-radius: 16px;
            overflow-x: auto;
            box-shadow: 0 4px 20px rgba(163, 82, 15, 0.05);
        }

        .adm-table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            text-align: left;
        }

        .adm-table th {
            background: #fdf6ed;
            color: var(--adm-brown);
            font-weight: 700;
            padding: 14px 16px;
            border-bottom: 1.5px solid var(--adm-line);
            white-space: nowrap;
        }

        .adm-table td {
            padding: 14px 16px;
            border-bottom: 1px solid #f2e9dc;
            vertical-align: middle;
        }

        .adm-table tr:last-child td {
            border-bottom: none;
        }

        .adm-table tr:hover td {
            background: #fffbf7;
        }

        /* ── Tags / Badges ── */
        .adm-tag {
            display: inline-block;
            font-size: 12px;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 99px;
            white-space: nowrap;
        }

        .adm-tag-gold {
            background: var(--adm-gold);
            color: var(--adm-brown);
        }

        .adm-tag-success {
            background: #e2f5ea;
            color: #15803d;
        }

        .adm-tag-muted {
            background: #f3f4f6;
            color: #6b7280;
        }

        /* ── Pagination ── */
        .adm-pagination {
            margin-top: 24px;
        }

        .adm-pagination nav {
            display: flex;
            justify-content: center;
        }

        /* ── Footer ── */
        .adm-footer {
            background: var(--adm-brown);
            color: #edf6ff;
            padding: 24px 0;
            margin-top: auto;
        }

        .adm-footer-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 16px;
        }

        .adm-footer-brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--adm-gold);
            font-weight: 700;
            font-size: 16px;
            text-decoration: none;
        }

        .adm-footer-logo {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            overflow: hidden;
            background: var(--adm-gold);
        }

        .adm-footer-logo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .adm-footer-text {
            font-size: 12.5px;
            color: #f7e6d0;
        }

        /* ── Responsive ── */
        @media (max-width: 900px) {
            .adm-grid-4 {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .adm-header-top {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
            }
            .adm-user-actions {
                width: 100%;
                justify-content: space-between;
                flex-wrap: wrap;
            }
            .adm-grid-4 {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    {{-- ── Top Navigation Header ── --}}
    <header class="adm-header">
        <div class="adm-container">
            <div class="adm-header-top">
                <a class="adm-brand-wrap" href="/admin" aria-label="Raja Bakery Admin">
                    <span class="adm-brand-logo">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Raja Bakery">
                    </span>
                    <span class="adm-brand-name">RAJA BAKERY</span>
                    <span class="adm-badge">ADMIN</span>
                </a>

                <div class="adm-user-actions">
                    <a class="adm-btn-site" href="/" target="_blank">
                        <span>Lihat Website</span>
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"></path>
                            <polyline points="15 3 21 3 21 9"></polyline>
                            <line x1="10" y1="14" x2="21" y2="3"></line>
                        </svg>
                    </a>

                    <div class="adm-user-pill">
                        <span class="adm-user-icon">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor">
                                <circle cx="12" cy="7" r="4"/>
                                <path d="M4 21v-2a4 4 0 0 1 4-4h8a4 4 0 0 1 4 4v2"/>
                            </svg>
                        </span>
                        <span>{{ session('user.name') ?? 'Admin' }}</span>
                    </div>

                    <form method="post" action="/logout" style="margin:0">
                        @csrf
                        <button type="submit" class="adm-btn-logout">Logout</button>
                    </form>
                </div>
            </div>

            {{-- ── Admin Menu Tabs ── --}}
            <nav class="adm-nav-bar" aria-label="Menu Admin">
                <a class="adm-nav-link {{ request()->is('admin') ? 'active' : '' }}" href="/admin">
                    <span>📊 Dashboard</span>
                </a>
                <a class="adm-nav-link {{ request()->is('admin/produk*') ? 'active' : '' }}" href="/admin/produk">
                    <span>🍞 Daftar Roti</span>
                </a>
                <a class="adm-nav-link {{ request()->is('admin/hasil*') ? 'active' : '' }}" href="/admin/hasil">
                    <span>📈 Hasil Voting</span>
                </a>
                <a class="adm-nav-link {{ request()->is('admin/periode*') ? 'active' : '' }}" href="/admin/periode">
                    <span>📅 Periode Voting</span>
                </a>
                <a class="adm-nav-link {{ request()->is('admin/sponsor*') ? 'active' : '' }}" href="/admin/sponsor">
                    <span>🤝 Sponsorship</span>
                </a>
            </nav>
        </div>
    </header>

    {{-- ── Main Admin Content ── --}}
    <main class="adm-main">
        <div class="adm-container">
            @if(session('ok'))
                <div class="adm-alert adm-alert-ok">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                        <polyline points="22 4 12 14.01 9 11.01"></polyline>
                    </svg>
                    <span>{{ session('ok') }}</span>
                </div>
            @endif

            @if(session('err'))
                <div class="adm-alert adm-alert-err">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <span>{{ session('err') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="adm-alert adm-alert-err">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <line x1="12" y1="8" x2="12" y2="12"></line>
                        <line x1="12" y1="16" x2="12.01" y2="16"></line>
                    </svg>
                    <div>
                        <strong>Terjadi kesalahan:</strong>
                        <ul style="margin:4px 0 0 16px">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            @yield('content')
            @yield('c')
        </div>
    </main>

    {{-- ── Admin Footer ── --}}
    <footer class="adm-footer">
        <div class="adm-container adm-footer-content">
            <a class="adm-footer-brand" href="/admin">
                <span class="adm-footer-logo">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Raja Bakery">
                </span>
                <span>RAJA BAKERY - PANEL ADMIN</span>
            </a>
            <div class="adm-footer-text">
                &copy; {{ date('Y') }} Raja Bakery. Hak cipta dilindungi undang-undang.
            </div>
        </div>
    </footer>

</body>
</html>
