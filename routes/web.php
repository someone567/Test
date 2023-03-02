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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/plist', 'ProductController@list')->name('plist');

/*
Route::get('/register', 'ProductController@register')->name('register');
*/
Route::get('/pregister', 'ProductController@showRegistForm')->name('pregister');
Route::post('/pregister', 'ProductController@registSubmit')->name('submit');

Route::get('/products/{id}', 'ProductController@show')->name('detail');