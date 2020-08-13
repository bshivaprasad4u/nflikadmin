<?php

use GuzzleHttp\Middleware;
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

Route::get('/', function () {
    return redirect('admin/login');
});
Auth::routes();

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
    Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('admin.password.email');
    Route::get('/password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('admin.password.request');
    Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('admin.password.update');
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('admin.password.reset');
    Route::get('/', 'Auth\LoginController@showLoginForm')->name('admin.index');
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::get('dashboard', 'AdminController@dashboard')->name('admin.dashboard');
        Route::get('clients', 'ClientController@index')->name('admin.clients.index');
        Route::get('clients/create', 'ClientController@create')->name('admin.clients.create');
        Route::post('clients/store', 'ClientController@store')->name('admin.clients.store');
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
    Route::post('/password/reset', 'Auth\ResetPasswordController@reset')->name('client.password.update');;
    Route::get('/password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('client.password.reset');
    // verification routes
    // Route::get('/email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    // Route::get('/email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify')->middleware('auth:client');
    // Route::post('/email/resend', 'Auth\VerificationController@resend')->name('verification.resend')->middleware('auth:client');

    Route::group(['middleware' => 'auth:client'], function () {
        Route::get('change_password', 'ClientProfileController@index')->name('client.change_password');
        Route::post('change_password', 'ClientProfileController@store')->name('client.change_password');
        Route::get('dashboard', 'ClientController@dashboard')->name('client.dashboard'); //->middleware('verified:verification.notice');
        Route::get('contents', 'ContentController@index')->name('client.contents.index');
        Route::get('contents/create', 'ContentController@create')->name('client.contents.create');
        Route::post('contents/store', 'ContentController@store')->name('client.contents.store');
        Route::get('contents/edit/{id}', 'ContentController@edit')->name('client.contents.edit');
        Route::post('contents/update/{id}', 'ContentController@update')->name('client.contents.update');
        Route::get('contents/view/{id}', 'ContentController@view')->name('client.contents.view');
        Route::get('contents/video_add/{id}', 'ContentController@video_add')->name('client.contents.video_add');
        Route::post('contents/video_store/{id}', 'ContentController@video_store')->name('client.contents.video_store');
        Route::get('contents/change_privacy/{id}', 'ContentController@change_privacy')->name('client.contents.change_privacy');
        Route::post('contents/change_privacy/{id}', 'ContentController@privacy_store')->name('client.contents.privacy_store');
        Route::get('contents/teaseradd/{id}', 'ContentController@teaser_add')->name('client.contents.teaser_add');
        Route::post('contents/teaseradd/{id}', 'ContentController@teaser_store')->name('client.contents.teaser_store');
        Route::get('contents/posteradd/{id}', 'ContentController@poster_add')->name('client.contents.poster_add');
        Route::post('contents/posteradd/{id}', 'ContentController@poster_store')->name('client.contents.poster_store');
        Route::get('contents/monetizeadd/{id}', 'ContentController@monetize_add')->name('client.contents.monetize_add');
        Route::post('contents/monetizeadd/{id}', 'ContentController@monetize_store')->name('client.contents.monetize_store');
        Route::get('contents/monetizeupdate/{id}', 'ContentController@monetize_edit')->name('client.contents.monetize_edit');
        Route::post('contents/monetizeupdate/{id}', 'ContentController@monetize_update')->name('client.contents.monetize_update');

        Route::get('contents/publish/{id}', 'ContentController@publish')->name('client.contents.publish');
        Route::post('contents/publish_store/{id}', 'ContentController@publish_store')->name('client.contents.publish_store');

        Route::get('channel/edit/{id}', 'ChannelController@edit')->name('client.channel.edit');
        Route::post('channel/update/{id}', 'ChannelController@update')->name('client.channel.update');
        Route::get('channel/view', 'ChannelController@view')->name('client.channel.view');
        /////// Agents Routes
        Route::get('agents', 'AgentController@index')->name('client.agents.index');
        Route::get('agents/create', 'AgentController@create')->name('client.agents.create');
        Route::post('agents/store', 'AgentController@store')->name('client.agents.store');
    });
});
