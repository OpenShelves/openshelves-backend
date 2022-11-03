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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('sku');
            $table->string('name');

            $table->boolean('active')->nullable();
            $table->string('ean')->nullable();
            $table->string('gtin')->nullable();
            $table->string('asin')->nullable();

            $table->double('width')->nullable();
            $table->double('height')->nullable();
            $table->double('depth')->nullable();
            $table->double('weight')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
