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
        Schema::create('shipment_c_s_rates', function (Blueprint $table) {
            $table->id();
			$table->string('shipment_id')->nullable();
			$table->string('user_id')->nullable();
			$table->string('customer_rate_dropdown')->nullable();
			$table->string('carrier_rate_dropdown')->nullable();
			$table->string('unit1_customer')->nullable();
			$table->string('unit2_customer')->nullable();
			$table->string('lh_customer')->nullable();
			$table->string('rate_unit1_carrier')->nullable();
			$table->string('rate_unit2_carrier')->nullable();
			$table->string('lh_carrier')->nullable();
			$table->string('carrier_rate_haul')->nullable();
			$table->string('customer_rate_haul')->nullable();
			$table->string('line_haul1')->nullable();
			$table->string('carrier1')->nullable();
			$table->string('customer1')->nullable();
			$table->string('transportation1')->nullable();
			$table->string('line_haul2')->nullable();
			$table->string('carrier2')->nullable();
			$table->string('customer2')->nullable();
			$table->string('transportation2')->nullable();
			$table->string('line_haul3')->nullable();
			$table->string('carrier3')->nullable();
			$table->string('customer3')->nullable();
			$table->string('transportation3')->nullable();
			$table->string('line_haul4')->nullable();
			$table->string('carrier4')->nullable();
			$table->string('customer4')->nullable();
			$table->string('transportation4')->nullable();
			$table->string('line_haul5')->nullable();
			$table->string('carrier5')->nullable();
			$table->string('customer5')->nullable();
			$table->string('transportation5')->nullable();
			$table->string('line_haul6')->nullable();
			$table->string('carrier6')->nullable();
			$table->string('customer6')->nullable();
			$table->string('transportation6')->nullable();
			$table->string('line_haul7')->nullable();
			$table->string('carrier7')->nullable();
			$table->string('customer7')->nullable();
			$table->string('transportation7')->nullable();
			$table->string('line_haul8')->nullable();
			$table->string('carrier8')->nullable();
			$table->string('customer8')->nullable();
			$table->string('transportation8')->nullable();
			$table->string('carrier_total')->nullable();
			$table->string('customer_total')->nullable();
			
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
        Schema::dropIfExists('shipment_c_s_rates');
    }
};
