<?php

namespace App\Http\Controllers\Api\V1;

use App\ApiCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller as ApiController;
use App\Device;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DeviceVerificationEmail;
use Illuminate\Support\Facades\Notification;

class DeviceController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function devices()
    {
        $devices = Device::where(['user_id' => Auth::id(), 'verfication' => ''])->get();
        return $this->respond($devices);
    }

    public function register_device(Request $request)
    {
        // $agent = new Agent();
        // $device_name = '';
        // if ($agent->isDesktop()) {
        //     $device_name = 'desktop';
        // } elseif ($agent->isTablet()) {
        //     $device_name = 'tablet';
        // } elseif ($agent->isMobile()) {
        //     $device_name = 'mobile';
        // } elseif ($agent->isRobot()) {
        //     $device_name = $agent->robot();
        // }
        // //$device_name = $agent->device();
        // $platform = ($agent->platform()) ?? '';
        // $browser = ($agent->browser()) ?? '';
        // $verification_code = mt_rand(100000, 999999);

        // $device_data = ['device_name' => $device_name, 'platform' => $platform, 'browser' => $browser, 'verification_code' => $verification_code, 'user_id' => auth('api')->id()];

        $device_data = [
            'device_id' => $request->device_id,
            'device_name' => $request->device_name,
            'browser' => $request->device_browser,
            'platform' => $request->device_platform,
            //'verification_code' => $request->verification_code,
            'user_id' => auth('api')->user()->id
        ];
        //dd($device_data);
        $device = Device::create($device_data);
        $device->generate_verification_code();
        //dd($device);
        //auth('api')->user()->notify(new DeviceVerificationEmail($verification_code)); //sendDeviceVerificationCode($verification_code);
        Notification::send(auth('api')->user(), new DeviceVerificationEmail($device->verification_code));
        return $this->respond($device);
    }
    public function device_verification_resend(Request $request)
    {
        //$user = auth()->user();
        //dd(auth()->user()->id);
        $device = Device::where(['user_id' => auth()->user()->id, 'device_id' => $request->device_id])->firstOrfail();
        $device->generate_verification_code();
        auth('api')->user()->notify(new DeviceVerificationEmail($device->verification_code));
        return $this->respondWithMessage("Device Verification Code sent.");
    }

    public function device_verify(Request $request)
    {
        //$user = auth()->user();
        $device = Device::where(['user_id' => auth()->user()->id, 'device_id' => $request->device_id])->firstOrfail();
        if ($device->verification_code == $request->verification_code) {

            if ($device->updated_at->addMinutes(ApiCode::VERIFICATION_CODE_EXPIRY_IN_MINS)->lt(now())) {
                return $this->respondWithMessage("Verification Code Expired.");
            } else {
                $device->verification_code = null;
                $device->save();
                return $this->respondWithMessage("Device Registered.");
            }
        } else {
            return $this->respondWithMessage("Verification Code Not Matched.");
        }
    }
}
