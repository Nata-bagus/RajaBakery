<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\{Produk, Periode};
use Illuminate\Http\Request;
class HasilController extends Controller {
    public function index(Request $r) {
        $periodes = Periode::orderByDesc('tanggal_mulai')->get();
        $sel = $r->periode ?: (Periode::aktif()?->id_periode ?? $periodes->first()?->id_periode ?? 0);
        $produk = Produk::withCount(['votes' => fn($q) => $q->where('id_periode', $sel)])
            ->where('bisa_divote', 1)->orderByDesc('votes_count')->orderBy('nama')->get();
        return view('admin.hasil', ['periodes' => $periodes, 'sel' => $sel, 'produk' => $produk, 'total' => $produk->sum('votes_count')]);
    }
}
