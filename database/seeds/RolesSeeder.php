<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$role=Role::where('name', 'Super Admin')->first();
    	if (is_null($role)) {
    		Role::create(['name' => 'Super Admin']);
    	}

    	$role=Role::where('name', 'Administrador')->first();
    	if (is_null($role)) {
    		Role::create(['name' => 'Administrador']);
    	}

    	$role=Role::where('name', 'Cliente')->first();
    	if (is_null($role)) {
    		Role::create(['name' => 'Cliente']);
    	}

    	$superadmin=Role::where('name', 'Super Admin')->first();
    	$superadmin->givePermissionTo(Permission::all());

    	$admin=Role::where('name', 'Administrador')->first();
    	$admin->givePermissionTo(Permission::all());
    }
}