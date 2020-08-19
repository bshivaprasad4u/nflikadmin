<?php

namespace App\Http\Controllers\Api\V1;

use App\ApiCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller as ApiController;
use App\Device;
use Illuminate\Support\Facades\Auth;
use App\Notifications\DeviceVerificationEmail;
use Exception;
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
        try {
            $device = Device::where(['user_id' => auth()->user()->id, 'device_id' => $request->device_id])->firstOrfail();
            $device->generate_verification_code();
            auth('api')->user()->notify(new DeviceVerificationEmail($device->verification_code));
            return $this->respondWithMessage("Device Verification Code sent.");
        } catch (Exception $e) {
            return $this->respondWithError(ApiCode::DATA_NOT_FOUND, 404);
        }
    }

    public function device_verify(Request $request)
    {
        // echo $this->UniqueMachineID();

        //$computerId = $_SERVER['HTTP_USER_AGENT'] . $_SERVER['LOCAL_ADDR'] . $_SERVER['LOCAL_PORT'] . $_SERVER['REMOTE_ADDR'];
        //echo $computerId;
        //exit;
        //$user = auth()->user();
        try {
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
        } catch (Exception $e) {
            return $this->respondWithError(ApiCode::DATA_NOT_FOUND, 404);
        }
    }

    function UniqueMachineID($salt = "")
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            $temp = sys_get_temp_dir() . DIRECTORY_SEPARATOR . "diskpartscript.txt";
            if (!file_exists($temp) && !is_file($temp)) file_put_contents($temp, "select disk 0\ndetail disk");
            $output = shell_exec("diskpart /s " . $temp);
            $lines = explode("\n", $output);
            $result = array_filter($lines, function ($line) {
                return stripos($line, "ID:") !== false;
            });
            if (count($result) > 0) {
                $result = array_shift(array_values($result));
                $result = explode(":", $result);
                $result = trim(end($result));
            } else $result = $output;
        } else {
            $result = shell_exec("blkid -o value -s UUID");
            if (stripos($result, "blkid") !== false || !$result) {
                $result = $_SERVER['HTTP_HOST'];
            }
        }
        return md5($salt . md5($result));
    }
}
