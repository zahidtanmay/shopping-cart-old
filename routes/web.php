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

Route::get('/logout', 'SessionController@destroy')->middleware('auth')->name('logout');
Route::get('/user/profile', 'UserController@getProfile')->middleware('auth')->name('profile');



Route::get('/', 'ProductController@getIndex')->name('home');
Route::get('/add-to-cart/{id}', 'ProductController@addToCart')->name('addToCart');
Route::get('/shopping-cart', 'ProductController@getCart')->name('shoppingCart');
Route::get('/reduce-by-one/{id}','ProductController@reduceByone')->name('reduceByone');
Route::get('/reduce-by-all','ProductController@reduceAll')->name('reduceAll');

Route::get('/checkout', 'ProductController@getCheckout')->middleware('auth')->name('checkout');
Route::post('/checkout', 'ProductController@postCheckout')->middleware('auth')->name('checkout');


Route::get('/register','RegistrationController@create')->middleware('guest')->name('register');
Route::post('/register', 'RegistrationController@store')->middleware('guest')->name('register');

Route::get('/login','SessionController@create')->middleware('guest')->name('login');
Route::post('/login', 'SessionController@store')->middleware('guest')->name('login');
