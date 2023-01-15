<?php

use App\Models\User;
use App\Models\Account;
use Illuminate\Database\Seeder;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users=User::role(['Cliente'])->get();
        foreach ($users as $user) {
        	factory(Account::class, 1)->create(['state' => '1', 'user_id' => $user->id]);
        }
    }
}
