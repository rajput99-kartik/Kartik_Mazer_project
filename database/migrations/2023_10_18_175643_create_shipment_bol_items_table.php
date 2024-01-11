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
        Schema::create('shipment_bol_items', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('shipment_bolid')->nullable();
            $table->string('shipment_id')->nullable();
            $table->string('ed')->nullable();            
            $table->string('ofpieces')->nullable();
            $table->string('descriptions')->nullable();
            $table->string('weight')->nullable();
            $table->string('type')->nullable();
            $table->string('nmfc')->nullable();
            $table->string('hazmat')->nullable();
            $table->string('productclass')->nullable();
            $table->string('notes')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipment_bol_items');
    }
};
