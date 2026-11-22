<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Periode extends Model {
    protected $table = 'periode';
    protected $primaryKey = 'id_periode';
    public $timestamps = false;
    protected $guarded = [];
    public static function aktif() {
        $t = now()->toDateString();
        return static::where('tanggal_mulai', '<=', $t)->where('tanggal_selesai', '>=', $t)->first();
    }
}
