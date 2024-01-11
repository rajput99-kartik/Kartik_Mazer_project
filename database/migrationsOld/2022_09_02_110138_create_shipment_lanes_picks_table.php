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
        Schema::create('shipment_lanes_picks', function (Blueprint $table) {
            $table->id();
			$table->string('shipment_id')->nullable();
			$table->string('user_id')->nullable();
			$table->string('p_name')->nullable();
			$table->string('p_address')->nullable();
			$table->string('p_city')->nullable();
			$table->string('p_state')->nullable();
			$table->string('p_zip')->nullable();
			$table->string('p_countary')->nullable();
			$table->string('p_contact')->nullable();
			$table->string('p_ref')->nullable();
			$table->string('p_phone')->nullable();
			$table->string('p_email')->nullable();
			$table->string('p_ready')->nullable();
			$table->string('p_rtime')->nullable();
			$table->string('p_appt')->nullable();
			$table->string('p_atime')->nullable();
			$table->string('p_appt_note')->nullable();
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
        Schema::dropIfExists('shipment_lanes_picks');
    }
};
