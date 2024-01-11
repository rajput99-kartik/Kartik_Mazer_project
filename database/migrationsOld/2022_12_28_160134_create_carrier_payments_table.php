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
        Schema::create('carrier_payments', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_id')->unique();
            $table->string('carrier_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('accountant_id')->nullable();
            $table->string('accountant_name')->nullable();
            $table->string('carrier_name')->nullable();
            $table->string('carrier_mc')->nullable();
            $table->string('carrier_dot')->nullable();
            $table->string('carrier_phone')->nullable();
            $table->string('carrier_email')->nullable();
            $table->string('pay_to')->nullable();
            $table->string('routing')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('carrier_payment')->nullable();
            $table->string('invoice_doc')->nullable();
            $table->string('invoice_date')->nullable();
            $table->string('aging_date')->nullable();
            $table->string('aging_day')->nullable();
            $table->string('efs_advance')->nullable();
            $table->string('efs_date')->nullable();
            $table->string('quickpay_precent')->nullable();
            $table->string('quickpay_amount')->nullable();
            $table->string('quickpay_date')->nullable();
            $table->string('highlight_date')->nullable();
            $table->string('highlight_status')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('m_status')->nullable();
            $table->string('m_date')->nullable();
            $table->string('p_status')->nullable();
            $table->string('p_date')->nullable();
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
        Schema::dropIfExists('carrier_payments');
    }
};
