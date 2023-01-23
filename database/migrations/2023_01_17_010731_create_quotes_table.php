<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->float('amount', 10, 2)->unsigned()->default(0.00);
            $table->float('commission', 10, 2)->unsigned()->default(0.00);
            $table->float('iva', 10, 2)->unsigned()->default(0.00);
            $table->float('total', 10, 2)->unsigned()->default(0.00);
            $table->float('amount_destination', 10, 2)->unsigned()->default(0.00);
            $table->float('conversion_rate', 10, 4)->unsigned()->defaut(0.0000);
            $table->enum('type_operation', [1, 2, 3])->default(1);
            $table->enum('type_commission', [1, 2])->default(1);
            $table->float('value_commission', 10, 2)->unsigned()->default(0.00);
            $table->float('iva_percentage', 10, 2)->unsigned()->default(0.00);
            $table->text('reason')->nullable();
            $table->bigInteger('customer_source_id')->unsigned()->nullable();
            $table->bigInteger('customer_destination_id')->unsigned()->nullable();
            $table->bigInteger('account_destination_id')->unsigned()->nullable();
            $table->bigInteger('currency_source_id')->unsigned()->nullable();
            $table->bigInteger('currency_destination_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();

            #Relations
            $table->foreign('customer_source_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('customer_destination_id')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('account_destination_id')->references('id')->on('accounts')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('currency_source_id')->references('id')->on('currencies')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('currency_destination_id')->references('id')->on('currencies')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotes');
    }
}
