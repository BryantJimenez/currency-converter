<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

///////////////////////////////////////// AUTH ////////////////////////////////////////////////
Auth::routes(['register' => false]);
Route::get('/usuarios/email/{slug?}', 'AdminController@emailVerifyAdmin');

////////////////////////////////////////// WEB ////////////////////////////////////////////////
Route::get('/', function() {
	return redirect()->route('admin');
});

///////////////////////////////////////// ADMIN ///////////////////////////////////////////////
Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin'], function () {
	// Home
	Route::get('/', 'AdminController@index')->name('admin');

	// Profile
	Route::prefix('perfil')->group(function () {
		Route::get('/', 'AdminController@profile')->name('profile');
		Route::get('/editar', 'AdminController@profileEdit')->name('profile.edit');
		Route::put('/', 'AdminController@profileUpdate')->name('profile.update');
	});

	// Users
	Route::prefix('usuarios')->group(function () {
		Route::get('/', 'UserController@index')->name('users.index')->middleware('permission:users.index');
		Route::get('/registrar', 'UserController@create')->name('users.create')->middleware('permission:users.create');
		Route::post('/', 'UserController@store')->name('users.store')->middleware('permission:users.create');
		Route::get('/{user:slug}', 'UserController@show')->name('users.show')->middleware('permission:users.show');
		Route::get('/{user:slug}/editar', 'UserController@edit')->name('users.edit')->middleware('permission:users.edit');
		Route::put('/{user:slug}', 'UserController@update')->name('users.update')->middleware('permission:users.edit');
		Route::delete('/{user:slug}', 'UserController@destroy')->name('users.delete')->middleware('permission:users.delete');
		Route::put('/{user:slug}/activar', 'UserController@activate')->name('users.activate')->middleware('permission:users.active');
		Route::put('/{user:slug}/desactivar', 'UserController@deactivate')->name('users.deactivate')->middleware('permission:users.deactive');
	});

	// Customers
	Route::prefix('clientes')->group(function () {
		Route::get('/', 'CustomerController@index')->name('customers.index')->middleware('permission:customers.index');
		Route::get('/registrar', 'CustomerController@create')->name('customers.create')->middleware('permission:customers.create');
		Route::post('/', 'CustomerController@store')->name('customers.store')->middleware('permission:customers.create');
		Route::get('/{user:slug}', 'CustomerController@show')->name('customers.show')->middleware('permission:customers.show');
		Route::get('/{user:slug}/editar', 'CustomerController@edit')->name('customers.edit')->middleware('permission:customers.edit');
		Route::put('/{user:slug}', 'CustomerController@update')->name('customers.update')->middleware('permission:customers.edit');
		Route::delete('/{user:slug}', 'CustomerController@destroy')->name('customers.delete')->middleware('permission:customers.delete');
		Route::put('/{user:slug}/activar', 'CustomerController@activate')->name('customers.activate')->middleware('permission:customers.active');
		Route::put('/{user:slug}/desactivar', 'CustomerController@deactivate')->name('customers.deactivate')->middleware('permission:customers.deactive');
		Route::post('/{user:slug}/contactos', 'CustomerController@storeContact')->name('customers.contacts.store')->middleware('permission:contacts.create');
		Route::post('/{user:slug}/cuentas', 'CustomerController@storeAccount')->name('customers.accounts.store')->middleware('permission:accounts.create');
		Route::put('/{user:slug}/cuentas/{account:slug}', 'CustomerController@updateAccount')->name('customers.accounts.update')->middleware('permission:accounts.edit');
		Route::get('/cuentas/obtener', 'CustomerController@getAccounts')->name('customers.accounts.get');
	});

	// Quotes
	Route::prefix('cotizaciones')->group(function () {
		Route::get('/', 'QuoteController@index')->name('quotes.index')->middleware('permission:quotes.index');
		Route::get('/registrar', 'QuoteController@create')->name('quotes.create')->middleware('permission:quotes.create');
		Route::post('/', 'QuoteController@store')->name('quotes.store')->middleware('permission:quotes.create');
		Route::get('/{quote:id}', 'QuoteController@show')->name('quotes.show')->middleware('permission:quotes.show');
		Route::get('/{quote:id}/editar', 'QuoteController@edit')->name('quotes.edit')->middleware('permission:quotes.edit');
		Route::put('/{quote:id}', 'QuoteController@update')->name('quotes.update')->middleware('permission:quotes.edit');
		Route::delete('/{quote:id}', 'QuoteController@destroy')->name('quotes.delete')->middleware('permission:quotes.delete');
		Route::get('/{quote:id}/pdf/factura', 'QuoteController@invoice')->name('quotes.pdf.invoice')->middleware('permission:quotes.pdf.invoice');
	});

	// Currencies
	Route::prefix('monedas')->group(function () {
		Route::get('/', 'CurrencyController@index')->name('currencies.index')->middleware('permission:currencies.index');
		Route::get('/registrar', 'CurrencyController@create')->name('currencies.create')->middleware('permission:currencies.create');
		Route::post('/', 'CurrencyController@store')->name('currencies.store')->middleware('permission:currencies.create');
		Route::get('/{currency:slug}', 'CurrencyController@show')->name('currencies.show')->middleware('permission:currencies.show');
		Route::get('/{currency:slug}/editar', 'CurrencyController@edit')->name('currencies.edit')->middleware('permission:currencies.edit');
		Route::put('/{currency:slug}', 'CurrencyController@update')->name('currencies.update')->middleware('permission:currencies.edit');
		Route::delete('/{currency:slug}', 'CurrencyController@destroy')->name('currencies.delete')->middleware('permission:currencies.delete');
		Route::put('/{currency:slug}/activar', 'CurrencyController@activate')->name('currencies.activate')->middleware('permission:currencies.active');
		Route::put('/{currency:slug}/desactivar', 'CurrencyController@deactivate')->name('currencies.deactivate')->middleware('permission:currencies.deactive');
		Route::get('/{currency:slug}/intercambios', 'CurrencyController@editExchanges')->name('currencies.exchanges.edit')->middleware('permission:exchanges.edit');
		Route::put('/{currency:slug}/intercambios', 'CurrencyController@updateExchanges')->name('currencies.exchanges.update')->middleware('permission:exchanges.edit');
	});

	// Roles
	Route::prefix('roles')->group(function () {
		Route::get('/', 'RoleController@index')->name('roles.index')->middleware('permission:roles.index');
		Route::get('/registrar', 'RoleController@create')->name('roles.create')->middleware('permission:roles.create');
		Route::post('/', 'RoleController@store')->name('roles.store')->middleware('permission:roles.create');
		Route::get('/{role:id}/editar', 'RoleController@edit')->name('roles.edit')->middleware('permission:roles.edit');
		Route::put('/{role:id}', 'RoleController@update')->name('roles.update')->middleware('permission:roles.edit');
		Route::delete('/{role:id}', 'RoleController@destroy')->name('roles.delete')->middleware('permission:roles.delete');
	});

	// Reports
	Route::prefix('reportes')->group(function () {
		Route::get('/', 'ReportController@index')->name('reports.index')->middleware('permission:reports.index');
		Route::post('/', 'ReportController@export')->name('reports.export')->middleware('permission:reports.index');
	});

	// Settings
	Route::prefix('ajustes')->group(function () {
		Route::get('/editar', 'SettingController@edit')->name('settings.edit')->middleware('permission:settings.edit');
		Route::put('/', 'SettingController@update')->name('settings.update')->middleware('permission:settings.edit');
	});
});