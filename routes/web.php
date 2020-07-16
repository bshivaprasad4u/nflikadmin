<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});



//Route::get('/home', 'HomeController@index')->name('home');
Route::view('forgot_password', 'auth.passwords.reset')->name('password.reset');


// admin routes
Route::group(['prefix' => 'admin'], function () {
    // Authentication Routes...
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\Auth\LoginController@login');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');

    // Registration Routes...
    Route::get('register', 'Admin\Auth\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('register', 'Admin\Auth\RegisterController@register')->name('admin.register');

    // Password reset routes
    //Route::post('/password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    //Route::get('/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    //Route::post('/password/reset', 'Admin\Auth\ResetPasswordController@reset');
    //Route::get('/password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::get('/', 'Admin\Auth\LoginController@showLoginForm')->name('admin.index');
    Route::get('dashboard', 'Admin\AdminController@dashboard')->name('admin.dashboard');


    Route::get('clients', 'ClientController@index')->name('admin.clients.index');
    Route::get('clients/create', 'ClientController@create')->name('admin.clients.create');
    Route::post('clients/create', 'ClientController@store')->name('admin.clients.store');
});


// client routes
Route::group(['prefix' => 'client'], function () {
    //Auth::routes(['verify' => true]);
    Route::get('/', 'Client\Auth\LoginController@showLoginForm')->name('client.index');
    // Authentication Routes...
    Route::get('login', 'Client\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Client\Auth\LoginController@login');
    Route::post('logout', 'Client\Auth\LoginController@logout')->name('client.logout');
    // Password reset routes
    Route::post('/password/email', 'Client\Auth\ForgotPasswordController@sendResetLinkEmail')->name('client.password.email');
    Route::get('/password/reset', 'Client\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('/password/reset', 'Client\Auth\ResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Client\Auth\ResetPasswordController@showResetForm')->name('client.password.reset');
    // verification routes
    Route::get('/email/verify', 'Client\Auth\VerificationController@show')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'Client\Auth\VerificationController@verify')->name('verification.verify')->middleware('auth:client');
    Route::post('/email/resend', 'Client\Auth\VerificationController@resend')->name('verification.resend')->middleware('auth:client');


    Route::get('dashboard', 'Client\ClientController@dashboard')->name('client.dashboard')->middleware('verified:verification.notice');


    Route::get('clients', 'AgentController@index')->name('client.agents.index');
    Route::get('clients/create', 'AgentController@create')->name('client.agents.create');
    Route::post('clients/create', 'AgentController@store')->name('client.agents.store');
});
