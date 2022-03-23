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
    Route::post('cusomter-delete', 'CustomerController@destroy');
    Route::resource('services', 'ServicesController');
    Route::post('services-filter', 'ServicesController@filterServices')->name('services-filter');
    Route::get('services/{service}/renew', 'ServicesController@renewService')->name('services.renew');
    Route::post('services-renewal', 'ServicesController@renewalService')->name('services_renewal');
    Route::get('services-expire-soon', 'ServicesController@expireSoonServices')->name('services-expire-soon');
    Route::get('services-expired', 'ServicesController@expiredServices')->name('services-expired');
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
    Route::post('hosting-package-delete', 'HostingPackageController@destroy')->name('hosting-package-delete');
    Route::get('invoices', 'InvoiceControler@index')->name('invoices');
    Route::get('invoices/{id}/create', 'InvoiceControler@create')->name('invoices.create');
    Route::get('invoices/{invoice_number}/renew', 'InvoiceControler@renew')->name('invoices.renew');
    Route::post('invoices', 'InvoiceControler@store')->name('invoices.store');
    Route::post('invoices-update', 'InvoiceControler@update')->name('invoices.update');
    Route::get('invoices/{invoice_number}/download', 'InvoiceControler@generateInvoicePdf')->name('invoices.download');
    Route::get('profile', 'ProfileController@profile')->name('profile');
    Route::post('update-password', 'ProfileController@updatePassword')->name('update_password');
    Route::resource('payments', 'PaymentController');
    Route::get('payments/{invoiceNo}/invoice', 'PaymentController@invoicePayment')->name('payment-invoice');
    Route::post('payments-store', 'PaymentController@storePayment')->name('payments.store');
    Route::resource('expenses', 'ExpensesController');
    Route::resource('email-templates', 'EmailTemplateController');
    Route::post('email-template-delete', 'EmailTemplateController@destroy')->name('email-template-delete');
});
