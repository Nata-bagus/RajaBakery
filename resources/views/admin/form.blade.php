@extends('admin.layout')

@section('content')
<div class="adm-page-header">
    <div>
        <h1 class="adm-page-title">{{ $p->exists ? 'Ubah Data Roti' : 'Tambah Roti Baru' }}</h1>
        <p class="adm-page-subtitle">{{ $p->exists ? 'Perbarui informasi produk: ' . $p->nama : 'Masukkan detail informasi varian roti baru ke dalam katalog.' }}</p>
    </div>
    <a class="adm-btn adm-btn-outline" href="{{ route('admin.produk.index') }}">
        &larr; Kembali ke Daftar Roti
    </a>
</div>

<div class="adm-card" style="max-width: 800px; margin: 0 auto">
    <form method="post" enctype="multipart/form-data" action="{{ $p->exists ? route('admin.produk.update', $p) : route('admin.produk.store') }}">
        @csrf
        @if($p->exists)
            @method('PUT')
        @endif

        <div class="adm-form-group">
            <label class="adm-label" for="nama">Nama Roti <span style="color:#dc2626">*</span></label>
            <input class="adm-input" type="text" id="nama" name="nama" value="{{ old('nama', $p->nama) }}" placeholder="Contoh: Donat Berry, Apple Pie" required>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px">
            <div class="adm-form-group">
                <label class="adm-label" for="harga">Harga (Rp)</label>
                <input class="adm-input" type="number" id="harga" name="harga" value="{{ old('harga', $p->harga) }}" placeholder="Kosongkan jika kandidat baru">
                <small style="color:var(--adm-muted); font-size:12px">Opsional untuk kandidat roti yang baru diuji</small>
            </div>

            <div class="adm-form-group">
                <label class="adm-label" for="kategori">Kategori</label>
                <select class="adm-select" id="kategori" name="kategori">
                    @foreach(['manis' => 'Roti Manis', 'asin' => 'Roti Gurih', 'donat' => 'Donat', 'besar' => 'Besar', 'mix' => 'Mix', 'minuman' => 'Minuman', 'tart' => 'Tart', 'aksesoris' => 'Aksesoris', 'cookies' => 'Cookies'] as $k => $label)
                        <option value="{{ $k }}" @selected(old('kategori', $p->kategori) == $k)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="display:grid; grid-template-columns: 1fr 1fr; gap:16px">
            <div class="adm-form-group">
                <label class="adm-label" for="rasa">Varian Rasa</label>
                <input class="adm-input" type="text" id="rasa" name="rasa" value="{{ old('rasa', $p->rasa) }}" placeholder="Contoh: Cokelat, Keju, Apel, Berry">
            </div>

            <div class="adm-form-group">
                <label class="adm-label" for="status_produk">Jenis Menu</label>
                <select class="adm-select" id="status_produk" name="status_produk">
                    <option value="menu_tetap" @selected(old('status_produk', $p->status_produk) == 'menu_tetap')>Menu Tetap</option>
                    <option value="kandidat_baru" @selected(old('status_produk', $p->status_produk) == 'kandidat_baru')>Kandidat Baru</option>
                </select>
            </div>
        </div>

        <div class="adm-form-group">
            <label class="adm-label" for="deskripsi">Deskripsi Roti</label>
            <textarea class="adm-textarea" id="deskripsi" name="deskripsi" rows="3" placeholder="Tuliskan deskripsi rasa, tekstur, atau keunggulan roti ini...">{{ old('deskripsi', $p->deskripsi) }}</textarea>
        </div>

        <div class="adm-form-group">
            <label class="adm-label">Foto Produk (Maks 2 MB)</label>
            @if($p->foto)
                <div style="display:flex; align-items:center; gap:16px; margin-bottom:10px">
                    <div style="width:70px; height:70px; border-radius:10px; background:var(--adm-gold); overflow:hidden; border:1.5px solid var(--adm-card-border); display:flex; align-items:center; justify-content:center">
                        <img src="{{ asset('storage/'.$p->foto) }}" alt="{{ $p->nama }}" style="width:100%; height:100%; object-fit:contain">
                    </div>
                    <div style="font-size:13px; color:var(--adm-muted)">
                        Foto saat ini telah terpasang. Pilih file baru untuk menggantinya.
                    </div>
                </div>
            @endif
            <input class="adm-input" type="file" name="foto" accept="image/*">
        </div>

        <div style="display:flex; flex-wrap:wrap; gap:24px; margin: 20px 0 28px; padding:16px; background:#fdf6ed; border-radius:12px; border:1px solid var(--adm-line)">
            <label class="adm-checkbox-label">
                <input type="checkbox" name="bisa_divote" value="1" @checked(old('bisa_divote', $p->bisa_divote ?? true))>
                <span>Bisa divote oleh pelanggan</span>
            </label>

            <label class="adm-checkbox-label">
                <input type="checkbox" name="status_tampil" value="1" @checked(old('status_tampil', $p->status_tampil ?? true))>
                <span>Tampilkan produk di website</span>
            </label>
        </div>

        <div style="display:flex; gap:12px; align-items:center">
            <button class="adm-btn" type="submit">
                💾 Simpan Produk
            </button>
            <a class="adm-btn adm-btn-outline" href="{{ route('admin.produk.index') }}">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
