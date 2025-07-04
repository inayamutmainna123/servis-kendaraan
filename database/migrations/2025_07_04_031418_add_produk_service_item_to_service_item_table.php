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
        Schema::table('service_item', function (Blueprint $table) {
             $table->foreignUlid('produk_service_item_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_item', function (Blueprint $table) {
            $table->dropForeign(['produk_service_item_id']);
        });
    }
};
