<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Produk;
use Illuminate\Http\Request;
class ProdukController extends Controller {
    private function data(Request $r) {
        $d = $r->validate([
            'nama' => 'required|max:100', 'harga' => 'nullable|integer|min:0',
            'kategori' => 'required|in:manis,asin,besar,mix,minuman,tart,aksesoris,cookies',
            'rasa' => 'nullable|max:150', 'deskripsi' => 'nullable',
            'status_produk' => 'required|in:menu_tetap,kandidat_baru', 'foto' => 'nullable|image|max:5120',
        ]);
        $d['bisa_divote'] = $r->boolean('bisa_divote');
        $d['status_tampil'] = $r->boolean('status_tampil');
        if ($r->hasFile('foto')) $d['foto'] = $r->file('foto')->store('produk', 'public');
        return $d;
    }
    public function index(Request $r) {
        $produk = Produk::withCount('votes')->when($r->q, fn($q) => $q->where('nama', 'like', '%' . $r->q . '%'))->orderBy('nama')->paginate(30)->withQueryString();
        return view('admin.index', compact('produk'));
    }
    public function create() { return view('admin.form', ['p' => new Produk(['bisa_divote' => 1, 'status_tampil' => 1])]); }
    public function store(Request $r) { Produk::create($this->data($r) + ['admin_id' => session('user.id')]); return redirect()->route('admin.produk.index')->with('ok', 'Produk ditambahkan.'); }
    public function edit(Produk $produk) { return view('admin.form', ['p' => $produk]); }
    public function update(Request $r, Produk $produk) { $produk->update($this->data($r)); return redirect()->route('admin.produk.index')->with('ok', 'Produk diperbarui.'); }
    public function destroy(Produk $produk) { $produk->delete(); return back()->with('ok', 'Produk dihapus.'); }
}
