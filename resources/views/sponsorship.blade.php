@extends('layout')
@section('c')
<style>
/* ── Hide layout defaults ── */
body:has(.sp-page) > nav,
body:has(.sp-page) > .adm,
body:has(.sp-page) > footer { display: none }
body:has(.sp-page) > .w    { width: 100% !important; max-width: none !important; margin: 0 !important; padding: 0 !important }

/* ── Page Shell ── */
.sp-page {
    --sp-bg: #F7E7C9;
    --sp-brown-dark: #381F0E;
    --sp-brown: #542C10;
    --sp-brown-light: #745842;
    --sp-gold: #F4A821;
    --sp-orange: #FD9A02;
    --sp-card-bg: #FFFDF9;
    --sp-card-border: #EEDFCB;
    --sp-form-bg: #F8EDE1;
    --sp-footer-bg: #3B1E0A;

    background: var(--sp-bg);
    color: var(--sp-brown-dark);
    font-family: 'Poppins', system-ui, -apple-system, sans-serif;
    min-height: 100vh;
    display: flex;
    flex-direction: column;
}
.sp-page * { box-sizing: border-box }
.sp-container { width: min(1180px, calc(100% - 48px)); margin: 0 auto }

/* ── Navbar ── */
.sp-header {
    height: 86px;
    display: flex;
    align-items: center;
    gap: 32px;
}
.sp-brand {
    display: flex; align-items: center; gap: 12px;
    margin-right: auto;
    text-decoration: none;
    color: var(--sp-brown-dark) !important;
    font-size: 21px; font-weight: 800;
    letter-spacing: .02em; white-space: nowrap;
}
.sp-brand-mark {
    width: 46px; height: 46px;
    border-radius: 50%; overflow: hidden;
    background: var(--sp-gold);
    border: 2px solid var(--sp-brown);
    box-shadow: inset 0 0 0 3px #fff3d4;
    display: grid; place-items: center;
    flex-shrink: 0;
}
.sp-brand-mark img { width: 100%; height: 100%; object-fit: cover }
.sp-nav {
    display: flex; align-items: center;
    gap: clamp(16px, 2.5vw, 36px);
}
.sp-nav a {
    text-decoration: none;
    text-transform: uppercase;
    color: var(--sp-brown-dark);
    font-size: clamp(12px, 1.15vw, 15px);
    font-weight: 600; white-space: nowrap;
    transition: color .15s ease;
}
.sp-nav a:hover,
.sp-nav a.active {
    color: var(--sp-orange);
    border-bottom: 2px solid var(--sp-orange);
    padding-bottom: 2px;
}
.sp-account {
    width: 38px; height: 38px;
    border-radius: 50%; background: #EDE5DA;
    display: grid; place-items: center;
    text-decoration: none;
    color: var(--sp-brown-dark) !important;
    transition: all .2s;
}
.sp-account:hover { background: var(--sp-gold); color: #fff !important; }

/* ── Hero Section ── */
.sp-hero-section {
    padding: 30px 0 60px;
}
.sp-hero-grid {
    display: grid;
    grid-template-columns: 1.15fr 1fr;
    gap: 48px;
    align-items: center;
}

.sp-hero-title {
    font-size: clamp(34px, 4.2vw, 54px);
    font-weight: 700;
    line-height: 1.18;
    color: #4A2E16;
    margin: 0 0 20px;
    letter-spacing: -.01em;
}
.sp-hero-title span {
    font-weight: 900;
    color: var(--sp-brown-dark);
    display: block;
}
.sp-hero-desc {
    font-size: clamp(15px, 1.25vw, 17px);
    line-height: 1.65;
    color: #63452B;
    margin: 0 0 32px;
    max-width: 540px;
}
.sp-hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: var(--sp-brown);
    color: #fff !important;
    padding: 14px 30px;
    border-radius: 99px;
    font-weight: 700;
    font-size: 15px;
    text-decoration: none;
    box-shadow: 0 8px 20px rgba(84, 44, 16, 0.25);
    transition: all .2s ease;
}
.sp-hero-btn:hover {
    background: #3E1F09;
    transform: translateY(-2px);
    box-shadow: 0 12px 24px rgba(84, 44, 16, 0.35);
}
.sp-hero-media {
    position: relative;
    border-radius: 24px;
    overflow: hidden;
    box-shadow: 0 16px 40px rgba(74, 46, 22, 0.15);
    aspect-ratio: 16/11;
    background: #EEDCC7;
}
.sp-hero-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* ── Section Header Sparkles ── */
.sp-sparkle-title {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 16px;
    margin-bottom: 10px;
    text-align: center;
}
.sp-sparkle-title h2 {
    font-size: clamp(26px, 3.2vw, 36px);
    font-weight: 800;
    color: var(--sp-brown-dark);
    margin: 0;
}
.sp-sparkle {
    color: var(--sp-gold);
    font-size: 26px;
    display: inline-flex;
    align-items: center;
}
.sp-section-sub {
    text-align: center;
    font-size: 15px;
    color: var(--sp-brown-light);
    margin: 0 0 36px;
}

/* ── Section: Bentuk Kolaborasi ── */
.sp-collab-types {
    padding: 50px 0 80px;
}
.sp-types-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 28px;
}
.sp-type-card {
    background: var(--sp-card-bg);
    border: 1.5px solid var(--sp-card-border);
    border-radius: 22px;
    padding: 38px 28px 34px;
    text-align: center;
    transition: all .25s ease;
    box-shadow: 0 4px 18px rgba(163, 82, 15, 0.04);
    display: flex;
    flex-direction: column;
    align-items: center;
}
.sp-type-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 16px 36px rgba(163, 82, 15, 0.12);
    border-color: var(--sp-gold);
}
.sp-type-icon-box {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background: #FDF3E5;
    border: 1.5px solid #F5E3CE;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 38px;
    margin-bottom: 22px;
    box-shadow: 0 6px 14px rgba(244, 168, 33, 0.15);
}
.sp-type-title {
    font-size: 20px;
    font-weight: 800;
    color: var(--sp-brown-dark);
    margin: 0 0 12px;
}
.sp-type-desc {
    font-size: 14.5px;
    line-height: 1.6;
    color: var(--sp-brown-light);
    margin: 0;
}

/* ── Section: Menjadi Mitra (Form Card) ── */
.sp-form-section {
    padding: 20px 0 80px;
}
.sp-form-card {
    background: var(--sp-form-bg);
    border: 1.5px solid #EADBCC;
    border-radius: 28px;
    padding: 44px 48px;
    display: grid;
    grid-template-columns: 340px 1fr;
    gap: 48px;
    align-items: center;
    box-shadow: 0 12px 34px rgba(84, 44, 16, 0.08);
}
.sp-form-visual {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}
.sp-form-img-box {
    width: 100%;
    max-width: 290px;
    aspect-ratio: 1/1;
    border-radius: 20px;
    overflow: hidden;
    background: #FFEAD4;
    border: 2px solid #EEDFCB;
    box-shadow: 0 10px 24px rgba(84, 44, 16, 0.1);
    display: flex;
    align-items: center;
    justify-content: center;
}
.sp-form-img-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.sp-form-visual-title {
    font-size: 32px;
    font-weight: 800;
    color: var(--sp-brown-dark);
    margin: 22px 0 8px;
}
.sp-form-visual-sub {
    font-size: 14.5px;
    color: var(--sp-brown-light);
    line-height: 1.55;
    margin: 0;
}

/* ── Form Inputs ── */
.sp-inputs-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    margin-bottom: 16px;
}
.sp-form-group {
    display: flex;
    flex-direction: column;
    margin-bottom: 16px;
}
.sp-label {
    font-size: 13.5px;
    font-weight: 700;
    color: var(--sp-brown-dark);
    margin-bottom: 6px;
}
.sp-label span { color: #DC2626 }
.sp-input,
.sp-select,
.sp-textarea {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid #D8C3AE;
    border-radius: 12px;
    font: inherit;
    font-size: 14.5px;
    background: #fff;
    color: var(--sp-brown-dark);
    outline: none;
    transition: all .2s;
}
.sp-input:focus,
.sp-select:focus,
.sp-textarea:focus {
    border-color: var(--sp-brown);
    box-shadow: 0 0 0 3px rgba(84, 44, 16, 0.12);
}
.sp-submit-btn {
    width: 100%;
    padding: 15px 24px;
    background: var(--sp-brown);
    color: #fff;
    border: none;
    border-radius: 99px;
    font: inherit;
    font-size: 16px;
    font-weight: 700;
    cursor: pointer;
    box-shadow: 0 8px 20px rgba(84, 44, 16, 0.22);
    transition: all .2s;
    margin-top: 6px;
}
.sp-submit-btn:hover {
    background: #3E1F09;
    transform: translateY(-2px);
    box-shadow: 0 12px 24px rgba(84, 44, 16, 0.32);
}

/* ── Section: Cerita Kolaborasi (Testimonials) ── */
.sp-testimonials-section {
    padding: 30px 0 90px;
}
.sp-stories-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
}
.sp-story-card {
    background: var(--sp-card-bg);
    border: 1.5px solid var(--sp-card-border);
    border-radius: 22px;
    padding: 28px 24px;
    box-shadow: 0 4px 18px rgba(163, 82, 15, 0.04);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: transform .2s ease, box-shadow .2s ease;
}
.sp-story-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 14px 30px rgba(163, 82, 15, 0.1);
    border-color: var(--sp-gold);
}
.sp-story-logo {
    height: 40px;
    display: flex;
    align-items: center;
    margin-bottom: 18px;
}
.sp-story-logo img {
    max-height: 100%;
    max-width: 140px;
    object-fit: contain;
}
.sp-brand-grab {
    color: #00B14F;
    font-size: 22px;
    font-weight: 800;
    letter-spacing: -.02em;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.sp-brand-go {
    color: #EE2737;
    font-size: 22px;
    font-weight: 800;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.sp-brand-sos {
    color: #00A3E0;
    font-size: 15px;
    font-weight: 800;
    line-height: 1.2;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}
.sp-story-quote {
    font-size: 14.5px;
    line-height: 1.65;
    color: #4A2F1B;
    margin: 0 0 24px;
    flex: 1;
}
.sp-story-author {
    display: flex;
    align-items: center;
    gap: 14px;
    padding-top: 16px;
    border-top: 1px solid #F0E2D2;
}
.sp-story-avatar {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    background: #EAD8C5;
    overflow: hidden;
    flex-shrink: 0;
    display: grid;
    place-items: center;
    font-size: 20px;
    border: 2px solid var(--sp-gold);
}
.sp-story-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.sp-story-name {
    font-size: 14.5px;
    font-weight: 700;
    color: var(--sp-brown-dark);
    margin: 0 0 2px;
}
.sp-story-role {
    font-size: 12px;
    color: var(--sp-brown-light);
    margin: 0;
    line-height: 1.35;
}

/* ── Mitra Database Showcase ── */
.sp-db-mitra {
    margin-top: 50px;
    padding: 30px;
    background: #FFF9F0;
    border: 1.5px dashed #E2D2BE;
    border-radius: 20px;
    text-align: center;
}
.sp-db-mitra h3 {
    font-size: 18px;
    font-weight: 700;
    color: var(--sp-brown);
    margin-bottom: 20px;
}
.sp-db-logos-row {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    justify-content: center;
    align-items: center;
}
.sp-db-logo-item {
    background: #fff;
    border: 1px solid #EAD8C5;
    border-radius: 12px;
    padding: 10px 18px;
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    color: var(--sp-brown);
    font-size: 13.5px;
    font-weight: 600;
    transition: all .2s;
}
.sp-db-logo-item:hover {
    border-color: var(--sp-gold);
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(163, 82, 15, 0.1);
}
.sp-db-logo-item img {
    height: 32px;
    width: auto;
    object-fit: contain;
}

/* ── Footer ── */
.sp-footer {
    width: 100%;
    background: var(--sp-footer-bg);
    color: #FAF2E8;
    padding: 54px 0 24px;
    margin-top: auto;
}
.sp-footer-top {
    display: grid;
    grid-template-columns: 1.4fr 1.1fr 0.8fr 1fr;
    gap: 40px;
    padding-bottom: 40px;
    border-bottom: 1px solid rgba(255, 255, 255, 0.12);
}
.sp-footer-brand {
    display: flex;
    align-items: center;
    gap: 12px;
    text-decoration: none;
    color: #fff !important;
    font-size: 22px;
    font-weight: 800;
    margin-bottom: 12px;
}
.sp-footer-brand-mark {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    overflow: hidden;
    background: var(--sp-gold);
    border: 2px solid #fff;
}
.sp-footer-brand-mark img { width: 100%; height: 100%; object-fit: cover }
.sp-footer-tagline {
    font-size: 14.5px;
    color: #D6BFAC;
    font-style: italic;
    line-height: 1.6;
    margin: 0;
}
.sp-footer-col h4 {
    font-size: 15px;
    font-weight: 700;
    color: #FFF;
    margin: 0 0 16px;
    letter-spacing: .02em;
}
.sp-footer-contact-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    font-size: 13.5px;
    color: #E2CFBE;
}
.sp-footer-contact-item {
    display: flex;
    align-items: flex-start;
    gap: 10px;
    line-height: 1.5;
}
.sp-footer-socials {
    display: flex;
    gap: 12px;
}
.sp-footer-soc-btn {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.18);
    color: #fff;
    display: grid;
    place-items: center;
    text-decoration: none;
    font-size: 17px;
    transition: all .2s;
}
.sp-footer-soc-btn:hover {
    background: var(--sp-gold);
    color: var(--sp-brown-dark);
    transform: translateY(-2px);
}
.sp-footer-links {
    display: flex;
    flex-direction: column;
    gap: 10px;
    font-size: 13.5px;
}
.sp-footer-links a {
    color: #E2CFBE;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: color .15s;
}
.sp-footer-links a:hover {
    color: var(--sp-gold);
}
.sp-footer-bottom {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    padding-top: 24px;
    font-size: 12.5px;
    color: #B59E8C;
}
.sp-footer-bottom a {
    color: #B59E8C;
    text-decoration: none;
    margin-left: 14px;
}
.sp-footer-bottom a:hover {
    color: #fff;
    text-decoration: underline;
}

/* ── Responsive ── */
@media (max-width: 980px) {
    .sp-hero-grid { grid-template-columns: 1fr; gap: 32px }
    .sp-form-card { grid-template-columns: 1fr; gap: 32px; padding: 32px 24px }
    .sp-types-grid { grid-template-columns: 1fr; gap: 20px }
    .sp-stories-grid { grid-template-columns: 1fr; gap: 20px }
    .sp-footer-top { grid-template-columns: 1fr 1fr; gap: 30px }
}
@media (max-width: 600px) {
    .sp-inputs-grid { grid-template-columns: 1fr }
    .sp-footer-top { grid-template-columns: 1fr; gap: 28px }
    .sp-nav { order: 3; width: 100%; justify-content: space-between; gap: 10px }
    .sp-header { flex-wrap: wrap; height: auto; min-height: 76px; padding: 12px 0 }
    .sp-hero-title { font-size: 32px }
}
</style>

<div class="sp-page">

    {{-- ── Header Navbar ── --}}
    <div class="sp-container">
        <header class="sp-header">
            <a class="sp-brand" href="/" aria-label="Raja Bakery – Beranda">
                <span class="sp-brand-mark">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo Raja Bakery">
                </span>
                <span>RAJA BAKERY</span>
            </a>
            <nav class="sp-nav" aria-label="Navigasi utama">
                <a href="/">BERANDA</a>
                <a href="/produk">MENU</a>
                <a href="/peringkat">ROTI TERPOPULER</a>
                <a href="/sponsorship" class="active">SPONSORSHIP</a>
                <a href="/kontak">KONTAK</a>
            </nav>
            <a class="sp-account" href="/login" aria-label="Masuk admin">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                    <circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.8"/>
                    <path d="M5.5 20c.4-3.5 2.7-5.3 6.5-5.3s6.1 1.8 6.5 5.3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </a>
        </header>
    </div>

    {{-- ── Flash Alert ── --}}
    @if(session('ok'))
        <div class="sp-container" style="margin-top:16px">
            <div style="background:#E2F5EA; color:#14532D; border:1px solid #BBF7D0; padding:14px 20px; border-radius:14px; font-weight:600; display:flex; align-items:center; gap:10px">
                <span style="font-size:20px">✓</span>
                <span>{{ session('ok') }}</span>
            </div>
        </div>
    @endif

    {{-- ── Hero Section: Kolaborasi bersama Raja Bakery ── --}}
    <section class="sp-hero-section">
        <div class="sp-container sp-hero-grid">
            <div>
                <h1 class="sp-hero-title">
                    Kolaborasi bersama
                    <span>Raja Bakery</span>
                </h1>
                <p class="sp-hero-desc">
                    Bersama brands, kampus, penyelenggara acara, komunitas, dan bisnis, mari wujudkan kolaborasi melalui produk bakery, catering, sponsorship acara, dan kampanye kreatif lainnya.
                </p>
                <a href="#form-kolaborasi" class="sp-hero-btn">
                    <span>Ajukan Kolaborasi</span>
                    <span>&rarr;</span>
                </a>
            </div>

            <div class="sp-hero-media">
                <img src="{{ asset('images/menu/roti.jpg') }}" alt="Aneka roti dan sajian Raja Bakery">
            </div>
        </div>
    </section>

    {{-- ── Section: Bentuk Kolaborasi ── --}}
    <section class="sp-collab-types">
        <div class="sp-container">
            <div class="sp-sparkle-title">
                <span class="sp-sparkle">✦</span>
                <h2>Bentuk Kolaborasi</h2>
                <span class="sp-sparkle">✦</span>
            </div>

            <div class="sp-types-grid" style="margin-top:36px">
                {{-- Card 1: Event & Kampus --}}
                <div class="sp-type-card">
                    <div class="sp-type-icon-box">
                        <span>🎓</span>
                    </div>
                    <h3 class="sp-type-title">Event & Kampus</h3>
                    <p class="sp-type-desc">
                        Kolaborasi untuk acara kampus, event komunitas, dan kegiatan edukatif lainnya.
                    </p>
                </div>

                {{-- Card 2: Brand & Bisnis --}}
                <div class="sp-type-card">
                    <div class="sp-type-icon-box">
                        <span>🤝</span>
                    </div>
                    <h3 class="sp-type-title">Brand & Bisnis</h3>
                    <p class="sp-type-desc">
                        Kerja sama dengan brand atau bisnis untuk berbagai program menarik bersama.
                    </p>
                </div>

                {{-- Card 3: Komunitas & Sosial --}}
                <div class="sp-type-card">
                    <div class="sp-type-icon-box">
                        <span>🤲</span>
                    </div>
                    <h3 class="sp-type-title">Komunitas & Sosial</h3>
                    <p class="sp-type-desc">
                        Bersama dalam kegiatan sosial untuk memberikan dampak positif bagi masyarakat.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Section: Menjadi Mitra! (Formulir) ── --}}
    <section class="sp-form-section" id="form-kolaborasi">
        <div class="sp-container">
            <div class="sp-form-card">
                <div class="sp-form-visual">
                    <div class="sp-form-img-box">
                        <img src="{{ asset('images/lobby.png') }}" alt="Suasana Raja Bakery">
                    </div>
                    <h2 class="sp-form-visual-title">Menjadi Mitra!</h2>
                    <p class="sp-form-visual-sub">
                        Tim kami yang ramah akan senang mendengar kabar dari Anda.
                    </p>
                </div>

                <div>
                    <form method="post" action="/sponsorship">
                        @csrf
                        <div class="sp-inputs-grid">
                            <div>
                                <label class="sp-label" for="nama">Nama <span>*</span></label>
                                <input class="sp-input" type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
                            </div>
                            <div>
                                <label class="sp-label" for="email">Email <span>*</span></label>
                                <input class="sp-input" type="email" id="email" name="email" placeholder="contoh@email.com" required>
                            </div>
                        </div>

                        <div class="sp-inputs-grid">
                            <div>
                                <label class="sp-label" for="telepon">Nomor Telepon <span>*</span></label>
                                <input class="sp-input" type="tel" id="telepon" name="telepon" placeholder="08xxxxxxxxx" required>
                            </div>
                            <div>
                                <label class="sp-label" for="organisasi">Nama Organisasi/Perusahaan</label>
                                <input class="sp-input" type="text" id="organisasi" name="organisasi" placeholder="Nama organisasi Anda">
                            </div>
                        </div>

                        <div class="sp-form-group">
                            <label class="sp-label" for="jenis">Jenis Kolaborasi <span>*</span></label>
                            <select class="sp-select" id="jenis" name="jenis" required>
                                <option value="" disabled selected>Pilih jenis kolaborasi</option>
                                <option value="Event & Kampus">Event & Kampus</option>
                                <option value="Brand & Bisnis">Brand & Bisnis</option>
                                <option value="Komunitas & Sosial">Komunitas & Sosial</option>
                                <option value="Sponsorship Acara">Sponsorship Acara</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <div class="sp-form-group">
                            <label class="sp-label" for="pesan">Pesan <span>*</span></label>
                            <textarea class="sp-textarea" id="pesan" name="pesan" rows="3" placeholder="Tuliskan pesan atau proposal Anda..." required></textarea>
                        </div>

                        <button type="submit" class="sp-submit-btn">
                            Kirim Pengajuan &rarr;
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- ── Section: Cerita Kolaborasi (Testimonials) ── --}}
    <section class="sp-testimonials-section">
        <div class="sp-container">
            <div class="sp-sparkle-title">
                <span class="sp-sparkle">✦</span>
                <h2>Cerita Kolaborasi</h2>
                <span class="sp-sparkle">✦</span>
            </div>
            <p class="sp-section-sub">Apa kata mereka tentang kolaborasi sukses kami?</p>

            <div class="sp-stories-grid">
                {{-- Story 1: GrabFood --}}
                <div class="sp-story-card">
                    <div>
                        <div class="sp-story-logo">
                            <div class="sp-brand-grab">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="#00B14F"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-1 14.5v-9l6 4.5-6 4.5z"/></svg>
                                <span>GrabFood</span>
                            </div>
                        </div>
                        <p class="sp-story-quote">
                            &ldquo;Fore Bakery adalah salah satu partner terbaik yang pernah kami ajak berkolaborasi. Timnya sangat responsif dan profesional.&rdquo;
                        </p>
                    </div>
                    <div class="sp-story-author">
                        <div class="sp-story-avatar">
                            <span>👩</span>
                        </div>
                        <div>
                            <div class="sp-story-name">Devi Alfilovita</div>
                            <div class="sp-story-role">Manajer Akun Utama di GrabFood</div>
                        </div>
                    </div>
                </div>

                {{-- Story 2: GoFood --}}
                <div class="sp-story-card">
                    <div>
                        <div class="sp-story-logo">
                            <div class="sp-brand-go">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="#EE2737"><circle cx="12" cy="12" r="10"/><path d="M9 8v8l7-4-7-4z" fill="#fff"/></svg>
                                <span>gofood</span>
                            </div>
                        </div>
                        <p class="sp-story-quote">
                            &ldquo;Kolaborasi dengan Raja Bakery selalu berjalan lancar. Produk dan pelayanannya <strong>sangat berkualitas!</strong>&rdquo;
                        </p>
                    </div>
                    <div class="sp-story-author">
                        <div class="sp-story-avatar">
                            <span>👩‍💼</span>
                        </div>
                        <div>
                            <div class="sp-story-name">Nina Sudianto</div>
                            <div class="sp-story-role">Kemitraan Pedagang Perusahaan di GoFood</div>
                        </div>
                    </div>
                </div>

                {{-- Story 3: SOS Children's Villages --}}
                <div class="sp-story-card">
                    <div>
                        <div class="sp-story-logo">
                            <div class="sp-brand-sos">
                                <span style="font-size:22px">👨‍👩‍👧‍👦</span>
                                <span>SOS CHILDREN'S<br>VILLAGES</span>
                            </div>
                        </div>
                        <p class="sp-story-quote">
                            &ldquo;Terima kasih atas inisiatif baiknya untuk berkolaborasi dalam kampanye sosial ini.&rdquo;
                        </p>
                    </div>
                    <div class="sp-story-author">
                        <div class="sp-story-avatar">
                            <span>👨‍💼</span>
                        </div>
                        <div>
                            <div class="sp-story-name">Sumanda Tondang</div>
                            <div class="sp-story-role">Direktur Pengembangan Dana & Komunikasi di SOS Children's Villages</div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ── Mitra Terdaftar dari Admin Panel ── --}}
            @if(isset($sponsor) && $sponsor->count())
                <div class="sp-db-mitra">
                    <h3>🤝 Mitra yang Telah Bekerja Sama</h3>
                    <div class="sp-db-logos-row">
                        @foreach($sponsor as $s)
                            <a class="sp-db-logo-item" href="{{ $s->link ?: '#' }}" @if($s->link) target="_blank" rel="noopener noreferrer" @endif>
                                @if($s->logo)
                                    <img src="{{ asset('storage/'.$s->logo) }}" alt="{{ $s->nama }}">
                                @endif
                                <span>{{ $s->nama }}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    {{-- ── Footer ── --}}
    <footer class="sp-footer">
        <div class="sp-container">
            <div class="sp-footer-top">
                {{-- Col 1: Brand & Tagline --}}
                <div>
                    <a class="sp-footer-brand" href="/">
                        <span class="sp-footer-brand-mark">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo Raja Bakery">
                        </span>
                        <span>Raja Bakery</span>
                    </a>
                    <p class="sp-footer-tagline">
                        Roti, Kue, dan Camilan Terbaik untuk Kamu!
                    </p>
                </div>

                {{-- Col 2: Alamat & Kontak --}}
                <div>
                    <h4>Alamat</h4>
                    <div class="sp-footer-contact-list">
                        <div class="sp-footer-contact-item">
                            <span>📍</span>
                            <span>{{ $pf->alamat ?? 'Jl. Melati No. 12, Malang' }}</span>
                        </div>
                        <div class="sp-footer-contact-item">
                            <span>📞</span>
                            <span>{{ $pf->whatsapp ?? '0812 3456 7890' }}</span>
                        </div>
                        <div class="sp-footer-contact-item">
                            <span>✉️</span>
                            <span>{{ $pf->email ?? 'rajabakery@gmail.com' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Col 3: Ikuti Kami --}}
                <div>
                    <h4>Ikuti Kami</h4>
                    <div class="sp-footer-socials">
                        @if(!empty($pf->instagram))
                            <a class="sp-footer-soc-btn" href="{{ $pf->instagram }}" target="_blank" rel="noopener" aria-label="Instagram">📷</a>
                        @else
                            <a class="sp-footer-soc-btn" href="#" aria-label="Instagram">📷</a>
                        @endif

                        @if(!empty($pf->tiktok))
                            <a class="sp-footer-soc-btn" href="{{ $pf->tiktok }}" target="_blank" rel="noopener" aria-label="TikTok">🎵</a>
                        @else
                            <a class="sp-footer-soc-btn" href="#" aria-label="TikTok">🎵</a>
                        @endif

                        @if(!empty($pf->whatsapp))
                            <a class="sp-footer-soc-btn" href="https://wa.me/{{ preg_replace('/\D/','',$pf->whatsapp) }}" target="_blank" rel="noopener" aria-label="WhatsApp">💬</a>
                        @else
                            <a class="sp-footer-soc-btn" href="#" aria-label="WhatsApp">💬</a>
                        @endif
                    </div>
                </div>

                {{-- Col 4: Pusat Pelanggan --}}
                <div>
                    <h4>Pusat Pelanggan</h4>
                    <div class="sp-footer-links">
                        <a href="/kontak"><span>🎧</span> Informasi Kontak</a>
                        <a href="/kontak"><span>📋</span> Layanan Pengaduan</a>
                    </div>
                </div>
            </div>

            <div class="sp-footer-bottom">
                <div>
                    &copy; 2026 Raja Bakery. Semua hak dilindungi undang-undang.
                </div>
                <div>
                    <a href="#">Syarat dan Ketentuan</a>
                    <span>&bull;</span>
                    <a href="#">Kebijakan Privasi</a>
                </div>
            </div>
        </div>
    </footer>

</div>
@endsection
