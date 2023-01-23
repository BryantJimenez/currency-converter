<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->float('fixed_commission', 10, 2)->unsigned()->default(0.00);
            $table->float('percentage_commission', 10, 2)->unsigned()->default(0.00);
            $table->float('max_fixed_commission', 10, 2)->unsigned()->default(80000.00);
            $table->float('iva', 10, 2)->unsigned()->default(0.00);
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
        Schema::dropIfExists('settings');
    }
}
