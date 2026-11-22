<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Periode;
use Illuminate\Http\Request;
class PeriodeController extends Controller {
    private function data(Request $r) {
        return $r->validate(['nama' => 'required|max:100', 'tanggal_mulai' => 'required|date', 'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai']);
    }
    private function tumpang($d, $except = null) {
        return Periode::where('tanggal_mulai', '<=', $d['tanggal_selesai'])->where('tanggal_selesai', '>=', $d['tanggal_mulai'])
            ->when($except, fn($q) => $q->where('id_periode', '!=', $except))->exists();
    }
    private function tolak() { return back()->withInput()->withErrors(['tanggal_mulai' => 'Rentang tanggal tumpang tindih dengan periode lain.']); }
    public function index() { return view('admin.periode', ['periode' => Periode::orderByDesc('tanggal_mulai')->get()]); }
    public function store(Request $r) {
        $d = $this->data($r);
        if ($this->tumpang($d)) return $this->tolak();
        Periode::create($d);
        return back()->with('ok', 'Periode ditambahkan.');
    }
    public function update(Request $r, Periode $periode) {
        $d = $this->data($r);
        if ($this->tumpang($d, $periode->id_periode)) return $this->tolak();
        $periode->update($d);
        return back()->with('ok', 'Periode diperbarui.');
    }
    public function destroy(Periode $periode) { $periode->delete(); return back()->with('ok', 'Periode dihapus beserta vote di dalamnya.'); }
}
