@extends('admin.layout')

@section('content')
<style>
    .prod-filter-bar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 16px;
        margin-bottom: 24px;
    }

    .prod-search-form {
        display: flex;
        align-items: center;
        gap: 0;
        max-width: 440px;
        width: 100%;
    }

    .prod-search-form input[type="text"] {
        flex: 1;
        padding: 10px 16px;
        border: 1.5px solid #d4c0a8;
        border-right: none;
        border-radius: 10px 0 0 10px;
        font: inherit;
        font-size: 14px;
        background: #fff;
        outline: none;
    }

    .prod-search-form input[type="text"]:focus {
        border-color: var(--adm-brown);
    }

    .prod-search-form button {
        padding: 10px 20px;
        background: var(--adm-brown);
        color: #fff;
        border: none;
        border-radius: 0 10px 10px 0;
        font: inherit;
        font-size: 14px;
        font-weight: 700;
        cursor: pointer;
        transition: background .15s;
    }

    .prod-search-form button:hover {
        background: var(--adm-brown-dark);
    }

    .prod-img-thumb {
        width: 50px;
        height: 50px;
        border-radius: 8px;
        background: var(--adm-gold);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
        border: 1px solid var(--adm-line);
    }

    .prod-img-thumb img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .prod-actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }
</style>

<div class="adm-page-header">
    <div>
        <h1 class="adm-page-title">Daftar Roti</h1>
        <p class="adm-page-subtitle">Kelola seluruh produk roti yang tersedia di katalog Raja Bakery.</p>
    </div>
    <a class="adm-btn" href="{{ route('admin.produk.create') }}">
        <span>+ Tambah Roti Baru</span>
    </a>
</div>

{{-- ── Filter & Search Bar ── --}}
<div class="prod-filter-bar">
    <form class="prod-search-form" method="get">
        <input type="text" name="q" value="{{ request('q') }}" placeholder="Cari nama roti...">
        <button type="submit">Cari</button>
    </form>
    @if(request('q'))
        <a href="{{ route('admin.produk.index') }}" class="adm-btn adm-btn-outline adm-btn-sm">
            Reset Filter
        </a>
    @endif
</div>

{{-- ── Products Table ── --}}
<div class="adm-table-wrap">
    <table class="adm-table">
        <thead>
            <tr>
                <th style="width:70px">Foto</th>
                <th>Nama Roti</th>
                <th>Kategori</th>
                <th>Harga</th>
                <th>Status</th>
                <th>Total Vote</th>
                <th style="text-align:right">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($produk as $p)
                <tr>
                    <td>
                        <div class="prod-img-thumb">
                            @if($p->foto)
                                <img src="{{ asset('storage/'.$p->foto) }}" alt="{{ $p->nama }}">
                            @else
                                <span style="font-size:18px">🍞</span>
                            @endif
                        </div>
                    </td>
                    <td>
                        <strong style="color:var(--adm-text); font-size:15px">{{ $p->nama }}</strong>
                        @if($p->rasa)
                            <div style="font-size:12.5px; color:var(--adm-muted)">Rasa: {{ $p->rasa }}</div>
                        @endif
                    </td>
                    <td>
                        @php
                            $katLabels = ['manis' => 'Roti Manis', 'asin' => 'Roti Gurih', 'donat' => 'Donat', 'inovasi' => 'Roti Inovasi'];
                            $katName = $katLabels[$p->kategori] ?? ucfirst($p->kategori ?? 'Umum');
                        @endphp
                        <span class="adm-tag adm-tag-gold">{{ $katName }}</span>
                    </td>
                    <td>
                        <strong style="color:var(--adm-brown)">
                            {{ $p->harga ? 'Rp' . number_format($p->harga, 0, ',', '.') : 'Hubungi Toko' }}
                        </strong>
                    </td>
                    <td>
                        @if($p->status_tampil)
                            <span class="adm-tag adm-tag-success">✓ Tampil</span>
                        @else
                            <span class="adm-tag adm-tag-muted">Disembunyikan</span>
                        @endif
                    </td>
                    <td>
                        <strong>{{ $p->votes_count ?? 0 }}</strong>
                        <span style="font-size:12px; color:var(--adm-muted)">suara</span>
                    </td>
                    <td style="text-align:right">
                        <div class="prod-actions" style="justify-content:flex-end">
                            <a class="adm-btn adm-btn-outline adm-btn-sm" href="{{ route('admin.produk.edit', $p) }}">
                                Edit
                            </a>
                            <form method="post" action="{{ route('admin.produk.destroy', $p) }}" style="display:inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus roti ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="adm-btn adm-btn-danger-outline adm-btn-sm">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" style="text-align:center; padding:40px 20px; color:var(--adm-muted)">
                        @if(request('q'))
                            Tidak ada roti yang sesuai dengan pencarian "{{ request('q') }}".
                        @else
                            Belum ada data roti. Silakan tambahkan roti baru.
                        @endif
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="adm-pagination">
    {{ $produk->links() }}
</div>
@endsection
