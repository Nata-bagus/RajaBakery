<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Sponsor extends Model {
    protected $table = 'sponsor';
    protected $primaryKey = 'id_sponsor';
    public $timestamps = false;
    protected $guarded = [];
}
