@extends('admin.layout')

@section('content')
<style>
    .vote-summary-card {
        background: #fff;
        border: 1.5px solid var(--adm-card-border);
        border-radius: 16px;
        padding: 20px 24px;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 16px;
    }

    .vote-period-select {
        max-width: 450px;
        width: 100%;
    }

    .vote-total-badge {
        display: flex;
        align-items: center;
        gap: 12px;
        background: #fdf6ed;
        border: 1.5px solid var(--adm-line);
        padding: 10px 18px;
        border-radius: 12px;
    }

    .vote-rank-badge {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 14px;
    }

    .rank-1 { background: #fef08a; color: #854d0e; border: 1.5px solid #facc15; }
    .rank-2 { background: #e2e8f0; color: #475569; border: 1.5px solid #cbd5e1; }
    .rank-3 { background: #fed7aa; color: #9a3412; border: 1.5px solid #fb923c; }
    .rank-default { background: #f3f4f6; color: #6b7280; }

    .vote-progress-wrap {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        min-width: 160px;
    }

    .vote-progress-bar {
        flex: 1;
        height: 10px;
        background: #e8ddd0;
        border-radius: 99px;
        overflow: hidden;
    }

    .vote-progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--adm-gold) 0%, var(--adm-orange) 100%);
        border-radius: 99px;
        transition: width .4s ease;
    }
</style>

<div class="adm-page-header">
    <div>
        <h1 class="adm-page-title">Hasil Rekapitulasi Voting</h1>
        <p class="adm-page-subtitle">Pantau perolehan suara pemilihan roti terfavorit berdasarkan periode aktif atau sebelumnya.</p>
    </div>
</div>

@if($periodes->isEmpty())
    <div class="adm-card" style="text-align:center; padding:50px 20px">
        <span style="font-size:48px; display:block; margin-bottom:12px">📅</span>
        <h3 style="color:var(--adm-brown); margin-bottom:6px">Belum Ada Periode Voting</h3>
        <p style="color:var(--adm-muted); margin-bottom:20px">Silakan buat periode voting terlebih dahulu untuk mulai mengumpulkan suara.</p>
        <a class="adm-btn" href="{{ route('admin.periode.index') }}">+ Buat Periode Sekarang</a>
    </div>
@else
    {{-- ── Filter Periode & Ringkasan ── --}}
    <div class="vote-summary-card">
        <div class="vote-period-select">
            <label class="adm-label" for="periodeSelect" style="margin-bottom:4px">Pilih Periode Voting:</label>
            <form method="get">
                <select id="periodeSelect" class="adm-select" name="periode" onchange="this.form.submit()">
                    @foreach($periodes as $p)
                        <option value="{{ $p->id_periode }}" @selected($p->id_periode == $sel)>
                            {{ $p->nama }} ({{ $p->tanggal_mulai }} s.d. {{ $p->tanggal_selesai }})
                        </option>
                    @endforeach
                </select>
            </form>
        </div>

        <div class="vote-total-badge">
            <span style="font-size:24px">🗳</span>
            <div>
                <div style="font-size:12px; font-weight:700; color:var(--adm-muted); text-transform:uppercase">Total Suara Masuk</div>
                <div style="font-size:22px; font-weight:800; color:var(--adm-brown)">{{ $total }} Suara</div>
            </div>
        </div>
    </div>

    @if($total == 0)
        <div class="adm-card" style="text-align:center; padding:50px 20px">
            <span style="font-size:48px; display:block; margin-bottom:12px">🗳</span>
            <h3 style="color:var(--adm-brown); margin-bottom:6px">Belum Ada Suara</h3>
            <p style="color:var(--adm-muted)">Belum ada suara yang masuk untuk periode voting yang dipilih.</p>
        </div>
    @else
        {{-- ── Voting Results Table ── --}}
        <div class="adm-table-wrap">
            <table class="adm-table">
                <thead>
                    <tr>
                        <th style="width:60px; text-align:center">Peringkat</th>
                        <th>Nama Roti</th>
                        <th style="width:140px; text-align:center">Jumlah Vote</th>
                        <th style="min-width:220px">Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($produk as $i => $p)
                        @php
                            $pct = round($p->votes_count / $total * 100, 1);
                        @endphp
                        <tr>
                            <td style="text-align:center">
                                <span class="vote-rank-badge {{ $i == 0 ? 'rank-1' : ($i == 1 ? 'rank-2' : ($i == 2 ? 'rank-3' : 'rank-default')) }}">
                                    {{ $i + 1 }}
                                </span>
                            </td>
                            <td>
                                <strong style="font-size:15px; color:var(--adm-text)">{{ $p->nama }}</strong>
                                @if($p->kategori)
                                    <span class="adm-tag adm-tag-gold" style="margin-left:8px">{{ ucfirst($p->kategori) }}</span>
                                @endif
                            </td>
                            <td style="text-align:center">
                                <strong style="font-size:16px; color:var(--adm-brown)">{{ $p->votes_count }}</strong>
                                <span style="font-size:12px; color:var(--adm-muted)">vote</span>
                            </td>
                            <td>
                                <div class="vote-progress-wrap">
                                    <div class="vote-progress-bar">
                                        <div class="vote-progress-fill" style="width: {{ $pct }}%"></div>
                                    </div>
                                    <strong style="min-width:50px; text-align:right; font-size:13.5px">{{ $pct }}%</strong>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endif
@endsection
