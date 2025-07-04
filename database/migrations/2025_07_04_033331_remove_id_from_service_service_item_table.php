<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('service_service_item', function (Blueprint $table) {
            $table->dropColumn('id');
            $table->primary(['service_item_id', 'service_id']);
        });
    }

    public function down(): void
    {
        Schema::table('service_service_item', function (Blueprint $table) {
            $table->id();
            $table->dropPrimary(['service_item_id', 'service_id']);
        });
    }
};
