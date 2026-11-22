<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Sponsor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class SponsorController extends Controller {
    public function index() { return view('admin.sponsor', ['sponsor' => Sponsor::orderBy('nama')->get()]); }
    public function store(Request $r) {
        $d = $r->validate(['nama' => 'required|max:100', 'link' => 'nullable|url', 'logo' => 'required|image|max:2048']);
        $d['logo'] = $r->file('logo')->store('sponsor', 'public');
        $d['status_tampil'] = $r->boolean('status_tampil');
        $d['admin_id'] = session('user.id');
        Sponsor::create($d);
        return back()->with('ok', 'Mitra ditambahkan.');
    }
    public function update(Request $r, Sponsor $sponsor) {
        $d = $r->validate(['nama' => 'required|max:100', 'link' => 'nullable|url', 'logo' => 'nullable|image|max:2048']);
        if ($r->hasFile('logo')) { Storage::disk('public')->delete($sponsor->logo); $d['logo'] = $r->file('logo')->store('sponsor', 'public'); }
        else unset($d['logo']);
        $d['status_tampil'] = $r->boolean('status_tampil');
        $sponsor->update($d);
        return back()->with('ok', 'Mitra diperbarui.');
    }
    public function destroy(Sponsor $sponsor) { Storage::disk('public')->delete($sponsor->logo); $sponsor->delete(); return back()->with('ok', 'Mitra dihapus.'); }
}
