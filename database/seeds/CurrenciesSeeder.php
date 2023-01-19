<?php

use App\Models\Currency\Currency;
use App\Models\Currency\Exchange;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currencies = [
            ['name' => 'Peso Chileno', 'slug' => 'peso-chileno', 'iso' => 'CLP', 'symbol' => '$', 'side' => '2', 'state' => '1'],
    		['name' => 'Bolivares Soberanos', 'slug' => 'bolivares-soberanos', 'iso' => 'VES', 'symbol' => 'BsS', 'side' => '1', 'state' => '1'],
            ['name' => 'Sol Peruano', 'slug' => 'sol-peruano', 'iso' => 'PEN', 'symbol' => 'S/', 'side' => '2', 'state' => '1'],
            ['name' => 'Boliviano', 'slug' => 'boliviano', 'iso' => 'BOB', 'symbol' => 'Bs', 'side' => '1', 'state' => '1']
    	];
    	DB::table('currencies')->insert($currencies);

        $currencies=Currency::all();
        foreach ($currencies as $currency) {
            foreach ($currencies as $key => $value) {
                if ($currency->id!=$value->id) {
                    factory(Exchange::class, 1)->create(['currency_id' => $currency->id, 'currency_exchange_id' => $value->id]);
                }
            }
        }
    }
}
