<?php

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

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes([
    'register'  => false,
    'reset'     => false
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('dashboard', 'DashboardController@index');
    Route::resource('customers', 'CustomerController');
    Route::resource('services', 'ServicesController');
    Route::Resource('service-types', 'ServiceTypeControler');
    Route::post('service-types-destroy', 'ServiceTypeControler@destroy')->name('service-types-destroy');
    Route::resource('domain-resellers', 'DomainResellerController');
    Route::post('domain-resellers-destroy', 'DomainResellerController@destroy')->name('domain-resellers-destroy');
    Route::get('domain-reseller/{id}/renew', 'DomainResellerRenewController@renew')->name('domain-reseller.renew');
    Route::post('domain-reseller/renew-store', 'DomainResellerRenewController@store')->name('domain-reseller.renew-store');
    Route::delete('domain-reseller', 'DomainResellerRenewController@destroy')->name('domain-reseller.destroy');
    Route::resource('hosting-resellers', 'HostingResellerController');
    Route::post('hosting-resellers-destroy', 'HostingResellerController@destroy')->name('hosting-resellers-destroy');
    Route::get('hosting-reseller/{id}/renew', 'HostigResellerRenewController@renew')->name('hosting-reseller.renew');
    Route::post('hosting-reseller/renew-store', 'HostigResellerRenewController@store')->name('hosting-reseller.renew-store');
    Route::delete('hosting-reseller', 'HostigResellerRenewController@destroy')->name('hosting-reseller.destroy');
    Route::resource('hosting-packages', 'HostingPackageController');
    Route::get('invoices', 'InvoiceControler@index')->name('invoices');
    Route::get('invoices/{id}/create', 'InvoiceControler@create')->name('invoices.create');
    Route::post('invoices', 'InvoiceControler@store')->name('invoices.store');
    Route::get('invoices/{id}/download', 'InvoiceControler@generateInvoicePdf')->name('invoices.download');
});
