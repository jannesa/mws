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
    return view('index');
});

Route::get('login', function (){
    return view ('login');
});

Route::get('dashboard', function (){
    return view ('dashboard');
});

//UseController on Site guests
Route::get('guest', 'EventController@index');
Route::post('store', 'EventController@addSong');


Auth::routes();

Route::get('/home', 'UserHomeController@index')->name('home');
Route::get('/admin/home', 'AdminHomeController@index')->name('admin.home');

Route::get('/register/', 'Auth\RegisterAdminController@showRegistrationForm')
    ->name('admin.register.get');
Route::post('/register/', 'Auth\RegisterAdminController@register')
    ->name('admin.register.post');
