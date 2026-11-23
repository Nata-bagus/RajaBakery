<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `produk` MODIFY COLUMN `kategori` ENUM('manis','asin','donat','inovasi','besar','mix','minuman','tart','aksesoris','cookies') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        \Illuminate\Support\Facades\DB::statement("ALTER TABLE `produk` MODIFY COLUMN `kategori` ENUM('manis','asin','besar','mix','minuman','tart','aksesoris','cookies') NOT NULL");
    }
};
