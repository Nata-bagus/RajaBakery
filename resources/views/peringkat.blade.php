@extends('layout')
@section('c')
<style>
/* ── Hide layout defaults ── */
body:has(.rank-page) > nav,
body:has(.rank-page) > .adm,
body:has(.rank-page) > footer { display: none }
body:has(.rank-page) > .w    { width: 100% !important; max-width: none !important; margin: 0 !important; padding: 0 !important }

/* ── Page shell ── */
.rank-page {
    --rp-bg:     #F7E7C9;
    --rp-brown:  #a3520f;
    --rp-gold:   #f3a821;
    --rp-orange: #fd9a02;
    background: var(--rp-bg);
    color: #24190f;
    font-family: Poppins, system-ui, sans-serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
.rank-page * { box-sizing: border-box }
.rank-container { width: min(1156px, calc(100% - 48px)); margin: 0 auto }

/* ── Navbar ── */
.rank-header {
    height: 86px;
    display: flex;
    align-items: center;
    gap: 32px;
}
.rank-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-right: auto;
    text-decoration: none;
    color: var(--rp-brown) !important;
    font-size: 21px;
    font-weight: 800;
    letter-spacing: .02em;
    white-space: nowrap;
}
.rank-brand-mark {
    width: 48px; height: 48px;
    border-radius: 50%;
    overflow: hidden;
    background: var(--rp-gold);
    border: 2px solid var(--rp-brown);
    box-shadow: inset 0 0 0 3px #fff3d4;
    display: grid; place-items: center;
}
.rank-brand-mark img { width: 100%; height: 100%; object-fit: cover }
.rank-nav {
    display: flex;
    align-items: center;
    gap: clamp(18px, 3vw, 44px);
}
.rank-nav a {
    text-decoration: none;
    text-transform: uppercase;
    color: var(--rp-brown);
    font-size: clamp(12px, 1.25vw, 16px);
    font-weight: 500;
    white-space: nowrap;
}
.rank-nav a:hover,
.rank-nav a.active {
    color: var(--rp-orange);
    border-bottom: 2px solid var(--rp-orange);
    padding-bottom: 2px;
}
.rank-account {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: #ddd;
    display: grid; place-items: center;
    text-decoration: none;
    color: var(--rp-brown) !important;
    font-size: 17px;
}

/* ── Content ── */
.rank-content {
    flex: 1;
    padding: 36px 0 56px;
}
.rank-title {
    font-size: 26px;
    font-weight: 800;
    color: var(--rp-orange);
    margin: 0 0 6px;
}
.rank-subtitle {
    font-size: 14px;
    color: #68451f;
    margin: 0 0 32px;
}

/* ── Rank cards ── */
.rank-list { display: flex; flex-direction: column; gap: 14px }
.rank-card {
    background: #fff;
    border: 1px solid #e0d4c3;
    border-radius: 14px;
    padding: 16px 20px;
    display: flex;
    align-items: center;
    gap: 16px;
}
.rank-no {
    font-size: 22px;
    font-weight: 800;
    color: var(--rp-brown);
    min-width: 40px;
    text-align: center;
}
.rank-no.top1 { color: #c8880a; font-size: 26px }
.rank-no.top2 { color: #8c8c8c }
.rank-no.top3 { color: #a06030 }
.rank-info { flex: 1 }
.rank-info b { display: block; font-size: 16px; color: #24190f; margin-bottom: 6px }
.rank-bar {
    height: 10px;
    background: #e8ddd0;
    border-radius: 5px;
    overflow: hidden;
}
.rank-bar-fill {
    height: 100%;
    background: var(--rp-gold);
    border-radius: 5px;
    transition: width .4s ease;
}
.rank-votes {
    font-size: 15px;
    font-weight: 700;
    color: var(--rp-brown);
    white-space: nowrap;
}

.rank-empty {
    text-align: center;
    padding: 60px 20px;
    color: #68451f;
    font-size: 16px;
}

/* ── Footer ── */
.rank-footer {
    width: 100%;
    background: var(--rp-brown);
    color: #edf6ff;
    padding: 28px 0;
}
.rank-footer-grid {
    display: grid;
    grid-template-columns: 1.35fr .8fr .9fr 1.2fr;
    gap: 28px;
    align-items: start;
}
.rank-footer-brand {
    display: flex; align-items: center; gap: 12px;
    color: var(--rp-gold) !important;
    font-size: 20px; font-weight: 800;
    text-decoration: none; margin-bottom: 10px;
}
.rank-footer-brand-mark {
    width: 48px; height: 48px; border-radius: 50%;
    overflow: hidden; background: var(--rp-gold);
    border: 2px solid #fff3d4;
}
.rank-footer-brand-mark img { width: 100%; height: 100%; object-fit: cover }
.rank-social { display: flex; gap: 18px; margin-top: 8px }
.rank-social a { color: #fff; text-decoration: none; font-size: 15px; font-weight: 700 }
.rank-footer-col h3 {
    font-size: 13px; margin: 5px 0 14px; font-weight: 600; color: #edf6ff;
}
.rank-footer-col h3::after {
    content: ''; display: block; width: 35px; height: 1px;
    background: #edf6ff; margin-top: 8px;
}
.rank-footer-col a,
.rank-footer-col p {
    display: block; color: #edf6ff; text-decoration: none;
    font-size: 11px; line-height: 1.7; margin: 0;
}
.rank-footer-col a:hover { text-decoration: underline }

/* ── Responsive ── */
@media (max-width: 720px) {
    .rank-header { gap: 16px }
    .rank-nav { gap: 14px }
    .rank-nav a { font-size: 12px }
    .rank-footer-grid { grid-template-columns: 1fr 1fr; gap: 20px 14px }
    .rank-footer-brand { grid-column: 1 / -1 }
}
@media (max-width: 480px) {
    .rank-container { width: calc(100% - 32px) }
    .rank-header { flex-wrap: wrap; height: auto; min-height: 76px; padding: 12px 0 }
    .rank-nav { order: 3; width: 100%; justify-content: space-between }
    .rank-nav a { font-size: 10px }
}
</style>

<div class="rank-page">

    {{-- ── Navbar ── --}}
    <div class="rank-container">
        <header class="rank-header">
            <a class="rank-brand" href="/" aria-label="Raja Bakery – Beranda">
                <span class="rank-brand-mark">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Raja Bakery">
                </span>
                <span>RAJA BAKERY</span>
            </a>
            <nav class="rank-nav" aria-label="Navigasi utama">
                <a href="/">BERANDA</a>
                <a href="/produk">MENU</a>
                <a href="/peringkat" class="active">ROTI TERPOPULER</a>
                <a href="/sponsorship">SPONSORSHIP</a>
            </nav>
            <a class="rank-account" href="/login" aria-label="Masuk admin">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.7"/>
                    <path d="M5.5 20c.4-3.5 2.7-5.3 6.5-5.3s6.1 1.8 6.5 5.3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
                </svg>
            </a>
        </header>
    </div>

    {{-- ── Content ── --}}
    <div class="rank-container rank-content">
        <h1 class="rank-title">ROTI TERPOPULER</h1>

        @if(!$periode)
            <div class="rank-empty">Belum ada periode voting aktif.</div>
        @elseif($top->sum('votes_count') == 0)
            <p class="rank-subtitle">{{ $periode->nama }}: belum ada suara pada periode ini.</p>
            <div class="rank-empty">Belum ada suara. Yuk vote roti favoritmu!</div>
        @else
            <p class="rank-subtitle">
                {{ $periode->nama }}
                ({{ $periode->tanggal_mulai }} s.d. {{ $periode->tanggal_selesai }})
            </p>
            @php($max = max(1, $top->max('votes_count')))
            <div class="rank-list">
                @foreach($top as $i => $p)
                    <div class="rank-card">
                        <div class="rank-no {{ $i === 0 ? 'top1' : ($i === 1 ? 'top2' : ($i === 2 ? 'top3' : '')) }}">#{{ $i + 1 }}</div>
                        <div class="rank-info">
                            <b>{{ $p->nama }}</b>
                            <div class="rank-bar">
                                <div class="rank-bar-fill" style="width:{{ round($p->votes_count / $max * 100) }}%"></div>
                            </div>
                        </div>
                        <div class="rank-votes">{{ $p->votes_count }} vote</div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    {{-- ── Footer ── --}}
    @php($ft = \Illuminate\Support\Facades\DB::table('profil_toko')->first())
    <footer class="rank-footer">
        <div class="rank-container rank-footer-grid">
            <div>
                <a class="rank-footer-brand" href="/">
                    <span class="rank-footer-brand-mark">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo Raja Bakery">
                    </span>
                    <span>RAJA BAKERY</span>
                </a>
                <div class="rank-social">
                    @foreach(['instagram' => 'IG', 'facebook' => 'f', 'tiktok' => '♪'] as $net => $lbl)
                        @if(!empty($ft->$net))
                            <a href="{{ $ft->$net }}" target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($net) }}">{{ $lbl }}</a>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="rank-footer-col">
                <h3>Belanja</h3>
                <a href="/produk">Semua roti</a>
                <a href="/produk?kategori=donat">Donat</a>
                <a href="/peringkat">Roti populer</a>
            </div>
            <div class="rank-footer-col">
                <h3>Bantuan</h3>
                <a href="/kontak">Cara pesan</a>
                <a href="/kontak">Pengiriman</a>
                <a href="/kontak">FAQ</a>
            </div>
            <div class="rank-footer-col">
                <h3>Hubungi Kami</h3>
                <p>{{ $ft->alamat ?? 'Jl. Abdul Hadi no 13 Kota Malang' }}</p>
                <p>{{ $ft->email ?? 'halo@gmail.com' }}</p>
                <p>Jam operasional 08:00 – 22:00</p>
            </div>
        </div>
    </footer>

</div>
@endsection
