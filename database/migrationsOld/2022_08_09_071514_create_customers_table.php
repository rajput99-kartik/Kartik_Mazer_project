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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('organization_name');
            $table->string('short_code');
            $table->text('address');
            $table->text('address_permanent');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('postal');
            $table->string('quote');
            $table->string('billing_option');
            $table->string('user_id');
            $table->string('role');
            $table->boolean('is_active')->default(0);
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
        Schema::dropIfExists('customers');
    }
};
