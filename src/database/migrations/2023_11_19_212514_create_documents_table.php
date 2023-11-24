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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('document_type')->nullable();
            $table->unsignedBigInteger('document_status')->nullable();
            $table->string('document_number');
            $table->dateTime('document_date');
            $table->unsignedBigInteger('billing_address_id')->nullable();
            $table->unsignedBigInteger('delivery_address_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
