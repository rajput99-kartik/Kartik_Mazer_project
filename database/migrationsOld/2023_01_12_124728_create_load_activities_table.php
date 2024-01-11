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
        Schema::create('load_activities', function (Blueprint $table) {
            $table->id();
            $table->string('log_name')->unique();
            $table->string('description')->nullable();
            $table->string('subject_type')->nullable();
            $table->string('event')->nullable();
            $table->string('subject_id')->nullable();
            $table->string('causer_type')->nullable();
            $table->string('causer_id')->nullable();
            $table->string('properties')->nullable();
            $table->string('batch_uuid')->nullable();
            $table->string('ip')->nullable();
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
        Schema::dropIfExists('load_activities');
    }
};
