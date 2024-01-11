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
        Schema::create('agency_details', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('agency_id')->nullable();
            $table->string('tl_id')->nullable();
            $table->string('a_detail_name')->nullable();
            $table->string('ed')->nullable();
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
        Schema::dropIfExists('agency_details');
    }
};
