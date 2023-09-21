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
        Schema::create('shipment', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('loads_id')->nullable();
            $table->string('carrier_id')->nullable();
            $table->string('companies_id')->nullable();
            $table->string('shipment_statue')->nullable();
            $table->string('ref_loads')->nullable();
            $table->string('equipment_loads')->nullable();
            $table->string('full_partial')->nullable();
            $table->string('mode')->nullable();
            $table->string('payment_mode')->nullable();
            $table->string('weight_loads')->nullable();
            $table->string('declared_loads')->nullable();
            $table->string('footage_loads')->nullable();
            $table->string('temp_min')->nullable();
            $table->string('temp_max')->nullable();
            $table->string('temp_precool')->nullable();
            $table->string('temp_precool_val')->nullable();
            $table->string('commodity_laod')->nullable();
            $table->string('pieces_laod')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('customer_address')->nullable();
            $table->string('customer_city')->nullable();
            $table->string('customer_state')->nullable();
            $table->string('customer_zip')->nullable();
            $table->string('customer_phone')->nullable();
            $table->string('customer_c_name')->nullable();
            $table->string('customer_fax')->nullable();
            $table->string('b_customer_name')->nullable();
            $table->string('b_customer_address')->nullable();
            $table->string('b_customer_city')->nullable();
            $table->string('b_customer_state')->nullable();
            $table->string('b_customer_zip')->nullable();
            $table->string('b_customer_phone')->nullable();
            $table->string('b_customer_c_name')->nullable();
            $table->string('b_customer_fax')->nullable();
            $table->string('shipment_carrier_instruction')->nullable();
            $table->string('shipment_shipper_instruction')->nullable();
            $table->string('shipment_c_mc')->nullable();
            $table->string('shipment_c_dot')->nullable();
            $table->string('shipment_c_carrier')->nullable();
            $table->string('shipment_c_dispatcher')->nullable();
            $table->string('shipment_c_phone')->nullable();
            $table->string('shipment_c_email')->nullable();
            $table->string('shipment_c_driver_n')->nullable();
            $table->string('shipment_c_driver_p')->nullable();
            $table->string('payment_status_ar')->nullable();
            $table->string('payment_status')->nullable();
            $table->string('ap_team')->nullable();
            $table->string('ar_invoice')->nullable();
            $table->string('tonu_status')->nullable();
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
        Schema::dropIfExists('shipment');
    }
};
