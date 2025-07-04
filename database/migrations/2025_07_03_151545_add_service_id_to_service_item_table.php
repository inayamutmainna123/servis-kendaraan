<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddServiceIdToServiceItemTable extends Migration
{
    public function up()
    {
        Schema::table('service_item', function (Blueprint $table) {
            $table->uuid('service_id')->nullable()->after('produk_id'); 
           
            $table->foreign('service_id')->references('id')->on('service')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('service_item', function (Blueprint $table) {
            $table->dropForeign(['service_id']);
            $table->dropColumn('service_id');
        });
    }
}
