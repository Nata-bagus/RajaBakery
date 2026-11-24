<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Raja Bakery</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <style>
        :root {
            --or: #F3A821;
            --br: #A3520F;
            --dk: #3B2410;
            --bg: #edf6ff;
            --ln: #EAD9BC;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Poppins', system-ui, sans-serif;
            background: var(--bg);
            color: var(--dk);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            line-height: 1.5;
        }

        .w {
            width: 100%;
            max-width: 1156px;
            margin: 0 auto;
            padding: 24px 24px 40px;
            flex: 1;
        }

        body:has(.home-page) > .w,
        body:has(.menu-page) > .w,
        body:has(.rank-page) > .w,
        body:has(.sp-page) > .w,
        body:has(.detail-page) > .w,
        body:has(.login-page) > .w {
            width: 100% !important;
            max-width: none !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* ── Navigation ── */
        nav {
            position: sticky;
            top: 0;
            z-index: 50;
            background: #F7E7C9; 

        }

        nav .w {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 12px 0;
            flex-wrap: wrap;
        }

        .brand-link {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: var(--br);
            font-size: 20px;
            font-weight: 800;
            letter-spacing: .02em;
            margin-right: auto;
        }

        .brand-mark {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            overflow: hidden;
            background: var(--or);
            border: 2px solid var(--br);
            box-shadow: inset 0 0 0 3px #fff3d4;
            display: grid;
            place-items: center;
            flex-shrink: 0;
        }

        .brand-mark img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        nav a.nav-item {
            text-decoration: none;
            text-transform: uppercase;
            font-weight: 600;
            font-size: 13.5px;
            color: var(--br);
            transition: color .15s;
        }

        nav a.nav-item:hover {
            color: var(--or);
        }

        .btn {
            background: var(--br);
            color: #fff;
            border: 0;
            border-radius: 8px;
            padding: 8px 16px;
            cursor: pointer;
            text-decoration: none;
            font: inherit;
            font-weight: 600;
            font-size: 14px;
            display: inline-block;
            transition: background .15s;
        }

        .btn:hover {
            background: #873e05;
        }

        .btn.o {
            background: #fff;
            color: var(--br);
            border: 1.5px solid var(--br);
        }

        .btn.o:hover {
            background: #fdf6ed;
        }

        .g {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(230px, 1fr));
            gap: 16px;
        }

        .c {
            background: #fff;
            border: 1.5px solid var(--ln);
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 4px 16px rgba(163, 82, 15, 0.04);
        }

        .ph {
            height: 140px;
            width: 100%;
            border-radius: 10px;
            background: var(--or);
            object-fit: contain;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #d4c0a8;
            border-radius: 8px;
            font: inherit;
            outline: none;
            background: #fff;
        }

        input:focus, select:focus, textarea:focus {
            border-color: var(--br);
        }

        label {
            display: block;
            margin: 10px 0 4px;
            font-weight: 600;
            font-size: 13.5px;
            color: var(--br);
        }

        .m {
            padding: 12px 16px;
            border-radius: 10px;
            margin: 14px 0;
            font-size: 14px;
            font-weight: 500;
        }

        .ok {
            background: #e2f5ea;
            color: #14532d;
            border: 1px solid #bbf7d0;
        }

        .er {
            background: #fde8e6;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        .tag {
            background: var(--or);
            color: var(--br);
            border-radius: 99px;
            padding: 2px 10px;
            font-size: 12px;
            font-weight: 700;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
        }

        td, th {
            padding: 12px 14px;
            border-bottom: 1px solid var(--ln);
            text-align: left;
            font-size: 14px;
        }

        th {
            background: #fdf6ed;
            color: var(--br);
            font-weight: 700;
        }

        .f {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            margin: 16px 0;
        }

        .f > * {
            width: auto;
            flex: 1;
            min-width: 140px;
        }

        .adm {
            background: var(--dk);
            color: #fff;
            padding: 6px 0;
            font-size: 13.5px;
        }

        .adm .w {
            padding: 6px 0;
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .adm a {
            color: var(--or);
            font-weight: 600;
            text-decoration: none;
        }

        .adm a:hover {
            text-decoration: underline;
        }

        footer {
            background: var(--br);
            color: #edf6ff;
            padding: 24px 0;
            margin-top: auto;
        }

        footer .w {
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
        }

        footer a {
            color: #fff;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <nav>
        <div class="w" style="padding:10px 0">
            <a class="brand-link" href="/">
                <span class="brand-mark">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Raja Bakery">
                </span>
                <span>RAJA BAKERY</span>
            </a>

            <a class="nav-item" href="/">Beranda</a>
            <a class="nav-item" href="/produk">Menu</a>
            <a class="nav-item" href="/peringkat">Roti Terpopuler</a>
            <a class="nav-item" href="/sponsorship">Sponsorship</a>
            <a class="nav-item" href="/kontak">Kontak</a>

            @if(session('user'))
                <a class="btn o" href="/admin" style="padding:6px 14px; font-size:13px">Panel Admin</a>
                <form method="post" action="/logout" style="margin:0">
                    @csrf
                    <button class="btn" style="padding:6px 14px; font-size:13px">Logout</button>
                </form>
            @else
                <a class="btn" href="/login" style="padding:6px 14px; font-size:13px">Masuk Admin</a>
            @endif
        </div>
    </nav>

    @if(session('user'))
        <div class="adm">
            <div class="w">
                <strong>Admin Menu:</strong>
                <a href="/admin">Dashboard</a>
                <a href="/admin/produk">Daftar Roti</a>
                <a href="/admin/hasil">Hasil Voting</a>
                <a href="/admin/periode">Periode Voting</a>
                <a href="/admin/sponsor">Sponsorship</a>
            </div>
        </div>
    @endif

    <div class="w">
        @if(session('ok'))
            <div class="m ok">{{ session('ok') }}</div>
        @endif
        @if(session('err'))
            <div class="m er">{{ session('err') }}</div>
        @endif
        @if($errors->any())
            <div class="m er">{{ $errors->first() }}</div>
        @endif

        @yield('c')
        @yield('content')
    </div>

    @php($ft = \Illuminate\Support\Facades\DB::table('profil_toko')->first())
    <footer>
        <div class="w">
            <div style="display:flex; align-items:center; gap:10px">
                <span class="brand-mark" style="width:32px; height:32px">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Raja Bakery">
                </span>
                <strong>RAJA BAKERY</strong>
            </div>
            <div style="font-size:13px">
                {{ $ft->alamat ?? 'Jl. Abdul Hadi no 13 Kota Malang' }}
            </div>
            <div style="font-size:13px; display:flex; gap:12px">
                @foreach(['instagram', 'facebook', 'tiktok'] as $s)
                    @if(!empty($ft->$s))
                        <a href="{{ $ft->$s }}" target="_blank">{{ ucfirst($s) }}</a>
                    @endif
                @endforeach
            </div>
        </div>
    </footer>

</body>
</html>
