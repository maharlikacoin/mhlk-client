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
})->name('welcome');

Route::post('contact-us', 'WelcomeController@contactUs')->name('contact-us');

Route::get('about-us', function() {
    return view('us');
})->name('about-us');

Route::get('terms-and-conditions', function() {
    return view('terms');
})->name('terms');

Route::get('privacy-policy', function() {
    return view('privacy');
})->name('privacy');

Route::get('project-legacy', function() {
    return view('dossier');
})->name('project.legacy');

Route::get('dossier', function() {
    return response()->file(storage_path('app/documents/dossier.pdf'));
})->name('dossier');


Route::post('wallet', 'WalletController@login')->name('wallet.login');

Route::middleware('authWallet')->group(function() {
    Route::get('wallet', 'WalletController@index')->name('wallet');
    Route::get('wallet/session', 'WalletController@wallet')->name('wallet.session');
    Route::get('wallet/contract', 'WalletController@contract')->name('wallet.contract');
    Route::get('wallet/logout', 'WalletController@logout')->name('wallet.logout');

    Route::get('team', function() {
        return view('team');
    })->name('team');

    Route::get('paper', function() {
        return response()->file(storage_path('app/documents/whitepaper.pdf'));
    })->name('paper');

    Route::get('whitepaper', function() {
        return view('whitepaper');
    })->name('whitepaper');
});

Route::get('/home', 'HomeController@index')->name('home');
