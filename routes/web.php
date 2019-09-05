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
    return view('welcome.index');
})->name('test');

Route::post('wallet', 'WalletController@login')->name('wallet.login');

Route::middleware('authWallet')->group(function() {
    Route::get('wallet', 'WalletController@index')->name('wallet');
    Route::get('wallet/logout', 'WalletController@logout')->name('wallet.logout');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
