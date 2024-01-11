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
        Schema::create('shipment_lanes_drops', function (Blueprint $table) {
            $table->id();
			$table->string('shipment_id')->nullable();
			$table->string('user_id')->nullable();
			$table->string('d_name')->nullable();
			$table->string('d_address')->nullable();
			$table->string('d_city')->nullable();
			$table->string('d_state')->nullable();
			$table->string('d_zip')->nullable();
			$table->string('d_countary')->nullable();
			$table->string('d_contact')->nullable();
			$table->string('d_ref')->nullable();
			$table->string('d_phone')->nullable();
			$table->string('d_email')->nullable();
			$table->string('d_ready')->nullable();
			$table->string('d_rtime')->nullable();
			$table->string('d_appt')->nullable();
			$table->string('d_atime')->nullable();
			$table->string('d_appt_note')->nullable();
			$table->string('manage_order')->nullable();
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
        Schema::dropIfExists('shipment_lanes_drops');
    }
};
