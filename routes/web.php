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
    return redirect('login');
});

Auth::routes();

Route::resource('purchase', 'PurchaseController');
Route::get('/home', 'PurchaseController@index')->name('home');

Route::resource('email', 'EmailController');

Route::get('/profile', 'UserController@profile')->name('profile');

Route::put('/update', 'UserController@update')->name('updateUserInfo');
Route::post('/changeDefaultEmail', 'EmailController@changeDefaultEmail')->name('changeDefaultEmail');
