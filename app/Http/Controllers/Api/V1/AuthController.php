<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Controller as ApiController;
use App\ApiCode;
use App\Device;
use Jenssegers\Agent\Agent;
use App\Notifications\DeviceVerificationEmail;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Notification;

class AuthController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }

    public function login()
    {
        $credentials = request()->validate(['email' => 'required|email', 'password' => 'required']);
        if (!$token = auth()->attempt($credentials)) {
            return $this->respondUnAuthorizedRequest(ApiCode::INVALID_CREDENTIALS);
        }
        //$this->register_device();
        return $this->respondWithToken($token);
    }

    private function respondWithToken($token)
    {
        return $this->respond([
            'token' => $token,
            'access_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60
        ], "Login Successful");
    }


    public function logout()
    {
        auth('api')->logout();
        return $this->respondWithMessage('User successfully logged out');
    }


    public function refresh()
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    public function me()
    {
        //dd(Auth::user());
        $auth_user_api = [
            //'token' => auth('api')->user()->getJWTIdentifier,
            'user_details' => Auth::user(),
            //'devices' => auth('api')->user()->devices
        ];
        return $this->respond($auth_user_api);
    }
    public function register_device()
    {
        $agent = new Agent();
        $device_name = '';
        if ($agent->isDesktop()) {
            $device_name = 'desktop';
        } elseif ($agent->isTablet()) {
            $device_name = 'tablet';
        } elseif ($agent->isMobile()) {
            $device_name = 'mobile';
        } elseif ($agent->isRobot()) {
            $device_name = $agent->robot();
        }
        //$device_name = $agent->device();
        $platform = ($agent->platform()) ?? '';
        $browser = ($agent->browser()) ?? '';
        $verification_code = mt_rand(100000, 999999);

        $device_data = ['device_name' => $device_name, 'platform' => $platform, 'browser' => $browser, 'verification_code' => $verification_code, 'user_id' => auth('api')->id()];

        //dd($device_data);
        Device::create($device_data);
        //auth('api')->user()->notify(new DeviceVerificationEmail($verification_code)); //sendDeviceVerificationCode($verification_code);
        Notification::send(auth('api')->user(), new DeviceVerificationEmail($verification_code));
    }
}
