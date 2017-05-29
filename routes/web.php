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

Route::get('/', 'ProductController@getIndex')->name('home');

Route::post('/login', 'SessionController@store');
Route::get('/login','SessionController@create');

Route::get('/register','RegistrationController@create')->name('register');
Route::post('/register', 'RegistrationController@store')->name('register');

Route::get('/login','SessionController@create')->name('login');
Route::post('/login', 'SessionController@store')->name('login');

Route::get('user/profile', 'UserController@getProfile')->name('profile');