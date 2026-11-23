<?php
namespace App\Http\Controllers;
use App\Models\{Produk, Vote, Periode, Sponsor};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{Cookie, DB};
use Illuminate\Support\Str;
class PublicController extends Controller {
    private function hitung($pid) {
        return Produk::withCount(['votes' => fn($q) => $q->where('id_periode', $pid)])
            ->where('bisa_divote', 1)->where('status_tampil', 1);
    }
    public function home() {
        $periode = Periode::aktif();
        $top = $this->hitung($periode->id_periode ?? 0)->orderByDesc('votes_count')->orderBy('nama')->take(3)->get();
        return view('home', [
            'periode' => $periode, 'top' => $top, 'ada' => $top->sum('votes_count') > 0,
            'pf' => DB::table('profil_toko')->first(),
            'testimoni' => DB::table('testimoni')->latest('created_at')->take(6)->get(),
            'sponsor' => Sponsor::where('status_tampil', 1)->orderBy('nama')->get(),
        ]);
    }
    public function produk(Request $r) {
        $periode = Periode::aktif();
        $q = $this->hitung($periode->id_periode ?? 0);
        if ($r->q) $q->where('nama', 'like', '%' . $r->q . '%');
        if ($r->kategori == 'donat') {
            $q->where('nama', 'like', '%donat%');
        } elseif ($r->kategori == 'inovasi') {
            $q->where(fn($sub) => $sub->where('status_produk', 'kandidat_baru')->orWhere('kategori', 'inovasi'));
        } elseif ($r->kategori) {
            $q->where('kategori', $r->kategori);
        }
        $produk = $q->orderBy('nama')->paginate(24)->withQueryString();
        return view('produk', compact('periode', 'produk'));
    }
    public function detail(Produk $produk) {
        abort_unless($produk->status_tampil, 404);
        $periode = Periode::aktif();
        $votes = $periode ? $produk->votes()->where('id_periode', $periode->id_periode)->count() : 0;
        return view('detail', compact('produk', 'periode', 'votes'));
    }
    public function peringkat() {
        $periode = Periode::aktif() ?? Periode::orderByDesc('tanggal_selesai')->first();
        $top = $this->hitung($periode->id_periode ?? 0)->orderByDesc('votes_count')->orderBy('nama')->take(10)->get();
        return view('peringkat', compact('periode', 'top'));
    }
    public function vote(Request $r, Produk $produk) {
        $periode = Periode::aktif();
        if (!$periode) return back()->with('err', 'Voting belum dibuka.');
        if (!$produk->bisa_divote || !$produk->status_tampil) abort(404);
        $token = $r->cookie('rb_token') ?: Str::random(40);
        Cookie::queue('rb_token', $token, 525600);
        $hash = hash('sha256', $token);
        $ada = Vote::where(['id_periode' => $periode->id_periode, 'token_hash' => $hash, 'id_produk' => $produk->id_produk])->exists();
        if ($ada) return back()->with('err', 'Kamu sudah memilih roti ini di periode ini.');
        if (Vote::where('id_periode', $periode->id_periode)->where('ip_address', $r->ip())->count() >= 20)
            return back()->with('err', 'Batas vote dari jaringan ini sudah tercapai.');
        Vote::create(['id_periode' => $periode->id_periode, 'id_produk' => $produk->id_produk, 'token_hash' => $hash, 'ip_address' => $r->ip()]);
        return back()->with('ok', 'Vote berhasil, terima kasih!');
    }
    public function kontak() { return view('kontak', ['p' => DB::table('profil_toko')->first()]); }
    public function sponsorship() {
        return view('sponsorship', [
            'sponsor' => Sponsor::where('status_tampil', 1)->orderBy('nama')->get(),
            'pf'      => DB::table('profil_toko')->first(),
        ]);
    }
    public function kirimSponsorship(Request $r) {
        $r->validate([
            'nama' => 'required|max:100',
            'email' => 'required|email|max:100',
            'telepon' => 'required|max:20',
            'jenis' => 'required',
            'pesan' => 'required',
        ]);
        return back()->with('ok', 'Pengajuan kolaborasi berhasil dikirim! Tim Raja Bakery akan segera menghubungi Anda.');
    }
}
