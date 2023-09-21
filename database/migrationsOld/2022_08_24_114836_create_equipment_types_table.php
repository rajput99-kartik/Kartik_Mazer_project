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
        Schema::create('equipment_types', function (Blueprint $table) {
            $table->id();
            $table->string('equipments_id');
            $table->string('equip_name')->nullable();
            $table->string('equip_type')->nullable();
            $table->string('spot_equip')->nullable();
            $table->string('pst_evrywre')->nullable();
            $table->string('ts_equip')->nullable();
            $table->string('cat_ts')->nullable();
            $table->string('ts_id')->nullable();
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
        Schema::dropIfExists('equipment_types');
    }
};
