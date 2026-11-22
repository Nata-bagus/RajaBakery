@extends('layout')
@section('c')
<style>
/* ── Hide layout defaults ── */
body:has(.login-page) > nav,
body:has(.login-page) > .adm,
body:has(.login-page) > footer { display: none }
body:has(.login-page) > .w    { width: 100% !important; max-width: none !important; margin: 0 !important; padding: 0 !important }

/* ── Page shell ── */
.login-page {
    --lp-bg:     #F7E7C9;
    --lp-brown:  #a3520f;
    --lp-gold:   #f3a821;
    --lp-orange: #fd9a02;
    background: var(--lp-bg);
    color: #24190f;
    font-family: Poppins, system-ui, sans-serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
.login-page * { box-sizing: border-box }
.login-container { width: min(1156px, calc(100% - 48px)); margin: 0 auto }

/* ── Navbar ── */
.login-header {
    height: 86px;
    display: flex;
    align-items: center;
    gap: 32px;
}
.login-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-right: auto;
    text-decoration: none;
    color: var(--lp-brown) !important;
    font-size: 21px;
    font-weight: 800;
    letter-spacing: .02em;
    white-space: nowrap;
}
.login-brand-mark {
    width: 48px; height: 48px;
    border-radius: 50%;
    overflow: hidden;
    background: var(--lp-gold);
    border: 2px solid var(--lp-brown);
    box-shadow: inset 0 0 0 3px #fff3d4;
    display: grid; place-items: center;
}
.login-brand-mark img { width: 100%; height: 100%; object-fit: cover }
.login-nav {
    display: flex;
    align-items: center;
    gap: clamp(18px, 3vw, 44px);
}
.login-nav a {
    text-decoration: none;
    text-transform: uppercase;
    color: var(--lp-brown);
    font-size: clamp(12px, 1.25vw, 16px);
    font-weight: 500;
    white-space: nowrap;
}
.login-nav a:hover,
.login-nav a.active {
    color: var(--lp-orange);
    border-bottom: 2px solid var(--lp-orange);
    padding-bottom: 2px;
}
.login-account {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: #ddd;
    display: grid; place-items: center;
    text-decoration: none;
    color: var(--lp-brown) !important;
    font-size: 17px;
}

/* ── Login card ── */
.login-content {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 16px 60px;
}
.login-card {
    background: #fff;
    border: 1px solid #e0d4c3;
    border-radius: 20px;
    padding: 40px 36px;
    width: 100%;
    max-width: 420px;
    box-shadow: 0 8px 32px #a3520f14;
}
.login-card-logo {
    display: flex;
    justify-content: center;
    margin-bottom: 20px;
}
.login-card-logo-mark {
    width: 64px; height: 64px;
    border-radius: 50%;
    overflow: hidden;
    background: var(--lp-gold);
    border: 3px solid var(--lp-brown);
    box-shadow: inset 0 0 0 4px #fff3d4;
}
.login-card-logo-mark img { width: 100%; height: 100%; object-fit: cover }
.login-card h2 {
    text-align: center;
    font-size: 22px;
    font-weight: 800;
    color: var(--lp-brown);
    margin: 0 0 6px;
}
.login-card p.login-sub {
    text-align: center;
    font-size: 13px;
    color: #8a6a4a;
    margin: 0 0 28px;
}
.login-label {
    display: block;
    font-size: 13px;
    font-weight: 600;
    color: var(--lp-brown);
    margin: 0 0 5px;
}
.login-input {
    width: 100%;
    padding: 11px 14px;
    border: 1.5px solid #d4c0a8;
    border-radius: 10px;
    font: inherit;
    font-size: 15px;
    background: #fdf9f5;
    color: #24190f;
    outline: none;
    margin-bottom: 18px;
    transition: border-color .15s;
}
.login-input:focus { border-color: var(--lp-brown); background: #fff }
.login-btn {
    width: 100%;
    padding: 13px;
    background: var(--lp-brown);
    color: #fff;
    border: none;
    border-radius: 10px;
    font: inherit;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    margin-top: 6px;
    transition: background .15s;
}
.login-btn:hover { background: #8a430c }
.login-back {
    display: block;
    text-align: center;
    margin-top: 18px;
    font-size: 13px;
    color: var(--lp-brown);
    text-decoration: none;
}
.login-back:hover { text-decoration: underline }

/* ── Error / success flash ── */
.login-alert {
    padding: 10px 14px;
    border-radius: 8px;
    margin-bottom: 18px;
    font-size: 14px;
}
.login-alert.err { background: #fde8e6; color: #9b1c1c }
.login-alert.ok  { background: #e2f5ea; color: #166534 }

/* ── Footer ── */
.login-footer {
    background: var(--lp-brown);
    color: #edf6ff;
    padding: 28px 0;
}
.login-footer-grid {
    display: grid;
    grid-template-columns: 1.35fr .8fr .9fr 1.2fr;
    gap: 28px;
    align-items: start;
}
.login-footer-brand {
    display: flex; align-items: center; gap: 12px;
    color: var(--lp-gold) !important;
    font-size: 20px; font-weight: 800;
    text-decoration: none; margin-bottom: 10px;
}
.login-footer-brand-mark {
    width: 48px; height: 48px; border-radius: 50%;
    overflow: hidden; background: var(--lp-gold);
    border: 2px solid #fff3d4;
}
.login-footer-brand-mark img { width: 100%; height: 100%; object-fit: cover }
.login-social { display: flex; gap: 18px; margin-top: 8px }
.login-social a { color: #fff; text-decoration: none; font-size: 15px; font-weight: 700 }
.login-footer-col h3 {
    font-size: 13px; margin: 5px 0 14px; font-weight: 600; color: #edf6ff;
}
.login-footer-col h3::after {
    content: ''; display: block; width: 35px; height: 1px;
    background: #edf6ff; margin-top: 8px;
}
.login-footer-col a,
.login-footer-col p {
    display: block; color: #edf6ff; text-decoration: none;
    font-size: 11px; line-height: 1.7; margin: 0;
}
.login-footer-col a:hover { text-decoration: underline }

/* ── Responsive ── */
@media (max-width: 720px) {
    .login-header { gap: 16px }
    .login-nav { gap: 14px }
    .login-nav a { font-size: 12px }
    .login-footer-grid { grid-template-columns: 1fr 1fr; gap: 20px 14px }
    .login-footer-brand { grid-column: 1 / -1 }
}
@media (max-width: 480px) {
    .login-container { width: calc(100% - 32px) }
    .login-header { flex-wrap: wrap; height: auto; min-height: 76px; padding: 12px 0 }
    .login-nav { order: 3; width: 100%; justify-content: space-between }
    .login-nav a { font-size: 10px }
    .login-card { padding: 28px 20px }
}
</style>

<div class="login-page">

    {{-- ── Navbar ── --}}
    <div class="login-container">
        <header class="login-header">
            <a class="login-brand" href="/" aria-label="Raja Bakery – Beranda">
                <span class="login-brand-mark">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Raja Bakery">
                </span>
                <span>RAJA BAKERY</span>
            </a>
            <nav class="login-nav" aria-label="Navigasi utama">
                <a href="/">BERANDA</a>
                <a href="/produk">MENU</a>
                <a href="/peringkat">ROTI TERPOPULER</a>
                <a href="/sponsorship">SPONSORSHIP</a>
            </nav>
            <a class="login-account active" href="/login" aria-label="Masuk admin">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.7"/>
                    <path d="M5.5 20c.4-3.5 2.7-5.3 6.5-5.3s6.1 1.8 6.5 5.3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                </svg>
            </a>
        </header>
    </div>

    {{-- ── Login Card ── --}}
    <div class="login-content">
        <div class="login-card">
            <div class="login-card-logo">
                <span class="login-card-logo-mark">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Raja Bakery">
                </span>
            </div>
            <h2>Login Admin</h2>
            <p class="login-sub">Masuk untuk mengelola Raja Bakery</p>

            @if(session('err'))
                <div class="login-alert err">{{ session('err') }}</div>
            @endif
            @if(session('ok'))
                <div class="login-alert ok">{{ session('ok') }}</div>
            @endif
            @if($errors->any())
                <div class="login-alert err">{{ $errors->first() }}</div>
            @endif

            <form method="post" action="/login">
                @csrf
                <label class="login-label" for="email">Email</label>
                <input
                    class="login-input"
                    type="email"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="admin@rajabakery.com"
                    required
                    autocomplete="email"
                >
                <label class="login-label" for="password">Kata Sandi</label>
                <input
                    class="login-input"
                    type="password"
                    id="password"
                    name="password"
                    placeholder="••••••••"
                    required
                    autocomplete="current-password"
                >
                <button class="login-btn" type="submit">Masuk</button>
            </form>

            <a class="login-back" href="/">← Kembali ke Beranda</a>
        </div>
    </div>


</div>
@endsection
