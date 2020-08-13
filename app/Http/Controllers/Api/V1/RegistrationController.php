<?php

namespace App\Http\Controllers\Api\V1;

//use App\Http\Requests\RegistrationRequest;
use App\User;
use App\Http\Controllers\Api\Controller as ApiController;
use App\Device;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegistrationController extends ApiController
{
    /**
     * Register User
     *
     * @param RegistrationRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(Request $request)
    {
        $validationData = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'mobile' => ['required', 'digits:10', 'unique:users,mobile'],
            ]
        );
        $new_password = Str::random(8);
        $save_data = [
            'name' => $request->name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'password' => $new_password,
        ];
        //dd($save_data);
        $user = User::create($save_data);
        $device_data = [
            'device_id' => $request->device_id,
            'device_name' => $request->device_name,
            'browser' => $request->device_browser,
            'platform' => $request->device_platform,
            'user_id' => $user->id
        ];
        Device::create($device_data);
        //$this->register_device($device_data, $user->id);
        $user->sendPasswordNotification($new_password);
        return $this->respondWithMessage('User successfully created');
    }

    public function register_device($device_data, $user_id)
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
        //$verification_code = mt_rand(100000, 999999);

        $device_data = ['device_name' => $device_name, 'platform' => $platform, 'browser' => $browser,  'user_id' => $user_id];

        //dd($device_data);
        Device::create($device_data);
        //auth('api')->user()->notify(new DeviceVerificationEmail($verification_code)); //sendDeviceVerificationCode($verification_code);
        //Notification::send(auth('api')->user(), new DeviceVerificationEmail($verification_code));
    }
}
