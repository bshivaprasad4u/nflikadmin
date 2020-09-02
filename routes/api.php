<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'prefix' => 'v1',
    'middleware' => ['CORS', 'api'],
    'namespace' => 'Api\V1'

], function ($router) {
    Route::post('login', 'AuthController@login')->name('api.v1.login');
    Route::post('send_otp', 'AuthController@send_otp')->name('api.v1.send_otp');
    Route::post('logout', 'AuthController@logout')->name('api.v1.logout');
    Route::post('register', 'RegistrationController@register')->name('api.v1.register');
    Route::get('subscriptions', 'SubscriptionController@subscriptions');
    //Route::post('forgot_password', 'AuthController@forgot')->name('api.v1.forgot_password');
    //Route::get('verification/verify/{id}', 'VerificationController@verify')->name('api.v1.verification.verify');
    //Route::get('verification/resend', 'VerificationController@resend')->name('verification.resend')->middleware('auth:api');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'ForgotPasswordController@reset')->name('api.v1.password.reset');
    Route::group([
        'middleware' => ['auth:api'],
    ], function ($router) {
        Route::post('refresh', 'AuthController@refresh')->middleware('auth:api');
        Route::get('auth_user_api', 'AuthController@me')->middleware('auth:api');
        Route::post('device_register', 'DeviceController@register_device');
        Route::post('device_verification_resend', 'DeviceController@device_verification_resend');
        Route::post('device_verify', 'DeviceController@device_verify');
        Route::post('profile_update', 'UserController@profile_update');
        Route::post('profile_settings', 'UserController@profile_settings');
        Route::post('profile_picture', 'UserController@profile_image');
        Route::post('password_update', 'UserController@password_update');
        Route::post('payment_initiation', 'PaymentController@payment_initiation');
        Route::post('payment_response', 'PaymentController@payment_response');
        //Route::get('notifysubscription', 'PaymentController@notifysubscription');
    });
});
