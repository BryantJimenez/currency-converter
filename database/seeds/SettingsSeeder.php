<?php

use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [
    		['fixed_commission' => 2000.00, 'percentage_commission' => 2.5, 'iva' => 19]
    	];
    	DB::table('settings')->insert($settings);
    }
}
