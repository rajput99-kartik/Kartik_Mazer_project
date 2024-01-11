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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('user_type')->nullable();
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('shipper_state')->nullable();
            $table->string('shipper_city')->nullable();
            $table->string('shipper_zipcode')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('email')->nullable();
            $table->string('commodity')->nullable();
            $table->string('company_date')->nullable();
            $table->string('equipments')->nullable();
            $table->string('temprature')->nullable();
            $table->string('special_instructions')->nullable();
            $table->string('company_comment')->nullable();
            $table->string('acc_email')->nullable();
            $table->string('acc_name')->nullable();
            $table->string('acc_phone')->nullable();
            $table->string('credit_limit')->nullable();
            $table->string('un_secured_limit')->nullable();
            $table->string('trimph_limit')->nullable();
            $table->enum('status',['active','inactive'])->nullable();
            $table->string('assign_status')->nullable();            
            $table->enum('approved',['0','1','2'])->nullable();
            $table->dateTime('deleted_at')->nullable();
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
        Schema::dropIfExists('companies');
    }
};
