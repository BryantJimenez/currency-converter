<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatePaymentToQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->float('conversion_rate', 10, 6)->unsigned()->defaut(0.000000)->change();
            $table->enum('state_payment', [1, 2, 3])->default(1)->nullable()->after('reason');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('quotes', function (Blueprint $table) {
            $table->float('conversion_rate', 10, 4)->unsigned()->defaut(0.0000)->change();
            $table->dropColumn(['state_payment']);
        });
    }
}
