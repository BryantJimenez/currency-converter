<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->float('conversion_rate', 10, 2)->unsigned()->defaut(0.00);
            $table->bigInteger('currency_id')->unsigned()->nullable();
            $table->bigInteger('currency_exchange_id')->unsigned()->nullable();
            $table->timestamps();

            #Relations
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('currency_exchange_id')->references('id')->on('currencies')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exchanges');
    }
}
