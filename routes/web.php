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

Route::get('events', function (){
    return view ('events');
});

Route::get('events_erstellen', function (){
    return view ('events_erstellen');
});

