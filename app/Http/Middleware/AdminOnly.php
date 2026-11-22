<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
class AdminOnly {
    public function handle(Request $r, Closure $next) {
        if (!session('user')) return redirect('/login')->with('err', 'Silakan login sebagai admin.');
        return $next($r);
    }
}
