@extends('layout')
@section('c')
<style>
/* ── Hide layout defaults ── */
body:has(.detail-page) > nav,
body:has(.detail-page) > .adm,
body:has(.detail-page) > footer { display: none }
body:has(.detail-page) > .w    { width: 100% !important; max-width: none !important; margin: 0 !important; padding: 0 !important }

/* ── Page shell ── */
.detail-page {
    --dp-bg:     #F7E7C9;
    --dp-brown:  #a3520f;
    --dp-gold:   #f3a821;
    --dp-orange: #fd9a02;
    --dp-card:   #a8550a;
    background: var(--dp-bg);
    color: #24190f;
    font-family: Poppins, system-ui, sans-serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
.detail-page * { box-sizing: border-box }
.detail-container { width: min(1156px, calc(100% - 48px)); margin: 0 auto }

/* ── Navbar ── */
.detail-header {
    height: 86px;
    display: flex;
    align-items: center;
    gap: 32px;
}
.detail-brand {
    display: flex; align-items: center; gap: 12px;
    margin-right: auto;
    text-decoration: none;
    color: var(--dp-brown) !important;
    font-size: 21px; font-weight: 800;
    letter-spacing: .02em; white-space: nowrap;
}
.detail-brand-mark {
    width: 48px; height: 48px;
    border-radius: 50%; overflow: hidden;
    background: var(--dp-gold);
    border: 2px solid var(--dp-brown);
    box-shadow: inset 0 0 0 3px #fff3d4;
    display: grid; place-items: center;
}
.detail-brand-mark img { width: 100%; height: 100%; object-fit: cover }
.detail-nav {
    display: flex; align-items: center;
    gap: clamp(18px, 3vw, 44px);
}
.detail-nav a {
    text-decoration: none;
    text-transform: uppercase;
    color: var(--dp-brown);
    font-size: clamp(12px, 1.25vw, 16px);
    font-weight: 500; white-space: nowrap;
}
.detail-nav a:hover,
.detail-nav a.active {
    color: var(--dp-orange);
    border-bottom: 2px solid var(--dp-orange);
    padding-bottom: 2px;
}
.detail-account {
    width: 36px; height: 36px;
    border-radius: 50%; background: #ddd;
    display: grid; place-items: center;
    text-decoration: none;
    color: var(--dp-brown) !important;
}

/* ── Content ── */
.detail-content {
    flex: 1;
    padding: 32px 0 64px;
}

/* ── Back link ── */
.detail-back {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    color: var(--dp-brown);
    text-decoration: none;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 28px;
}
.detail-back:hover { color: var(--dp-orange) }

/* ── Card layout ── */
.detail-card {
    background: #fff;
    border: 1.5px solid #e0d4c3;
    border-radius: 20px;
    overflow: hidden;
    display: grid;
    grid-template-columns: 480px 1fr;
    gap: 0;
    box-shadow: 0 8px 32px #a3520f10;
    max-width: 940px;
    margin: 0 auto;
}

/* ── Product image ── */
.detail-img-wrap {
    background: var(--dp-gold);
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 300px;
    overflow: hidden;
    aspect-ratio: 1390 / 1132;
}
.detail-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}
.detail-img-placeholder {
    font-size: 15px;
    color: rgba(255,255,255,.7);
    font-style: italic;
}

/* ── Product info ── */
.detail-info {
    padding: 36px 36px 32px;
    display: flex;
    flex-direction: column;
    gap: 0;
}
.detail-badge {
    display: inline-block;
    background: var(--dp-gold);
    color: var(--dp-brown);
    font-size: 12px;
    font-weight: 700;
    padding: 3px 12px;
    border-radius: 20px;
    margin-bottom: 14px;
    text-transform: uppercase;
    letter-spacing: .05em;
}
.detail-name {
    font-size: clamp(22px, 3vw, 32px);
    font-weight: 800;
    color: var(--dp-brown);
    margin: 0 0 6px;
    line-height: 1.2;
}
.detail-price {
    font-size: 22px;
    font-weight: 700;
    color: var(--dp-orange);
    margin: 0 0 20px;
}
.detail-price span { font-size: 14px; color: #8a6a4a; font-weight: 400 }

.detail-divider {
    height: 1px;
    background: #ead9bc;
    margin: 0 0 20px;
}

.detail-meta-row {
    display: flex;
    gap: 8px;
    align-items: baseline;
    margin-bottom: 10px;
    font-size: 14px;
}
.detail-meta-label {
    color: #8a6a4a;
    font-weight: 600;
    min-width: 70px;
}
.detail-meta-value {
    color: #24190f;
    font-weight: 500;
}

.detail-desc {
    font-size: 15px;
    line-height: 1.65;
    color: #3d2b18;
    margin: 16px 0 24px;
    flex: 1;
}

.detail-votes-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #fdf6ed;
    border: 1px solid #ead9bc;
    border-radius: 10px;
    padding: 10px 16px;
    font-size: 14px;
    color: var(--dp-brown);
    margin-bottom: 20px;
}
.detail-votes-badge strong { font-size: 18px; font-weight: 800 }

.detail-vote-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    width: 100%;
    padding: 14px;
    background: var(--dp-brown);
    color: #fff;
    border: none;
    border-radius: 12px;
    font: inherit;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    transition: background .15s;
}
.detail-vote-btn:hover { background: var(--dp-card) }

/* ── Flash messages ── */
.detail-flash {
    padding: 10px 16px;
    border-radius: 10px;
    font-size: 14px;
    margin-bottom: 16px;
}
.detail-flash.ok  { background: #e2f5ea; color: #166534 }
.detail-flash.err { background: #fde8e6; color: #9b1c1c }

/* ── Responsive ── */
@media (max-width: 860px) {
    .detail-card {
        grid-template-columns: 1fr;
        max-width: 540px;
    }
    .detail-img-wrap { min-height: 300px }
}
@media (max-width: 720px) {
    .detail-header { gap: 16px }
    .detail-nav { gap: 14px }
    .detail-nav a { font-size: 12px }
}
@media (max-width: 480px) {
    .detail-container { width: calc(100% - 32px) }
    .detail-header { flex-wrap: wrap; height: auto; min-height: 76px; padding: 12px 0 }
    .detail-nav { order: 3; width: 100%; justify-content: space-between }
    .detail-nav a { font-size: 10px }
    .detail-info { padding: 24px 20px 24px }
    .detail-img-wrap { min-height: 240px }
}
</style>

<div class="detail-page">

    {{-- ── Navbar ── --}}
    <div class="detail-container">
        <header class="detail-header">
            <a class="detail-brand" href="/" aria-label="Raja Bakery – Beranda">
                <span class="detail-brand-mark">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Raja Bakery">
                </span>
                <span>RAJA BAKERY</span>
            </a>
            <nav class="detail-nav" aria-label="Navigasi utama">
                <a href="/">BERANDA</a>
                <a href="/produk" class="active">MENU</a>
                <a href="/peringkat">ROTI TERPOPULER</a>
                <a href="/sponsorship">SPONSORSHIP</a>
            </nav>
            <a class="detail-account" href="/login" aria-label="Masuk admin">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.7"/>
                    <path d="M5.5 20c.4-3.5 2.7-5.3 6.5-5.3s6.1 1.8 6.5 5.3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                </svg>
            </a>
        </header>
    </div>

    {{-- ── Detail Content ── --}}
    <div class="detail-container detail-content">

        <a class="detail-back" href="/produk">← Kembali ke Menu</a>

        @if(session('ok'))
            <div class="detail-flash ok">{{ session('ok') }}</div>
        @endif
        @if(session('err'))
            <div class="detail-flash err">{{ session('err') }}</div>
        @endif

        <div class="detail-card">
            {{-- Foto --}}
            <div class="detail-img-wrap">
                @if($produk->foto)
                    <img src="{{ asset('storage/'.$produk->foto) }}" alt="{{ $produk->nama }}">
                @else
                    <div class="detail-img-placeholder">Foto belum tersedia</div>
                @endif
            </div>

            {{-- Info --}}
            <div class="detail-info">
                @if($produk->kategori)
                    <span class="detail-badge">{{ $produk->kategori }}</span>
                @endif

                <h1 class="detail-name">{{ $produk->nama }}</h1>

                <p class="detail-price">
                    @if($produk->harga)
                        Rp{{ number_format($produk->harga, 0, ',', '.') }}
                    @else
                        <span>Hubungi toko untuk harga</span>
                    @endif
                </p>

                <div class="detail-divider"></div>

                @if($produk->rasa)
                    <div class="detail-meta-row">
                        <span class="detail-meta-label">Rasa</span>
                        <span class="detail-meta-value">{{ $produk->rasa }}</span>
                    </div>
                @endif

                @if($produk->deskripsi)
                    <p class="detail-desc">{{ $produk->deskripsi }}</p>
                @endif

                <div class="detail-votes-badge">
                    <strong>{{ $votes }}</strong>
                    <span>vote pada periode ini</span>
                </div>

                @if($periode && $produk->bisa_divote)
                    <form method="post" action="/produk/{{ $produk->id_produk }}/vote">
                        @csrf
                        <button class="detail-vote-btn" type="submit">
                            🗳 Vote Roti Ini
                        </button>
                    </form>
                @endif
            </div>
        </div>

    </div>

</div>
@endsection
