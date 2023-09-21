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
        Schema::create('carrier', function (Blueprint $table) {
            $table->id();
            $table->string('user_id')->nullable();
            $table->string('c_company_name')->nullable();
            $table->string('carrier_comment')->nullable();
            $table->string('carrier_rating')->nullable();
            $table->string('carrier_country')->nullable();
            $table->string('nsc_no')->nullable();
            $table->string('mc_no')->nullable();
            $table->string('dot_no')->nullable();
            $table->string('carrier_city')->nullable();
            $table->string('carrier_city_main')->nullable();
            $table->string('carrier_fax')->nullable();
            $table->string('carrier_state')->nullable();
            $table->string('carrier_zip')->nullable();
            $table->string('equipments')->nullable();
            $table->string('carrier_rates')->nullable();
            $table->string('phone_no')->nullable();
            $table->string('email')->nullable();
            $table->string('cargo')->nullable();
            $table->string('cargo_amount')->nullable();
            $table->string('cargo_expires')->nullable();
            $table->string('cargo_deduct')->nullable();
            $table->string('cargo_deduct_amount')->nullable();
            $table->string('cargo_deduct_expires')->nullable();
            $table->string('liability')->nullable();
            $table->string('liability_amount')->nullable();
            $table->string('liability_expires')->nullable();
            $table->string('trailer_amount')->nullable();
            $table->string('trailer_expires')->nullable();
            $table->string('reefer_bkdn')->nullable();
            $table->string('reefer_brk_deduct')->nullable();
            $table->string('d_name')->nullable();
            $table->string('d_phone')->nullable();
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
        Schema::dropIfExists('carrier');
    }
};
