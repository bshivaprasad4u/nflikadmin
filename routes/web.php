<?php

use GuzzleHttp\Middleware;
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
Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('admin.logout');

    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('admin.register');
    Route::post('register', 'Auth\RegisterController@register')->name('admin.register');

    // Password reset routes
    Route::post('/password/email', 'Admin\Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Admin\Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Admin\Auth\ResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Admin\Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('admin.index');
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
        Route::get('clients', 'ClientController@index')->name('admin.clients.index');
        Route::get('clients/create', 'ClientController@create')->name('admin.clients.create');
        Route::post('clients/create', 'ClientController@store')->name('admin.clients.store');
    });
});


// client routes
Route::group(['prefix' => 'client',  'namespace' => 'Client'], function () {
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('client.index');
    // Authentication Routes...
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('client.login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('client.logout');
    // Password reset routes
    Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('client.password.email');
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('client.password.request');
    Route::post('/password/reset', 'Auth\ResetPasswordController@reset');
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('client.password.reset');
    // verification routes
    Route::get('/email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify')->middleware('auth:client');
    Route::post('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend')->middleware('auth:client');


    Route::get('dashboard', 'ClientController@dashboard')->name('client.dashboard')->middleware('verified:verification.notice');
});
