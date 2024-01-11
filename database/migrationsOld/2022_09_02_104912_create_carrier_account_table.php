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
        Schema::create('carrier_account', function (Blueprint $table) {
            $table->id();
			$table->string('carrier_id')->nullable();
			$table->string('payto')->nullable();
			$table->string('f_noa')->nullable();
			$table->string('f_comp_name')->nullable();
			$table->string('f_address')->nullable();
			$table->string('f_city')->nullable();
			$table->string('f_state')->nullable();
			$table->string('f_zip')->nullable();
			$table->string('f_phone')->nullable();
			$table->string('f_fax')->nullable();
			$table->string('f_email')->nullable();
			$table->string('c_comp_name')->nullable();
			$table->string('c_address')->nullable();
			$table->string('c_city')->nullable();
			$table->string('c_state')->nullable();
			$table->string('c_zip')->nullable();
			$table->string('c_phone')->nullable();
			$table->string('c_fax')->nullable();
			$table->string('c_email')->nullable();
			$table->string('a_comp_name')->nullable();
			$table->string('bank_name')->nullable();
			$table->string('account_number')->nullable();
			$table->string('b_account_type')->nullable();
			$table->string('ach_routing_number')->nullable();
			$table->string('routing_number')->nullable();
			$table->string('ach_b_country')->nullable();
			$table->string('a_address')->nullable();
			$table->string('a_city')->nullable();
			$table->string('a_state')->nullable();
			$table->string('a_zip')->nullable();
			$table->string('w_bank_name')->nullable();
			$table->string('w_account_number')->nullable();
			$table->string('wire_b_account_type')->nullable();
			$table->string('wire_routing_number')->nullable();
			$table->string('swift_code')->nullable();
			$table->string('wire_b_country')->nullable();
			$table->string('payment_mode')->nullable();
			$table->string('cc_comment')->nullable();
			$table->string('primery_method')->nullable();
			$table->string('w9_id')->nullable();
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
        Schema::dropIfExists('carrier_account');
    }
};
