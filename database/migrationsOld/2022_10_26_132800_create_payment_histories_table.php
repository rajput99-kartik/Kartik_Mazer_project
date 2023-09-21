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
        Schema::create('payment_histories', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_id')->nullable();
            $table->string('invoice_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('payment_date')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('invoice_amt')->nullable();
            $table->string('balance_due')->nullable();
            $table->string('amount_paid')->nullable();
            $table->string('check_number')->nullable();
            $table->string('check_date')->nullable();
            $table->string('date_received')->nullable();
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
        Schema::dropIfExists('payment_histories');
    }
};
