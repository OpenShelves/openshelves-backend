<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('warehouse_places', function (Blueprint $table) {
            $table->unsignedBigInteger('parent_warehouse_places_id');
            // $table->dropColumn('parent_warehouse_id');
            // $table->foreign('parent_warehouse_places_id')->references('id')->on('warehouse_places');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('warehouse_places', function (Blueprint $table) {
            $table->dropColumn('parent_warehouse_places_id');
            // $table->dropForeign(['parent_warehouse_places_id']);
        });
    }
};
