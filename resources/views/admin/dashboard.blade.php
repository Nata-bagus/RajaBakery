@extends('admin.layout')

@section('content')
<style>
    .dash-welcome {
        background: linear-gradient(135deg, #a3520f 0%, #7e3c06 100%);
        border-radius: 20px;
        padding: 32px 36px;
        color: #fff;
        margin-bottom: 28px;
        box-shadow: 0 10px 25px rgba(163, 82, 15, 0.15);
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 20px;
    }

    .dash-welcome h1 {
        font-size: 26px;
        font-weight: 800;
        color: var(--adm-gold);
        margin-bottom: 6px;
    }

    .dash-welcome p {
        font-size: 15px;
        color: #ffe6ba;
        max-width: 600px;
        line-height: 1.5;
    }

    .dash-stats-row {
        display: flex;
        gap: 16px;
        flex-wrap: wrap;
    }

    .dash-stat-pill {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(8px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 14px;
        padding: 12px 20px;
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .dash-stat-val {
        font-size: 22px;
        font-weight: 800;
        color: #fff;
        line-height: 1;
    }

    .dash-stat-lbl {
        font-size: 12px;
        color: #ffd79e;
        text-transform: uppercase;
        letter-spacing: .05em;
        font-weight: 600;
    }

    .dash-action-card {
        background: #fff;
        border: 1.5px solid var(--adm-card-border);
        border-radius: 18px;
        padding: 26px 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        text-decoration: none;
        color: inherit;
        transition: all .2s ease;
        min-height: 200px;
        box-shadow: 0 4px 16px rgba(163, 82, 15, 0.04);
    }

    .dash-action-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(163, 82, 15, 0.14);
        border-color: var(--adm-gold);
    }

    .dash-card-icon {
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: #fdf6ed;
        border: 1px solid var(--adm-line);
        display: grid;
        place-items: center;
        font-size: 26px;
        margin-bottom: 16px;
    }

    .dash-action-card:hover .dash-card-icon {
        background: var(--adm-gold);
    }

    .dash-card-title {
        font-size: 19px;
        font-weight: 800;
        color: var(--adm-brown);
        margin-bottom: 8px;
    }

    .dash-card-desc {
        font-size: 13.5px;
        color: var(--adm-muted);
        line-height: 1.5;
        margin-bottom: 18px;
    }

    .dash-card-link {
        font-size: 13.5px;
        font-weight: 700;
        color: var(--adm-orange);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin-top: auto;
    }

    .dash-action-card:hover .dash-card-link {
        color: var(--adm-brown);
    }
</style>

{{-- ── Welcome Banner ── --}}
<div class="dash-welcome">
    <div>
        <h1>Dashboard Admin Raja Bakery</h1>
        <p>Selamat datang kembali, <strong>{{ session('user.name') }}</strong>! Kelola katalog roti, pantau suara voting, dan atur mitra sponsorship di sini.</p>
    </div>
    <div class="dash-stats-row">
        <div class="dash-stat-pill">
            <span style="font-size:24px">🍞</span>
            <div>
                <div class="dash-stat-val">{{ $jml }}</div>
                <div class="dash-stat-lbl">Total Roti</div>
            </div>
        </div>
        <div class="dash-stat-pill">
            <span style="font-size:24px">📅</span>
            <div>
                <div class="dash-stat-val" style="font-size:16px">{{ $periode->nama ?? 'Tidak Ada' }}</div>
                <div class="dash-stat-lbl">Periode Aktif</div>
            </div>
        </div>
    </div>
</div>

<div class="adm-page-header">
    <div>
        <h2 class="adm-page-title">Menu Pengelolaan</h2>
        <p class="adm-page-subtitle">Pilih salah satu modul di bawah ini untuk memulai.</p>
    </div>
</div>

{{-- ── 4 Action Cards ── --}}
<div class="adm-grid-4">
    <a class="dash-action-card" href="/admin/produk">
        <div>
            <div class="dash-card-icon">🍞</div>
            <h3 class="dash-card-title">Daftar Roti</h3>
            <p class="dash-card-desc">Tambah varian roti baru, update harga, rasa, deskripsi, dan foto produk.</p>
        </div>
        <span class="dash-card-link">Kelola Roti &rarr;</span>
    </a>

    <a class="dash-action-card" href="/admin/hasil">
        <div>
            <div class="dash-card-icon">📈</div>
            <h3 class="dash-card-title">Hasil Voting</h3>
            <p class="dash-card-desc">Pantau rekapitulasi suara voting pelanggan secara real-time per periode.</p>
        </div>
        <span class="dash-card-link">Lihat Hasil &rarr;</span>
    </a>

    <a class="dash-action-card" href="/admin/periode">
        <div>
            <div class="dash-card-icon">📅</div>
            <h3 class="dash-card-title">Periode Voting</h3>
            <p class="dash-card-desc">Atur jadwal mulai dan selesai masa voting roti terpopuler untuk pelanggan.</p>
        </div>
        <span class="dash-card-link">Atur Jadwal &rarr;</span>
    </a>

    <a class="dash-action-card" href="/admin/sponsor">
        <div>
            <div class="dash-card-icon">🤝</div>
            <h3 class="dash-card-title">Sponsorship</h3>
            <p class="dash-card-desc">Kelola daftar logo dan tautan mitra yang bekerja sama dengan Raja Bakery.</p>
        </div>
        <span class="dash-card-link">Kelola Mitra &rarr;</span>
    </a>
</div>
@endsection
