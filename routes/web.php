<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::view('/', 'welcome');
Route::view('find-truck', 'find-truck');
Route::view('market-place', 'market-place');
Route::view('contact-us', 'contact');

Auth::routes(['verify' => true]);

Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('users/home', 'HomeController@index')->name('users.home');
Route::get('users/loads', 'LoadsController@loads')->name('users.loads');
Route::get('users/active-loads', 'LoadsController@activeLoads')->name('users.active');
Route::get('users/post-load', 'LoadsController@create')->name('users.post');
Route::post('users/create-load', 'LoadsController@store')->name('create-load');
Route::get('users/load/{id}', 'LoadsController@show');

Route::get('drivers/home', 'HomeController@driversHome')->name('drivers.home');
Route::get('drivers/register', '\App\Http\Controllers\Auth\RegisterController@showDriverReg');
Route::get('drivers/login', '\App\Http\Controllers\Auth\LoginController@showDriverLogin');
Route::get('drivers/load/{id}', 'LoadsController@show');
Route::view('drivers/loads', 'drivers.loads');


Route::post('driver-login', '\App\Http\Controllers\Auth\LoginController@driverLogin')->name('login-driver');
Route::post('driver-register', '\App\Http\Controllers\Auth\RegisterController@driverRegister')->name('register-driver');


Route::resource('loads', 'LoadsController')->except([
    'create', 'store', 'update', 'destroy'
]);

Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('isAdmin');