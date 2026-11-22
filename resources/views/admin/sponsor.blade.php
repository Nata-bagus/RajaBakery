@extends('admin.layout')

@section('content')
<style>
    .sponsor-card-item {
        background: #fff;
        border: 1.5px solid var(--adm-card-border);
        border-radius: 16px;
        padding: 18px 22px;
        margin-bottom: 16px;
        box-shadow: 0 2px 10px rgba(163, 82, 15, 0.04);
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .sponsor-logo-box {
        width: 80px;
        height: 60px;
        border-radius: 10px;
        background: #fdf6ed;
        border: 1.5px solid var(--adm-line);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        flex-shrink: 0;
    }

    .sponsor-logo-box img {
        max-width: 90%;
        max-height: 90%;
        object-fit: contain;
    }
</style>

<div class="adm-page-header">
    <div>
        <h1 class="adm-page-title">Kelola Sponsorship & Mitra</h1>
        <p class="adm-page-subtitle">Daftarkan logo dan tautan perusahaan atau institusi yang bermitra dengan Raja Bakery untuk ditampilkan pada halaman publik.</p>
    </div>
</div>

{{-- ── Form Tambah Mitra ── --}}
<div class="adm-card" style="margin-bottom: 28px">
    <h3 style="font-size:17px; font-weight:800; color:var(--adm-brown); margin-bottom:14px; display:flex; align-items:center; gap:8px">
        <span>➕</span> Tambah Mitra Baru
    </h3>
    <form method="post" enctype="multipart/form-data" action="{{ route('admin.sponsor.store') }}">
        @csrf
        <div style="display:grid; grid-template-columns: 2fr 2fr 2fr auto auto; gap:12px; align-items:end">
            <div>
                <label class="adm-label" for="new_nama">Nama Mitra <span style="color:#dc2626">*</span></label>
                <input class="adm-input" type="text" id="new_nama" name="nama" placeholder="Contoh: PT Boga Utama" required>
            </div>
            <div>
                <label class="adm-label" for="new_link">Tautan Website (Opsional)</label>
                <input class="adm-input" type="url" id="new_link" name="link" placeholder="https://contoh.com">
            </div>
            <div>
                <label class="adm-label" for="new_logo">Upload Logo <span style="color:#dc2626">*</span></label>
                <input class="adm-input" type="file" id="new_logo" name="logo" accept="image/*" required>
            </div>
            <div style="padding-bottom: 10px">
                <label class="adm-checkbox-label">
                    <input type="checkbox" name="status_tampil" value="1" checked>
                    <span>Tampil</span>
                </label>
            </div>
            <div>
                <button class="adm-btn" type="submit" style="height:44px">
                    + Tambah
                </button>
            </div>
        </div>
    </form>
</div>

{{-- ── Daftar Mitra Tersimpan ── --}}
<div class="adm-page-header" style="margin-bottom:16px">
    <h2 style="font-size:19px; font-weight:800; color:var(--adm-brown)">Daftar Mitra Aktif</h2>
</div>

@forelse($sponsor as $s)
    <div class="sponsor-card-item">
        <div class="sponsor-logo-box">
            @if($s->logo)
                <img src="{{ asset('storage/'.$s->logo) }}" alt="{{ $s->nama }}">
            @else
                <span style="font-size:24px">🤝</span>
            @endif
        </div>

        <form method="post" enctype="multipart/form-data" action="{{ route('admin.sponsor.update', $s) }}" style="display:flex; flex:1; flex-wrap:wrap; gap:12px; align-items:center">
            @csrf
            @method('PUT')

            <div style="flex:2; min-width:160px">
                <label class="adm-label" style="font-size:12px; margin-bottom:2px">Nama Mitra</label>
                <input class="adm-input" type="text" name="nama" value="{{ $s->nama }}" required style="font-weight:600">
            </div>

            <div style="flex:2; min-width:160px">
                <label class="adm-label" style="font-size:12px; margin-bottom:2px">Tautan Web</label>
                <input class="adm-input" type="url" name="link" value="{{ $s->link }}" placeholder="https://...">
            </div>

            <div style="flex:1.5; min-width:160px">
                <label class="adm-label" style="font-size:12px; margin-bottom:2px">Ganti Logo (Opsional)</label>
                <input class="adm-input" type="file" name="logo" accept="image/*">
            </div>

            <div style="padding-top:16px; min-width:90px">
                <label class="adm-checkbox-label">
                    <input type="checkbox" name="status_tampil" value="1" @checked($s->status_tampil)>
                    <span>Tampil</span>
                </label>
            </div>

            <div style="display:flex; gap:8px; padding-top:14px">
                <button type="submit" class="adm-btn adm-btn-sm">
                    Simpan
                </button>
                <button type="submit" class="adm-btn adm-btn-danger-outline adm-btn-sm" form="d{{ $s->id_sponsor }}" onclick="return confirm('Apakah Anda yakin ingin menghapus mitra ini?')">
                    Hapus
                </button>
            </div>
        </form>

        <form id="d{{ $s->id_sponsor }}" method="post" action="{{ route('admin.sponsor.destroy', $s) }}" style="display:none">
            @csrf
            @method('DELETE')
        </form>
    </div>
@empty
    <div class="adm-card" style="text-align:center; padding:40px 20px; color:var(--adm-muted)">
        Belum ada mitra yang ditambahkan.
    </div>
@endforelse

@endsection
