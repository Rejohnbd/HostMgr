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
    return view('welcome');
});

Auth::routes();
Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('dashboard', 'DashboardController@index');
    Route::resource('customers', 'CustomerController');
    Route::resource('hosting-packages', 'HostingPackageController');
    Route::resource('domain-resellers', 'DomainResellerController');
    Route::resource('hosting-resellers', 'HostingResellerController');
});
