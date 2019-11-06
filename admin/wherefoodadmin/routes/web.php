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

Route::get('/',"MainController@Main")
->name('index')
->middleware('checkauthen');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', "LoginController@login")
->name('loginpost');
