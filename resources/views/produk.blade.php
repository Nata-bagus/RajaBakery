@extends('layout')
@section('c')
<style>
/* ── Override layout defaults for the menu page ── */
body:has(.menu-page) > nav,
body:has(.menu-page) > .adm,
body:has(.menu-page) > footer { display: none }
body:has(.menu-page) > .w  { max-width: none; padding: 0 }

/* ── Page shell ── */
.menu-page {
    --mp-bg:     #F7E7C9;
    --mp-brown:  #a3520f;
    --mp-gold:   #f3a821;
    --mp-orange: #fd9a02;
    --mp-card:   #a8550a;
    --mp-photo:  #f3a821;
    background: var(--mp-bg);
    color: #24190f;
    font-family: Poppins, system-ui, sans-serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
.menu-page * { box-sizing: border-box }
.menu-container { width: min(1156px, calc(100% - 48px)); margin: 0 auto }

/* ── Navbar ── */
.menu-header {
    height: 86px;
    display: flex;
    align-items: center;
    gap: 32px;
}
.menu-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-right: auto;
    text-decoration: none;
    color: var(--mp-brown) !important;
    font-size: 21px;
    font-weight: 800;
    letter-spacing: .02em;
    white-space: nowrap;
}
.menu-brand-mark {
    width: 48px; height: 48px;
    border-radius: 50%;
    display: grid; place-items: center;
    overflow: hidden;
    background: var(--mp-gold);
    border: 2px solid var(--mp-brown);
    box-shadow: inset 0 0 0 3px #fff3d4;
}
.menu-brand-mark img { width: 100%; height: 100%; object-fit: cover }
.menu-nav {
    display: flex;
    align-items: center;
    gap: clamp(18px, 3vw, 44px);
}
.menu-nav a {
    text-decoration: none;
    text-transform: uppercase;
    color: var(--mp-brown);
    font-size: clamp(12px, 1.25vw, 16px);
    font-weight: 500;
    white-space: nowrap;
}
.menu-nav a:hover,
.menu-nav a.active { color: var(--mp-orange); border-bottom: 2px solid var(--mp-orange); padding-bottom: 2px }
.menu-account {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: #ddd;
    display: grid; place-items: center;
    text-decoration: none;
    color: var(--mp-brown) !important;
    font-size: 17px;
}

/* ── Search & filter bar ── */
.menu-search-wrap { padding: 32px 0 10px }
.menu-search-form {
    display: flex;
    gap: 0;
    max-width: 540px;
}
.menu-search-form input[type=text] {
    flex: 1;
    padding: 11px 18px;
    border: 1px solid #c9bfb3;
    border-right: none;
    border-radius: 8px 0 0 8px;
    font: inherit;
    font-size: 15px;
    background: #fff;
    outline: none;
}
.menu-search-form input[type=text]:focus { border-color: var(--mp-brown) }
.menu-search-form button {
    padding: 11px 28px;
    background: var(--mp-brown);
    color: #fff;
    border: none;
    border-radius: 0 20px 20px 0;
    font: inherit;
    font-size: 15px;
    font-weight: 700;
    cursor: pointer;
    white-space: nowrap;
}
.menu-search-form button:hover { background: var(--mp-card) }

.menu-filter-row {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 14px;
}
.menu-filter-btn {
    padding: 7px 20px;
    border-radius: 20px;
    border: 1.5px solid var(--mp-brown);
    background: #fff;
    color: var(--mp-brown);
    font: inherit;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    text-decoration: none;
    display: inline-block;
    transition: background .15s, color .15s;
}
.menu-filter-btn:hover,
.menu-filter-btn.active {
    background: var(--mp-brown);
    color: #fff;
}

/* ── Product grid ── */
.menu-grid-wrap { padding: 28px 0 60px; flex: 1 }
.menu-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 18px;
}

/* ── Product card ── */
.menu-card {
    background: var(--mp-card);
    border-radius: 16px;
    overflow: hidden;
    display: flex;
    flex-direction: column;
    text-decoration: none;
    color: inherit;
    transition: transform .18s ease, box-shadow .18s ease;
}
.menu-card:hover { transform: translateY(-4px); box-shadow: 0 12px 28px #5c310f33 }

.menu-card-photo {
    background: var(--mp-photo);
    aspect-ratio: 1390 / 1132;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    border-radius: 12px;
    margin: 10px 10px 0;
    aspect-ratio: 1390 / 1132;
}
.menu-card-photo img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
}
.menu-card-photo-placeholder {
    width: 100%; height: 100%;
    display: flex; align-items: center; justify-content: center;
    color: #fff8;
    font-size: 13px;
    font-style: italic;
}

.menu-card-body { padding: 12px 14px 16px }
.menu-card-name {
    font-size: 16px;
    font-weight: 700;
    color: var(--mp-gold);
    margin: 0 0 4px;
    line-height: 1.3;
}
.menu-card-price {
    font-size: 14px;
    color: #fff;
    margin: 0 0 6px;
}
.menu-card-votes {
    font-size: 12px;
    color: #ffe8b7;
    margin: 0 0 10px;
}
.menu-card-vote-form button {
    padding: 6px 16px;
    background: var(--mp-gold);
    color: var(--mp-brown);
    border: none;
    border-radius: 20px;
    font: inherit;
    font-size: 13px;
    font-weight: 700;
    cursor: pointer;
}
.menu-card-vote-form button:hover { background: #ffb733 }

.menu-empty {
    grid-column: 1 / -1;
    text-align: center;
    padding: 50px 20px;
    color: #68451f;
    font-size: 16px;
}

/* ── Pagination ── */
.menu-pagination { margin-top: 24px }
.menu-pagination nav { display: flex; justify-content: center }

/* ── Footer (reuse home-page footer styles via shared classes) ── */
.menu-footer {
    background: var(--mp-brown);
    color: #edf6ff;
    padding: 28px 0;
    margin-top: 0;
}
.menu-footer-grid {
    display: grid;
    grid-template-columns: 1.35fr .8fr .9fr 1.2fr;
    gap: 28px;
    align-items: start;
}
.menu-footer-brand {
    display: flex; align-items: center; gap: 12px;
    color: var(--mp-gold) !important;
    font-size: 20px; font-weight: 800;
    text-decoration: none; margin-bottom: 10px;
}
.menu-footer-brand-mark {
    width: 48px; height: 48px; border-radius: 50%;
    overflow: hidden; background: var(--mp-gold);
    border: 2px solid #fff3d4;
}
.menu-footer-brand-mark img { width: 100%; height: 100%; object-fit: cover }
.menu-social { display: flex; gap: 18px; margin-top: 8px }
.menu-social a { color: #fff; text-decoration: none; font-size: 15px; font-weight: 700 }
.menu-footer-col h3 {
    font-size: 13px; margin: 5px 0 14px; font-weight: 600; color: #edf6ff;
}
.menu-footer-col h3::after {
    content: ''; display: block; width: 35px; height: 1px;
    background: #edf6ff; margin-top: 8px;
}
.menu-footer-col a,
.menu-footer-col p {
    display: block; color: #edf6ff; text-decoration: none;
    font-size: 11px; line-height: 1.7; margin: 0;
}
.menu-footer-col a:hover { text-decoration: underline }

/* ── Responsive ── */
@media (max-width: 1024px) {
    .menu-grid { grid-template-columns: repeat(3, 1fr) }
}
@media (max-width: 720px) {
    .menu-grid { grid-template-columns: repeat(2, 1fr) }
    .menu-header { gap: 16px }
    .menu-nav { gap: 14px }
    .menu-nav a { font-size: 12px }
    .menu-footer-grid { grid-template-columns: 1fr 1fr; gap: 20px 14px }
    .menu-footer-brand { grid-column: 1 / -1 }
}
@media (max-width: 480px) {
    .menu-container { width: calc(100% - 32px) }
    .menu-grid { grid-template-columns: repeat(2, 1fr); gap: 12px }
    .menu-header { flex-wrap: wrap; height: auto; min-height: 76px; padding: 12px 0 }
    .menu-nav { order: 3; width: 100%; justify-content: space-between }
    .menu-nav a { font-size: 10px }
}
</style>

<div class="menu-page">

    {{-- ── Navbar ── --}}
    <div class="menu-container">
        <header class="menu-header">
            <a class="menu-brand" href="/" aria-label="Raja Bakery – Beranda">
                <span class="menu-brand-mark">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Raja Bakery">
                </span>
                <span>RAJA BAKERY</span>
            </a>
            <nav class="menu-nav" aria-label="Navigasi utama">
                <a href="/">BERANDA</a>
                <a href="/produk" class="active">MENU</a>
                <a href="/peringkat">ROTI TERPOPULER</a>
                <a href="/sponsorship">SPONSORSHIP</a>
            </nav>
            <a class="menu-account" href="/login" aria-label="Masuk admin">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.7"/>
                    <path d="M5.5 20c.4-3.5 2.7-5.3 6.5-5.3s6.1 1.8 6.5 5.3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                </svg>
            </a>
        </header>
    </div>

    {{-- ── Search & Filter ── --}}
    <div class="menu-container menu-search-wrap">

        @if($periode)
            <p style="margin:0 0 14px;font-size:14px;color:#68451f">
                {{ $periode->nama }} – dibuka sampai {{ $periode->tanggal_selesai }}
            </p>
        @endif

        <form class="menu-search-form" method="get" role="search">
            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                placeholder="Cari Roti..."
                aria-label="Cari roti"
            >
            <input type="hidden" name="kategori" value="{{ request('kategori') }}">
            <button type="submit">Cari</button>
        </form>

        <div class="menu-filter-row" role="group" aria-label="Filter kategori">
            @foreach(['' => 'Semua', 'manis' => 'Roti Manis', 'asin' => 'Roti Gurih', 'donat' => 'Donat', 'inovasi' => 'Roti Inovasi'] as $k => $l)
                <a
                    class="menu-filter-btn {{ request('kategori', '') == $k ? 'active' : '' }}"
                    href="{{ request()->fullUrlWithQuery(['kategori' => $k ?: null, 'page' => null]) }}"
                >{{ $l }}</a>
            @endforeach
        </div>
    </div>

    {{-- ── Product Grid ── --}}
    <div class="menu-container menu-grid-wrap">
        <div class="menu-grid">
            @forelse($produk as $p)
                <div class="menu-card">
                    <a href="/produk/{{ $p->id_produk }}" style="text-decoration:none;color:inherit;display:contents">
                        <div class="menu-card-photo">
                            @if($p->foto)
                                <img src="{{ asset('storage/'.$p->foto) }}" alt="{{ $p->nama }}">
                            @else
                                <div class="menu-card-photo-placeholder">Foto roti</div>
                            @endif
                        </div>
                        <div class="menu-card-body">
                            <p class="menu-card-name">{{ $p->nama }}</p>
                            <p class="menu-card-price">
                                @if($p->harga)
                                    Rp{{ number_format($p->harga, 0, ',', '.') }}
                                @else
                                    Hubungi toko
                                @endif
                            </p>
                            <p class="menu-card-votes">{{ $p->votes_count }} vote</p>
                        </div>
                    </a>
                    @if($periode)
                        <div style="padding: 0 14px 14px">
                            <form class="menu-card-vote-form" method="post" action="/produk/{{ $p->id_produk }}/vote">
                                @csrf
                                <button type="submit">Vote</button>
                            </form>
                        </div>
                    @endif
                </div>
            @empty
                <div class="menu-empty">
                    {{ request('q') || request('kategori') ? 'Roti tidak ditemukan.' : 'Daftar roti masih kosong.' }}
                </div>
            @endforelse
        </div>

        <div class="menu-pagination">
            {{ $produk->links() }}
        </div>
    </div>

    {{-- ── Footer ── --}}
    @php($ft = \Illuminate\Support\Facades\DB::table('profil_toko')->first())
    <footer class="menu-footer">
        <div class="menu-container menu-footer-grid">
            <div>
                <a class="menu-footer-brand" href="/">
                    <span class="menu-footer-brand-mark">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Raja Bakery">
                    </span>
                    <span>RAJA BAKERY</span>
                </a>
                <div class="menu-social">
                    @foreach(['instagram' => 'IG', 'facebook' => 'f', 'tiktok' => '♪'] as $net => $lbl)
                        @if(!empty($ft->$net))
                            <a href="{{ $ft->$net }}" target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($net) }}">{{ $lbl }}</a>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="menu-footer-col">
                <h3>Belanja</h3>
                <a href="/produk">Semua roti</a>
                <a href="/produk?kategori=donat">Donat</a>
                <a href="/peringkat">Roti populer</a>
            </div>
            <div class="menu-footer-col">
                <h3>Bantuan</h3>
                <a href="/kontak">Cara pesan</a>
                <a href="/kontak">Pengiriman</a>
                <a href="/kontak">FAQ</a>
            </div>
            <div class="menu-footer-col">
                <h3>Hubungi Kami</h3>
                <p>{{ $ft->alamat ?? 'Jl. Abdul Hadi no 13 Kota Malang' }}</p>
                <p>{{ $ft->email ?? 'halo@gmail.com' }}</p>
                <p>Jam operasional 08:00 – 22:00</p>
            </div>
        </div>
    </footer>

</div>
@endsection
