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

//Events
Route::get('events', 'EventController@showAllEvents');
Route::get('events_erstellen', 'EventController@openEventsPage');
Route::post('speichern', 'EventController@addEvent');
Route::post('events_bearbeiten', 'EventController@editEvent')->name('event.bearbeiten');
Route::post('events_loeschen', 'EventController@delete')->name('event.loeschen');


//Songs
Route::post('songs_aendern', 'EventController@editSongStatus')->name('song.aendern');
Route::post('songs_loeschen', 'EventController@deleteSong')->name('song.loeschen');

Route::get('songs/{link_hash}', 'EventController@showSongs');


//Guests
Route::get('guest/{link_hash}', 'GuestController@index');
#Route::post('store/', 'GuestController@addSong');
Route::post('guest/{link_hash}', 'GuestController@addSong');


//User authentication
Route::get('/auth/register/', 'Auth\RegisterUserController@showRegistrationForm')->name('user.auth.register');
Route::post('/auth/register/', 'Auth\RegisterUserController@register')->name('user.register.post');

Route::get('/auth/login/', 'Auth\LoginUserController@showLoginForm')->name('user.auth.login');
Route::post('/auth/login/', 'Auth\LoginUserController@login')->name('user.login.submit');

Route::get('/logout', 'Auth\LoginUserController@logout')->name('user.logout');

Route::get('/auth/user-dashboard', 'UserHomeController@index')->name('user.dashboard');

//Admin authetication
Route::get('/auth/admin-register', 'Auth\RegisterAdminController@showRegistrationForm')->name('admin.register.get');
Route::post('/auth/admin-register', 'Auth\RegisterAdminController@register')->name('admin.register.post');

Route::get('/auth/admin-login', 'Auth\LoginAdminController@showLoginForm')->name('admin.auth.login');
Route::post('/auth/admin-login', 'Auth\LoginAdminController@login')->name('admin.login.submit');

Route::get('/admin-logout', 'Auth\LoginAdminController@logout')->name('admin.logout');

Route::get('/auth/admin-dashboard', 'AdminHomeController@index')->name('admin.dashboard');


Route::post('/auth/admin-dashboard','AdminHomeController@deleteUser')->name('admin.delete.user');


// Password Reset

Route::post('auth/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('auth.password.email');

Route::get('auth/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('auth.password.reset');


Route::get('auth/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset.token');

Route::post('auth/password/reset', 'Auth\ResetPasswordController@reset')->name('password.reset');


//PDF Export
Route::post('/dynamic_pdf/pdf', 'DynamicPDFController@pdf')->name('pdf.erstellen');


// User Daten ändern

Route::post('/auth/user/edit', "UserHomeController@editUserData")->name('auth.user.edit');


