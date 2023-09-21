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
        Schema::create('load_rate_histories', function (Blueprint $table) {
            $table->id();
            $table->string('load_refid')->nullable();
            $table->string('spotreport')->nullable();
            $table->string('spotcompanies')->nullable();
            $table->string('spotmileage')->nullable();
            $table->string('spothighUsd')->nullable();
            $table->string('spotrateUsd')->nullable();
            $table->string('spottimeframe')->nullable();
            $table->string('spotorigin')->nullable();
            $table->string('spotdestination')->nullable();
            $table->string('contractreport')->nullable();
            $table->string('contractcompanies')->nullable();
            $table->string('contractmileage')->nullable();
            $table->string('contracthighUsd')->nullable();
            $table->string('contractrateUsd')->nullable();
            $table->string('contracttimeframe')->nullable();
            $table->string('contractorigin')->nullable();
            $table->string('contractdestination')->nullable();
            $table->string('ref_no')->nullable();

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
        Schema::dropIfExists('load_rate_histories');
    }
};
