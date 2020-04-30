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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes([
    'register'  => false,
    'reset'     => false
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('dashboard', 'DashboardController@index');
    Route::resource('customers', 'CustomerController');
    Route::resource('services', 'ServicesController');
    Route::resource('domain-resellers', 'DomainResellerController');
    Route::get('domain-resellers/{id}/renew', 'DomainResellerRenewController@renew')->name('domain-resellers.renew');
    Route::post('domain-resellers/renew-store', 'DomainResellerRenewController@store')->name('domain-resellers.renew-store');
    Route::resource('hosting-resellers', 'HostingResellerController');
    Route::get('hosting-resellers/{id}/renew', 'HostigResellerRenewController@renew')->name('hosting-resellers.renew');
    Route::post('hosting-resellers/renew-store', 'HostigResellerRenewController@store')->name('hosting-resellers.renew-store');
    Route::resource('hosting-packages', 'HostingPackageController');
});
