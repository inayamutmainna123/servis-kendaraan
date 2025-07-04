<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeProdukIdAndServiceIdTypeInPembayaransTable extends Migration
{
    public function up()
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->json('produk_id')->nullable()->change();
            $table->json('service_id')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('pembayarans', function (Blueprint $table) {
            $table->string('produk_id')->nullable()->change();
            $table->string('service_id')->nullable()->change();
        });
    }
}
