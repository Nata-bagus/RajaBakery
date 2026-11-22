<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Hash};
class AuthController extends Controller {
    public function form() { return view('login'); }
    public function login(Request $r) {
        $r->validate(['email' => 'required|email', 'password' => 'required']);
        $u = DB::table('admin')->where('email', $r->email)->first();
        if ($u && Hash::check($r->password, $u->password)) {
            $r->session()->regenerate();
            session(['user' => ['id' => $u->id_admin, 'name' => $u->nama]]);
            return redirect('/admin');
        }
        return back()->withInput()->with('err', 'Email atau kata sandi salah.');
    }
    public function logout(Request $r) { $r->session()->invalidate(); $r->session()->regenerateToken(); return redirect('/'); }
}
