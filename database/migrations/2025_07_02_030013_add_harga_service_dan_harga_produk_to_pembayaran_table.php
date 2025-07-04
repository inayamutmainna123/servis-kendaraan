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
        Schema::table('pembayaran', function (Blueprint $table) {
            Schema::table('pembayaran', function (Blueprint $table) {
                $table->double('harga_service')->default(0)->after('status');
                $table->double('harga_barang')->default(0)->after('harga_service');
            });
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pembayaran', function (Blueprint $table) {
            $table->dropColumn('harga_service');
            $table->dropColumn('harga_barang');
        });
    }
};
