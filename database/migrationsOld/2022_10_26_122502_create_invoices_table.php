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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('shipment_id')->nullable();
            $table->string('companies_id')->nullable();
            $table->string('user_id')->nullable();
            $table->string('document_name')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('customer_name')->nullable();
            $table->string('invoice_amt')->nullable();
            $table->string('balance_due')->nullable();
            $table->string('amount_paid')->nullable();
            $table->string('check_number')->nullable();
            $table->string('check_date')->nullable();
            $table->string('date_received')->nullable();
            $table->string('pay_mode')->nullable();
            $table->string('deposit_date')->nullable();
            $table->string('pay_status')->nullable();
            $table->string('invoice_status')->nullable();
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
        Schema::dropIfExists('invoices');
    }
};
