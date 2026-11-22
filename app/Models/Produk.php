<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Produk extends Model {
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $guarded = [];
    public function votes() { return $this->hasMany(Vote::class, 'id_produk', 'id_produk'); }
}
