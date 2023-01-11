<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group([
    'middleware' => [
        'auth',
    ],
    'namespace'  => 'Admin',
], function () {
    Route::resource('/customer', 'Customers\CustomerCrudController');
    Route::get('/customers', 'Customers\CustomerCrudController@getData')->name('customer.list');
    Route::put('/customer/{id}', 'Customers\CustomerCrudController@update')->name('customer.update');
});
