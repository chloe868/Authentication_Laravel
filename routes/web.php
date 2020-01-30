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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::post('login', 'LoginController@login')->name('login');

// Route::get('logout', 'HomeController@logout')->name('logout');
// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();
// Route::get('/login', 'Auth\LoginController@showLoginForm');
// Route::get('/home', 'HomeController@index')->name('home');
// Route::view('/home', 'home')->middleware('auth');

Route::view('/', 'welcome');
Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');

Route::view('/home', 'home')->middleware('auth');
Route::view('/admin', 'admin');