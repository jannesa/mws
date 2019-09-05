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
    return view ('/auth/login');
});

Route::get('dashboard', function (){
    return view ('dashboard');
});

//UseController on Site guests
Route::get('guest', 'EventController@index');
Route::post('store', 'EventController@addSong');




Route::get('/auth/user-dashboard', 'UserHomeController@index')->name('user.dashboard');

Route::get('/auth/register/', 'Auth\RegisterUserController@showRegistrationForm')->name('user.auth.register');

Route::post('/auth/register/', 'Auth\RegisterUserController@register')->name('user.register.post');

Route::get('/auth/login/', 'Auth\LoginUserController@showLoginForm')->name('user.auth.login');

Route::post('/auth/login/', 'Auth\LoginUserController@login')->name('user.login.submit');

Route::get('/logout', 'Auth\LoginUserController@logout')->name('user.logout');



# Route::get('/admin/home', 'AdminHomeController@index')->name('admin.home');

# Route::get('/register/', 'Auth\RegisterAdminController@showRegistrationForm')
#    ->name('admin.register.get');

# Route::post('/register/', 'Auth\RegisterAdminController@register')
#    ->name('admin.register.post');
