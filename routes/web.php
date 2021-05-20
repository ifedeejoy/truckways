<?php

use App\Mail\DriverWelcome;
use App\Mail\WelcomeDriver;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
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
Route::view('welcome-driver', 'emails.drivers.welcome');
Route::view('bids', 'emails.notifications.bids');

Route::get('continue-registration', 'UserController@showReg')->name('continue-reg');

Route::post('post-load', 'UserController@index')->name('post-load');
Route::post('finish-post', 'UserController@create')->name('finish-post');

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
Route::get('drivers/earnings', 'DriversController@earnings')->middleware('auth:truck_drivers');
Route::get('drivers/journey-history', 'DriversController@history')->middleware('auth:truck_drivers');

Route::view('drivers/loads', 'drivers.loads')->middleware('auth:truck_drivers');

Route::post('driver-login', '\App\Http\Controllers\Auth\LoginController@driverLogin')->name('login-driver');
Route::post('driver-register', '\App\Http\Controllers\Auth\RegisterController@driverRegister')->name('register-driver');
Route::post('drivers/send-bid/{id}', 'BidsController@store')->name('send-bid')->middleware('auth:truck_drivers');
Route::post('drivers/add-vehicle', 'TrucksController@store')->name('adds-vehicle')->middleware('auth:truck_drivers');
Route::post('drivers/delete-truck/{id}', 'TrucksController@destroy')->name('delete-truck')->middleware('auth:truck_drivers');
Route::post('drivers/edit-truck/{id}', 'TrucksController@update')->name('edit-truck')->middleware('auth:truck_drivers');
Route::post('drivers/edit-profile/{id}', 'DriversController@update')->name('driver-edit')->middleware('auth:truck_drivers');
Route::post('drivers/request-verification/{id}', 'DriversController@requestVerification')->name('driver-verification')->middleware('auth:truck_drivers');
Route::post('drivers/update-journey/{id}', 'JourneyController@store')->name('driver-journey')->middleware('auth:truck_drivers');

Route::get('admin/home', 'HomeController@adminHome')->name('admin.home')->middleware('isAdmin');
Route::get('admin/analytics', 'AdminController@index')->middleware('isAdmin');
Route::get('admin/applications', 'AdminController@driverApplications')->middleware('isAdmin');
Route::get('admin/driver/{id}', 'AdminController@showDriver')->middleware('isAdmin');
Route::get('admin/agent/{id}', 'AdminController@showAgent')->middleware('isAdmin');
Route::get('admin/admins', 'AdminController@showAdmins')->middleware('isAdmin');
Route::get('admin/users', 'AdminController@showUsers')->middleware('isAdmin');
Route::get('admin/user/{id}', 'UserController@show')->middleware('isAdmin');
Route::get('admin/trucks', 'TruckController@showTrucks')->middleware('isAdmin');
Route::get('admin/trips', 'AdminController@showTrips')->middleware('isAdmin');
Route::get('admin/load/{id}', 'LoadsController@show')->middleware('isAdmin');
Route::get('admin/active/{id}', 'LoadsController@showActive')->middleware('isAdmin');

Route::post('admin/verify-driver/{id}', 'AdminController@update')->name('verify-driver')->middleware('isAdmin');
Route::post('admin/create-admin', 'AdminController@store')->name('create-admin')->middleware('isAdmin');
Route::post('admin/delete-admin/{id}', 'AdminController@destroy')->name('delete-admin')->middleware('isAdmin');
Route::post('admin/delete-user/{id}', 'UserController@destroy')->name('delete-user')->middleware('isAdmin');
Route::post('admin/delete-driver/{id}', 'DriversController@destroy')->name('delete-driver')->middleware('isAdmin');
Route::post('admin/send-bid/{id}', 'BidsController@store')->name('admin-bid')->middleware('isAdmin');
Route::post('admin/update-journey', 'JourneyController@store')->name('update-journey')->middleware('isAdmin');

Route::get('agents/register', '\App\Http\Controllers\Auth\RegisterController@agentReg');
Route::get('agents/home', 'HomeController@agentsHome')->name('agents.home')->middleware('isAgent');
Route::get('agents/analytics', 'AgentController@index')->middleware('isAgent');
Route::get('agents/users', 'AgentController@showUsers')->middleware('isAgent');
Route::get('agents/user/{id}', 'UserController@show')->middleware('isAgent');
Route::get('agents/drivers', 'AgentController@showDrivers')->middleware('isAgent');
Route::get('agents/bids', 'AgentController@showBids')->middleware('isAgent');
Route::get('agents/trips', 'AgentController@showTrips')->middleware('isAgent');
Route::get('agents/load/{id}', 'LoadsController@show')->middleware('isAgent');
Route::get('agents/active/{id}', 'LoadsController@showActive')->middleware('isAgent');
Route::get('agents/driver/{id}', 'AgentController@showDriver')->middleware('isAgent');
Route::get('agents/profile', 'AgentController@show')->middleware('auth');
Route::get('agents/edit-profile', 'AgentController@edit')->middleware('isAgent');

Route::view('agents/loads', 'agents.loads')->middleware('isAgent');

Route::post('agent-register', '\App\Http\Controllers\Auth\RegisterController@agentRegister')->name('agent-register');
Route::post('agents/create-user', 'AgentController@createUsers')->name('create-user')->middleware('isAgent');
Route::post('agents/create-driver', 'AgentController@createDrivers')->name('create-driver')->middleware('isAgent');
Route::post('agents/send-bid/{id}', 'AgentController@sendBid')->name('agent-bid')->middleware('isAgent');
Route::post('agents/edit-profile/{id}', 'AgentController@update')->name('agent-edit')->middleware('isAgent');

Route::get('/pay/call-back', 'PaymentController@verifyTransaction')->name('payment-callback');

Route::get('/command',function(){
    Artisan::call('storage:link');
});

Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
});
