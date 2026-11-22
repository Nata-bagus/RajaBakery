<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{PublicController, AuthController};
use App\Http\Controllers\Admin\{ProdukController, HasilController, PeriodeController, SponsorController};
use App\Http\Middleware\AdminOnly;

Route::get('/', [PublicController::class, 'home']);
Route::get('/produk', [PublicController::class, 'produk']);
Route::get('/produk/{produk}', [PublicController::class, 'detail']);
Route::post('/produk/{produk}/vote', [PublicController::class, 'vote'])->middleware('throttle:10,1');
Route::get('/peringkat', [PublicController::class, 'peringkat']);
Route::get('/sponsorship', [PublicController::class, 'sponsorship']);
Route::post('/sponsorship', [PublicController::class, 'kirimSponsorship']);
Route::get('/kontak', [PublicController::class, 'kontak']);
Route::get('/login', [AuthController::class, 'form']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::middleware(AdminOnly::class)->prefix('admin')->group(function () {
    Route::get('/', fn() => view('admin.dashboard', ['periode' => \App\Models\Periode::aktif(), 'jml' => \App\Models\Produk::count()]))->name('admin.dashboard');
    Route::resource('produk', ProdukController::class)->except('show')->names('admin.produk');
    Route::get('hasil', [HasilController::class, 'index'])->name('admin.hasil');
    Route::resource('periode', PeriodeController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.periode');
    Route::resource('sponsor', SponsorController::class)->only(['index', 'store', 'update', 'destroy'])->names('admin.sponsor');
});
