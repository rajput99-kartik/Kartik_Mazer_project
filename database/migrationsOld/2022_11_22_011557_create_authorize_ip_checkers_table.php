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
        Schema::create('authorize_ip_checkers', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->text('ipaddress')->nullable();
            $table->text('password')->nullable();
            $table->text('location')->nullable();
            $table->text('ed')->nullable();
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
        Schema::dropIfExists('authorize_ip_checkers');
    }
};
