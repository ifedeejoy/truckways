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
Route::view('drivers', 'drivers');
Route::view('contact-us', 'contact');

Auth::routes(['verify' => true]);

Route::get('users/home', 'HomeController@index')->name('users.home');
Route::get('users/loads', 'LoadsController@loads')->name('users.loads');
Route::view('users/active-loads', 'users.active-loads')->middleware('auth');
Route::view('users/post-load', 'users.post-load')->middleware('auth');

Route::resource('loads', 'LoadsController')->except([
    'create', 'store', 'update', 'destroy'
]);

Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('isAdmin');
