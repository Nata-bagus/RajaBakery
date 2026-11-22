@extends('layout')
@section('c')
<style>
body:has(.home-page)>nav,body:has(.home-page)>footer,body:has(.home-page)>.adm{display:none}
body:has(.home-page)>.w{width:100%!important;max-width:none!important;margin:0!important;padding:0!important}
.home-page{--home-bg:#F7E7C9;--home-brown:#a3520f;--home-gold:#f3a821;--home-accent:#fd9a02;background:var(--home-bg);color:#24190f;font-family:Poppins,system-ui,sans-serif;overflow:hidden;width:100%;margin:0 auto}
.home-page *{box-sizing:border-box}
.home-page a{color:inherit}
.home-container{width:min(1156px,calc(100% - 48px));margin:0 auto}
.home-header{height:86px;display:flex;align-items:center;gap:32px}
.home-brand{display:flex;align-items:center;gap:12px;margin-right:auto;text-decoration:none;color:var(--home-brown)!important;font-size:21px;font-weight:800;letter-spacing:.02em;white-space:nowrap}
.brand-mark{width:48px;height:48px;border-radius:50%;display:grid;place-items:center;background:var(--home-gold);border:2px solid var(--home-brown);color:var(--home-brown);font-size:15px;font-weight:900;box-shadow:inset 0 0 0 3px #fff3d4}
.home-nav{display:flex;align-items:center;gap:clamp(18px,3vw,44px)}
.home-nav a{text-decoration:none;text-transform:uppercase;color:var(--home-brown);font-size:clamp(12px,1.25vw,16px);font-weight:500;white-space:nowrap;}
.home-nav a:hover,.home-nav a:focus-visible,.home-nav a.active{color:var(--home-accent);border-bottom:2px solid var(--home-accent);padding-bottom:2px}
.account-link{width:36px;height:36px;border-radius:50%;background:#ddd;display:grid;place-items:center;text-decoration:none;color:var(--home-brown)!important;font-size:17px}
.home-hero{min-height:550px;margin:45px auto 0;border-radius:20px;background:#FE9C05;padding:58px 58px 58px 42px;display:grid;grid-template-columns:1fr 349px;align-items:center;gap:48px;color:var(--home-gold)}
.hero-copy{max-width:570px}
.hero-copy h1{max-width:440px;font-size:clamp(44px,5vw,64px);line-height:1.24;letter-spacing:.005em;margin:0 0 10px;font-weight:800}
.hero-copy>p{font-size:21px;line-height:1.45;margin:0 0 25px;color:#ffd05c}
.vote-note{font-size:14px!important;margin:-7px 0 17px!important;color:#fff4d7!important}
.hero-actions{display:flex;flex-wrap:wrap;gap:12px}
.home-button{display:inline-flex;align-items:center;justify-content:center;min-height:44px;padding:10px 20px;border-radius:7px;background:var(--home-gold);color:var(--home-brown)!important;text-decoration:none;font-weight:700}
.home-button.secondary{border:1px solid #f3a821;background:transparent;color:#fff!important}
.hero-art{width:100%;height:434px;border-radius:20px;overflow:hidden;background:#e8a43a;box-shadow:0 12px 30px #4c240d55}
.hero-art svg,.shop-art svg,
.hero-art img,.shop-art img{display:block;width:100%;height:100%;object-fit:cover}
.about-section{margin-top:152px;display:grid;grid-template-columns:546fr 538fr;gap:44px;align-items:start}
.shop-art{width:100%;height:389px;overflow:hidden;border-radius:4px;background:#d9b786}
.about-copy h2{color:var(--home-accent);font-size:24px;line-height:1.3;margin:0 0 24px;font-weight:800}
.about-copy p{font-size:18px;line-height:1.55;margin:0 0 20px;color:#171717}
.about-copy p:last-child{margin-bottom:0}
.popular-section{margin-top:190px}
.section-heading{display:flex;align-items:end;justify-content:space-between;gap:16px;margin-bottom:50px}
.section-heading h2{font-size:30px;line-height:1.25;color:var(--home-accent);margin:0;font-weight:800}
.section-heading a{color:var(--home-brown);font-weight:700;text-decoration:none}
.product-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:clamp(24px,5.85vw,75px)}
.product-card{min-height:442px;padding:30px 24px 24px;background:var(--home-brown);border-radius:15px;color:#111;display:flex;flex-direction:column;text-decoration:none;transition:transform .2s ease,box-shadow .2s ease}
.product-card:hover,.product-card:focus-visible{transform:translateY(-4px);box-shadow:0 14px 28px #5c310f33}
.product-visual{position:relative;height:218px;padding:0;border-radius:5px;background:var(--home-gold);display:flex;align-items:center;justify-content:center;overflow:hidden}
.product-visual img{position:absolute;inset:0;width:100%;height:100%;padding:0;margin:0;object-fit:cover;display:block}
.donut{position:relative;width:116px;height:116px;border:20px solid #d62e67;border-radius:50%;background:#f4c27e;box-shadow:inset 0 0 0 5px #f7a94c,0 8px 13px #75341155;transform:rotate(-12deg)}
.donut:before{content:"";position:absolute;inset:-20px;border-radius:50%;background:repeating-conic-gradient(from 13deg,#ffdf71 0 4deg,transparent 4deg 28deg,#fff1ce 28deg 32deg,transparent 32deg 54deg);mask:radial-gradient(circle,transparent 0 44%,#000 46% 70%,transparent 72%)}
.donut:after{content:"";position:absolute;width:25px;height:25px;left:50%;top:50%;transform:translate(-50%,-50%);border-radius:50%;background:var(--home-gold);box-shadow:inset 0 3px 4px #a3520f55}
.product-card h3{font-size:25px;line-height:1.25;color:var(--home-gold);margin:14px 0 3px;font-weight:800}
.product-price{font-size:15px;color:#fff;margin:0}
.product-votes{font-size:13px;color:#ffe8b7;margin:8px 0 0}
.product-empty{grid-column:1/-1;border:1px dashed #c88d55;border-radius:12px;padding:34px;text-align:center;color:#68451f}
.supporting-section{margin-top:80px}
.supporting-section h2{font-size:24px;color:var(--home-accent);margin:0 0 20px}
.testimonial-grid,.sponsor-grid{display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:16px}
.testimonial-card,.sponsor-card{border:1px solid #ead9bc;border-radius:12px;background:#fff;padding:18px}
.testimonial-card p{margin:0 0 12px}
.sponsor-card{text-align:center}
.sponsor-card img{max-width:100%;max-height:90px;object-fit:contain}
.home-footer{margin-top:277px;min-height:148px;background:var(--home-brown);color:#edf6ff;padding:22px 0}
.footer-grid{display:grid;grid-template-columns:1.35fr .8fr .9fr 1.2fr;gap:28px;align-items:start}
.footer-brand .home-brand{color:var(--home-gold)!important;font-size:20px;margin:0 0 10px}
.footer-brand .brand-mark{width:48px;height:48px}
.social-links{display:flex;gap:18px;margin-left:62px}
.social-links a{color:#fff;text-decoration:none;font-size:15px;font-weight:700}
.footer-column h3{font-size:13px;margin:5px 0 14px;font-weight:600}
.footer-column h3:after{content:"";display:block;width:35px;height:1px;background:#edf6ff;margin-top:8px}
.footer-column a,.footer-column p{display:block;color:#edf6ff;text-decoration:none;font-size:11px;line-height:1.7;margin:0}
.footer-column a:hover{text-decoration:underline}
.home-page :focus-visible{outline:3px solid #ed8500;outline-offset:3px}
@media(max-width:900px){
  .home-header{gap:16px}.home-nav{gap:16px}.home-nav a{font-size:12px}
  .home-hero{grid-template-columns:1fr 40%;gap:24px;padding:38px 30px;min-height:450px}
  .hero-art{height:350px}.about-section{grid-template-columns:1fr 1fr;gap:28px}
  .about-copy p{font-size:16px}.shop-art{height:auto;aspect-ratio:546/389}
  .product-grid{gap:20px}.product-card{padding:18px;min-height:390px}.product-visual{height:190px}
}
@media(max-width:640px){
  .home-container{width:min(100% - 32px,480px)}
  .home-header{height:auto;min-height:76px;flex-wrap:wrap;gap:12px;padding:12px 0}
  .home-brand{font-size:18px}.brand-mark{width:40px;height:40px}
  .home-nav{order:3;width:100%;justify-content:space-between;gap:8px;padding:4px 0 8px}
  .home-nav a{font-size:10px}
  .account-link{width:32px;height:32px}
  .home-hero{margin-top:16px;min-height:0;padding:28px 22px 24px;grid-template-columns:1fr;gap:24px}
  .hero-copy h1{font-size:clamp(40px,11vw,56px)}
  .hero-copy>p{font-size:17px}
  .hero-art{height:auto;aspect-ratio:349/300;max-height:340px}
  .about-section{margin-top:74px;grid-template-columns:1fr;gap:26px}
  .about-copy h2{font-size:21px;margin-bottom:12px}
  .about-copy p{font-size:15px}
  .popular-section{margin-top:86px}
  .section-heading{align-items:start;flex-direction:column;margin-bottom:24px}
  .section-heading h2{font-size:24px}
  .product-grid{grid-template-columns:1fr;gap:16px}
  .product-card{min-height:0;padding:18px}
  .product-visual{height:210px}
  .supporting-section{margin-top:52px}
  .home-footer{margin-top:80px;padding:28px 0}
  .footer-grid{grid-template-columns:1fr 1fr;gap:24px 16px}
  .footer-brand{grid-column:1/-1}
  .social-links{margin-left:52px}
}
@media(prefers-reduced-motion:reduce){.product-card{transition:none}}

/* Warna teks hero: cokelat senada logo */
.home-hero{color:#5A2B07}
.hero-copy>p{color:#6B3509}
.vote-note{color:#5A2B07!important}
.home-button{background:#5A2B07;color:#FFF3D4!important}
.home-button.secondary{background:transparent;border:2px solid #5A2B07;color:#5A2B07!important}
.home-button:hover,.home-button:focus-visible{background:#3F1E04;color:#FFF3D4!important}
.home-button.secondary:hover,.home-button.secondary:focus-visible{background:#5A2B07;color:#FFF3D4!important}
.home-hero :focus-visible{outline-color:#5A2B07}
</style>

<div class="home-page" id="home">
    <header class="home-container home-header">
        <a class="home-brand" href="#home" aria-label="Raja Bakery - Beranda">
            <img class="brand-mark" src="{{ asset('images/logo.png') }}" alt="Logo Raja Bakery">
            <span>RAJA BAKERY</span>
        </a>
        <nav class="home-nav" aria-label="Navigasi utama">
            <a href="#home" class="active">Beranda</a>
            <a href="/produk">Menu</a>
            <a href="/peringkat">Roti Terpopuler</a>
            <a href="/sponsorship">Sponsorship</a>
        </nav>
        <a class="account-link" href="/login" aria-label="Masuk admin">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                <circle cx="12" cy="8" r="3.5" stroke="currentColor" stroke-width="1.7"/>
                <path d="M5.5 20c.4-3.5 2.7-5.3 6.5-5.3s6.1 1.8 6.5 5.3" stroke="currentColor" stroke-width="1.7" stroke-linecap="round"/>
            </svg>
        </a>
    </header>

    <main>
        <section class="home-container home-hero" aria-labelledby="hero-title">
            <div class="hero-copy">
                <h1 id="hero-title">LEZAT DAN NAGIH</h1>
                <p>Temukan Roti Favoritmu di Raja Bakery</p>
                @if($periode)
                    <p class="vote-note">{{ $periode->nama }} dibuka sampai {{ $periode->tanggal_selesai }}</p>
                @endif
                <div class="hero-actions">
                    <a class="home-button" href="/produk">Jelajahi Menu</a>
                    @if($periode && $ada)
                        <a class="home-button secondary" href="/produk/{{ $top->first()->id_produk }}">Lihat roti favorit</a>
                    @endif
                </div>
            </div>
            <div class="hero-art">
                <img src="{{ asset('images/menu/roti.jpg') }}" alt="Aneka roti Raja Bakery">
            </div>
        </section>

        <section class="home-container about-section" aria-label="Tentang Raja Bakery">
            <div class="shop-art">
                <img src="{{ asset('images/lobby.png') }}" alt="Suasana toko roti Raja Bakery">
            </div>
            <div class="about-copy">
                <h2>VISI</h2>
                <p>Menjadi toko roti dan kue pilihan utama masyarakat Malang dengan menghadirkan produk berkualitas tinggi yang lezat, higienis, dan terjangkau bagi seluruh kalangan.</p>
                <h2>MISI</h2>
                <p>Menjaga Kualitas & Cita Rasa: Mengolah setiap produk roti dan kue menggunakan bahan baku pilihan dengan standar kebersihan yang terjaga untuk memenuhi ekspektasi rasa pelanggan (Enak di Mulut). Memberikan Harga yang Kompetitif: Menyajikan variasi produk bakery yang ramah di kantong mahasiswa maupun keluarga di kawasan Tlogomas, Joyogrand, dan sekitarnya (Pas di Hati).</p>
                @if($pf && $pf->sejarah)
                    <h2>SEJARAH</h2>
                    <p>{!! nl2br(e($pf->sejarah)) !!}</p>
                @endif
            </div>
        </section>

        <section class="home-container popular-section" id="popular" aria-labelledby="popular-title">
            <div class="section-heading">
                <h2 id="popular-title">TOP 3 ROTI POPULER</h2>
                <a href="/peringkat">Lihat peringkat lengkap &rarr;</a>
            </div>
            <div class="product-grid">
                @forelse($top as $product)
                    <a class="product-card" href="/produk/{{ $product->id_produk }}">
                        <div class="product-visual">
                            @if($product->foto)
                                <img src="{{ asset('storage/'.$product->foto) }}" alt="{{ $product->nama }}">
                            @else
                                <div class="menu-card-photo-placeholder">Foto roti</div>
                            @endif
                        </div>
                        <h3>{{ $product->nama }}</h3>
                        <p class="product-price">@if($product->harga)Rp{{ number_format($product->harga,0,',','.') }}@else Harga hubungi toko @endif</p>
                        <p class="product-votes">{{ $product->votes_count }} vote pada {{ $periode->nama ?? 'periode ini' }}</p>
                    </a>
                @empty
                    <p class="product-empty">Belum ada roti populer untuk ditampilkan. Lihat semua pilihan di <a href="/produk">menu Raja Bakery</a>.</p>
                @endforelse
            </div>
        </section>

        @if($testimoni->count())
            <section class="home-container supporting-section" aria-labelledby="testimonials-title">
                <h2 id="testimonials-title">Kata Pelanggan</h2>
                <div class="testimonial-grid">
                    @foreach($testimoni as $testimonial)
                        <article class="testimonial-card">
                            <p>&ldquo;{{ $testimonial->isi }}&rdquo;</p>
                            <strong>{{ $testimonial->nama_pelanggan }}</strong>
                        </article>
                    @endforeach
                </div>
            </section>
        @endif

        <span id="sponsorship" aria-hidden="true"></span>
        @if($sponsor->count())
            <section class="home-container supporting-section" aria-labelledby="sponsors-title">
                <h2 id="sponsors-title">Mitra Raja Bakery</h2>
                <div class="sponsor-grid">
                    @foreach($sponsor as $partner)
                        <div class="sponsor-card">
                            @if($partner->link)<a href="{{ $partner->link }}" target="_blank" rel="noopener noreferrer">@endif
                                <img src="{{ asset('storage/'.$partner->logo) }}" alt="{{ $partner->nama }}">
                            @if($partner->link)</a>@endif
                        </div>
                    @endforeach
                </div>
            </section>
        @endif
    </main>

    <footer class="home-footer" id="contact">
        <div class="home-container footer-grid">
            <div class="footer-brand">
                <a class="home-brand" href="#home">
                    <span class="brand-mark" aria-hidden="true"><img src="{{ asset('images/logo.png') }}" alt="Logo Raja Bakery" style="width:100%;height:100%;object-fit:cover;border-radius:50%"></span>
                    <span>RAJA BAKERY</span>
                </a>
                <div class="social-links">
                    @foreach(['instagram' => 'IG', 'facebook' => 'f', 'tiktok' => '♪'] as $network => $label)
                        @if(!empty($pf->$network))
                            <a href="{{ $pf->$network }}" target="_blank" rel="noopener noreferrer" aria-label="{{ ucfirst($network) }}">{{ $label }}</a>
                        @endif
                    @endforeach
                </div>
            </div>
            <div class="footer-column">
                <h3>Belanja</h3>
                <a href="/produk">Semua roti</a>
                <a href="/produk?kategori=donat">Donat</a>
                <a href="/peringkat">Roti populer</a>
            </div>
            <div class="footer-column">
                <h3>Bantuan</h3>
                <a href="/kontak">Cara pesan</a>
                <a href="/kontak">Pengiriman</a>
                <a href="/kontak">FAQ</a>
            </div>
            <div class="footer-column">
                <h3>Hubungi Kami</h3>
                <p>{{ $pf->alamat ?? 'Jl. Abdul Hadi no 13 Kota Malang' }}</p>
                <p>{{ $pf->email ?? 'halo@gmail.com' }}</p>
                <p>Jam operasional 08:00 - 22:00</p>
            </div>
        </div>
    </footer>
</div>
@endsection
