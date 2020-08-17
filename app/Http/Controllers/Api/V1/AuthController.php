<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\Controller as ApiController;
use App\ApiCode;
use App\User;
use App\Notifications\SendOtpNotification;
use JWTAuth;
use Illuminate\Support\Facades\Hash;
//use Jenssegers\Agent\Agent;
use Illuminate\Foundation\Auth\AuthenticatesUsers;




class AuthController extends ApiController
{
    use AuthenticatesUsers;
    protected $username;
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'send_otp']]);
        $this->username = $this->setUsername();
    }
    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function setUsername()
    {
        $login = request()->input('username');

        $fieldType = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'mobile';

        request()->merge([$fieldType => $login]);

        return $fieldType;
    }
    public function username()
    {
        return $this->username;
    }

    public function login()
    {
        if (request()->has('otp')) {
            if (is_numeric(request()->username)) {
                $credentials = request()->validate(['mobile' => 'required|integer:10', 'otp' => 'required']);
            } else {
                $credentials = request()->validate(['email' => 'required|email', 'otp' => 'required']);
            }
            $user = User::where($credentials)->firstOrfail();
            if ($user->otp == request()->otp && $user->otp_expires_at->gt(now())) {
                $user->timestamps = false;
                $user->otp = null;
                $user->otp_expires_at = null;
                $user->save();
                //$credentials = array_merge($credentials, ['password' => $user->password]);
                if (!$token = auth('api')->login($user)) {
                    return $this->respondUnAuthorizedRequest(ApiCode::INVALID_CREDENTIALS);
                }
            } else {
                return $this->respondUnAuthorizedRequest(ApiCode::OTP_EXPIRED);
            }
        } else {
            if (is_numeric(request()->username)) {
                $credentials = request()->validate(['mobile' => 'required|integer:10', 'password' => 'required']);
            } else {
                $credentials = request()->validate(['email' => 'required|email', 'password' => 'required']);
            }
            //dd($credentials);
            //$user = User::where($this->credentials())->firstOrfail();
            //dd($user);
            if (!$token = auth()->attempt($credentials)) {
                return $this->respondUnAuthorizedRequest(ApiCode::INVALID_CREDENTIALS);
            }
        }

        //$this->register_device();
        return $this->respondWithToken($token);
    }

    public function send_otp()
    {
        $credentials = request()->validate(['email' => 'required|email']);
        $user = User::where($credentials)->firstOrfail();
        if ($user) {
            $user->generate_otp();
            $user->save();
            $user->notify(new SendOtpNotification());
            return $this->respondWithMessage('Otp Sent');
        } else {
            return $this->respondWithMessage('Email Not Found');
        }
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
            'user_details' => auth('api')->user(),
            //'devices' => auth('api')->user()->devices
        ];
        return $this->respond($auth_user_api);
    }
}
