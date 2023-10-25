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
    	$admin->givePermissionTo(['dashboard', 'users.index', 'users.create', 'users.show', 'users.edit', 'users.delete', 'users.active', 'users.deactive', 'customers.index', 'customers.create', 'customers.show', 'customers.edit', 'customers.delete', 'customers.active', 'customers.deactive', 'contacts.create', 'accounts.create', 'accounts.edit', 'quotes.index', 'quotes.create', 'quotes.show', 'quotes.pdf.invoice', 'currencies.index', 'currencies.create', 'currencies.show', 'currencies.edit', 'currencies.delete', 'currencies.active', 'currencies.deactive', 'exchanges.edit', 'roles.index', 'roles.create', 'roles.show', 'roles.edit', 'roles.delete', 'reports.index', 'settings.edit']);
    }
}