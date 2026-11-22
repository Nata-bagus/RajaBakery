@extends('admin.layout')

@section('content')
<style>
    .periode-row {
        background: #fff;
        border: 1.5px solid var(--adm-card-border);
        border-radius: 14px;
        padding: 16px 20px;
        margin-bottom: 14px;
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 14px;
        box-shadow: 0 2px 10px rgba(163, 82, 15, 0.04);
    }

    .periode-row.is-active {
        border-color: var(--adm-gold);
        background: #fffdf9;
        box-shadow: 0 4px 16px rgba(243, 168, 33, 0.15);
    }
</style>

<div class="adm-page-header">
    <div>
        <h1 class="adm-page-title">Periode Voting</h1>
        <p class="adm-page-subtitle">Atur jadwal pelaksanaan voting roti terfavorit. Periode aktif otomatis berlaku jika tanggal hari ini berada di antara tanggal mulai dan selesai.</p>
    </div>
</div>

{{-- ── Form Tambah Periode ── --}}
<div class="adm-card" style="margin-bottom: 28px">
    <h3 style="font-size:17px; font-weight:800; color:var(--adm-brown); margin-bottom:14px; display:flex; align-items:center; gap:8px">
        <span>➕</span> Tambah Periode Baru
    </h3>
    <form method="post" action="{{ route('admin.periode.store') }}">
        @csrf
        <div style="display:grid; grid-template-columns: 2fr 1fr 1fr auto; gap:12px; align-items:end">
            <div>
                <label class="adm-label" for="new_nama">Nama Periode</label>
                <input class="adm-input" type="text" id="new_nama" name="nama" placeholder="Contoh: Voting Desember 2026" required>
            </div>
            <div>
                <label class="adm-label" for="new_mulai">Tanggal Mulai</label>
                <input class="adm-input" type="date" id="new_mulai" name="tanggal_mulai" required>
            </div>
            <div>
                <label class="adm-label" for="new_selesai">Tanggal Selesai</label>
                <input class="adm-input" type="date" id="new_selesai" name="tanggal_selesai" required>
            </div>
            <div>
                <button class="adm-btn" type="submit" style="height:44px">
                    + Tambah
                </button>
            </div>
        </div>
    </form>
</div>

{{-- ── Daftar Periode ── --}}
<div class="adm-page-header" style="margin-bottom:16px">
    <h2 style="font-size:19px; font-weight:800; color:var(--adm-brown)">Daftar Periode Tersimpan</h2>
</div>

@forelse($periode as $p)
    @php
        $today = date('Y-m-d');
        $isActive = ($today >= $p->tanggal_mulai && $today <= $p->tanggal_selesai);
    @endphp
    <div class="periode-row {{ $isActive ? 'is-active' : '' }}">
        <div style="min-width:110px">
            @if($isActive)
                <span class="adm-tag adm-tag-success">● Sedang Aktif</span>
            @elseif($today < $p->tanggal_mulai)
                <span class="adm-tag adm-tag-gold">Akan Datang</span>
            @else
                <span class="adm-tag adm-tag-muted">Selesai</span>
            @endif
        </div>

        <form method="post" action="{{ route('admin.periode.update', $p) }}" style="display:flex; flex:1; flex-wrap:wrap; gap:12px; align-items:center">
            @csrf
            @method('PUT')
            <div style="flex:2; min-width:180px">
                <input class="adm-input" type="text" name="nama" value="{{ $p->nama }}" required style="font-weight:600">
            </div>
            <div style="flex:1; min-width:140px">
                <input class="adm-input" type="date" name="tanggal_mulai" value="{{ $p->tanggal_mulai }}" required>
            </div>
            <div style="flex:1; min-width:140px">
                <input class="adm-input" type="date" name="tanggal_selesai" value="{{ $p->tanggal_selesai }}" required>
            </div>
            <div style="display:flex; gap:8px">
                <button type="submit" class="adm-btn adm-btn-sm">
                    Simpan
                </button>
                <button type="submit" class="adm-btn adm-btn-danger-outline adm-btn-sm" form="d{{ $p->id_periode }}" onclick="return confirm('Hapus periode ini beserta seluruh suara votingnya?')">
                    Hapus
                </button>
            </div>
        </form>

        <form id="d{{ $p->id_periode }}" method="post" action="{{ route('admin.periode.destroy', $p) }}" style="display:none">
            @csrf
            @method('DELETE')
        </form>
    </div>
@empty
    <div class="adm-card" style="text-align:center; padding:40px 20px; color:var(--adm-muted)">
        Belum ada periode voting yang dibuat.
    </div>
@endforelse

@endsection
