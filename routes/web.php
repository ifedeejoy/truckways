<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
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

Route::get('users/home', 'HomeController@index')->name('users.home')->middleware('auth');
Route::get('users/loads', 'LoadsController@loads')->name('users.loads')->middleware('auth');
Route::get('users/active-loads', 'LoadsController@activeLoads')->name('users.active')->middleware('auth');
Route::get('users/post-load', 'LoadsController@create')->name('users.post')->middleware('auth');
Route::get('users/load/{id}', 'LoadsController@show')->middleware('auth');
Route::get('users/driver/{id}', 'UserController@showDriver')->middleware('auth');
Route::get('users/profile', 'UserController@show')->middleware('auth');
Route::get('users/active-load/{id}', 'LoadsController@showActive')->middleware('auth');
Route::post('users/create-load', 'LoadsController@store')->name('create-load')->middleware('auth');
Route::post('users/accept-bid/{id}', 'BidsController@update')->name('accept-bid')->middleware('auth');
Route::post('users/search', 'LoadsController@search')->name('search-load')->middleware('auth');
Route::view('users/trucks', 'users.trucks')->middleware('auth');
Route::view('users/payment-history', 'users.payment-history')->middleware('auth');

Route::get('drivers/home', 'HomeController@driversHome')->name('drivers.home')->middleware('auth:truck_drivers');
Route::get('drivers/register', '\App\Http\Controllers\Auth\RegisterController@showDriverReg');
Route::get('drivers/login', '\App\Http\Controllers\Auth\LoginController@showDriverLogin')->name('driver-login');
Route::get('drivers/load/{id}', 'LoadsController@show')->middleware('auth:truck_drivers');
Route::get('drivers/my-bids', 'BidsController@driverBids')->name('driver-bids')->middleware('auth:truck_drivers');
Route::get('drivers/trucks', 'TrucksController@index')->middleware('auth:truck_drivers');
Route::get('drivers/add-truck', 'TrucksController@create')->middleware('auth:truck_drivers');
Route::get('drivers/truck/{id}', 'TrucksController@show')->middleware('auth:truck_drivers');
Route::get('drivers/profile', 'DriversController@show')->name('driver-profile')->middleware('auth:truck_drivers');
Route::get('drivers/edit-profile', 'DriversController@edit')->middleware('auth:truck_drivers');
Route::view('drivers/loads', 'drivers.loads')->middleware('auth:truck_drivers');


Route::post('driver-login', '\App\Http\Controllers\Auth\LoginController@driverLogin')->name('login-driver');
Route::post('driver-register', '\App\Http\Controllers\Auth\RegisterController@driverRegister')->name('register-driver');
Route::post('drivers/send-bid/{id}', 'BidsController@store')->name('send-bid')->middleware('auth:truck_drivers');
Route::post('drivers/add-vehicle', 'TrucksController@store')->name('adds-vehicle')->middleware('auth:truck_drivers');
Route::post('drivers/delete-truck/{id}', 'TrucksController@destroy')->name('delete-truck')->middleware('auth:truck_drivers');
Route::post('drivers/edit-truck/{id}', 'TrucksController@update')->name('edit-truck')->middleware('auth:truck_drivers');
Route::post('drivers/edit-profile/{id}', 'DriversController@update')->name('driver-edit')->middleware('auth:truck_drivers');
Route::post('drivers/edit-profile/{id}', 'DriversController@update')->name('driver-edit')->middleware('auth:truck_drivers');
Route::post('drivers/request-verification/{id}', 'DriversController@requestVerification')->name('driver-verification')->middleware('auth:truck_drivers');
Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('isAdmin');


Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});