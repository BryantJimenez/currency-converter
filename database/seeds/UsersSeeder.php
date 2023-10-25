<?php

use App\Models\User;
use App\Models\Contact;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name' => 'Super',
            'lastname' => 'Admin',
            'photo' => 'usuario.png',
            'slug' => 'super-admin',
            'email' => 'admin@gmail.com',
            'phone' => '12345678',
            'password' => bcrypt('12345678'),
            'user_role' => 'Super Admin',
            'custom_permissions' => '0',
            'state' => '1'
        ]);

        $user=User::find(1);
        $role=Role::with(['permissions'])->where('name', 'Super Admin')->first();
        $user->givePermissionTo($role['permissions']->pluck('name'));

        $role=Role::with(['permissions'])->where('name', 'Cliente')->first();
        $customers=factory(User::class, 50)->create(['password' => NULL, 'user_role' => 'Cliente', 'custom_permissions' => '0']);
        foreach ($customers as $customer) {
            $customer->givePermissionTo($role['permissions']->pluck('name'));
        }

        foreach ($customers as $customer) {
            $contact=factory(Contact::class, 1)->create(['user_id' => $customer->id]);

            $exist=Contact::where([['user_id', $contact[0]->user_destination_id], ['user_destination_id', $customer->id]])->first();
            if (is_null($exist)) {
                factory(Contact::class, 1)->create(['user_id' => $contact[0]->user_destination_id, 'user_destination_id' => $customer->id]);
            }
        }
    }
}
