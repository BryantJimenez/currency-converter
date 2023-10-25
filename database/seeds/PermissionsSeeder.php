<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Permission to Access the Administrative Panel
        $permission=Permission::where('name', 'dashboard')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'dashboard']);
        }

        // User Permissions
        $permission=Permission::where('name', 'users.index')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'users.index']);
            Permission::create(['name' => 'users.create']);
            Permission::create(['name' => 'users.show']);
            Permission::create(['name' => 'users.edit']);
            Permission::create(['name' => 'users.delete']);
            Permission::create(['name' => 'users.active']);
            Permission::create(['name' => 'users.deactive']);
        }

        // Customer Permissions
        $permission=Permission::where('name', 'customers.index')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'customers.index']);
            Permission::create(['name' => 'customers.create']);
            Permission::create(['name' => 'customers.show']);
            Permission::create(['name' => 'customers.edit']);
            Permission::create(['name' => 'customers.delete']);
            Permission::create(['name' => 'customers.active']);
            Permission::create(['name' => 'customers.deactive']);
        }

        // Contact Permissions
        $permission=Permission::where('name', 'contacts.create')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'contacts.create']);
        }

        // Account Permissions
        $permission=Permission::where('name', 'accounts.create')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'accounts.create']);
            Permission::create(['name' => 'accounts.edit']);
        }

        // Quote Permissions
        $permission=Permission::where('name', 'quotes.index')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'quotes.index']);
            Permission::create(['name' => 'quotes.create']);
            Permission::create(['name' => 'quotes.show']);
            Permission::create(['name' => 'quotes.edit']);
            Permission::create(['name' => 'quotes.delete']);
            Permission::create(['name' => 'quotes.pdf.invoice']);
            Permission::create(['name' => 'quotes.input.state_payment']);
        }

        // Currency Permissions
        $permission=Permission::where('name', 'currencies.index')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'currencies.index']);
            Permission::create(['name' => 'currencies.create']);
            Permission::create(['name' => 'currencies.show']);
            Permission::create(['name' => 'currencies.edit']);
            Permission::create(['name' => 'currencies.delete']);
            Permission::create(['name' => 'currencies.active']);
            Permission::create(['name' => 'currencies.deactive']);
        }

        // Exchange Permissions
        $permission=Permission::where('name', 'exchanges.edit')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'exchanges.edit']);
        }

        // Role Permissions
        $permission=Permission::where('name', 'roles.index')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'roles.index']);
            Permission::create(['name' => 'roles.create']);
            Permission::create(['name' => 'roles.show']);
            Permission::create(['name' => 'roles.edit']);
            Permission::create(['name' => 'roles.delete']);
        }

        // Report Permissions
        $permission=Permission::where('name', 'reports.index')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'reports.index']);
        }

        // Setting Permissions
        $permission=Permission::where('name', 'settings.edit')->first();
        if (is_null($permission)) {
            Permission::create(['name' => 'settings.edit']);
        }
    }
}
