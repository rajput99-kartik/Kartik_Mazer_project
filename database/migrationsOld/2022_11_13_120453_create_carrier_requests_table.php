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
        Schema::create('carrier_requests', function (Blueprint $table) {
            $table->id();
            $table->string('sender_id')->nullable();
            $table->string('carrier_id')->nullable();
            $table->string('mc_no')->nullable();
            $table->string('dot_no')->nullable();
            $table->string('comment')->nullable();
            $table->string('request_date')->nullable();
            $table->string('request_type')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('carrier_requests');
    }
};
