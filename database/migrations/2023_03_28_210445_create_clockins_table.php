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
        Schema::create('clockins', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('clockin')->nullable();
            $table->string('clockout')->nullable();
            $table->string('date_data')->nullable();
            $table->string('timein')->nullable();
            $table->string('timeout')->nullable();
            $table->string('brackin')->nullable();
            $table->string('brackout')->nullable();
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
        Schema::dropIfExists('clockins');
    }
};

