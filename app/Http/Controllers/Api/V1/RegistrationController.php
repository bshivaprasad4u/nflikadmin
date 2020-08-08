<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\RegistrationRequest;
use App\User;
use App\Http\Controllers\Api\Controller as ApiController;
use App\Device;
use Jenssegers\Agent\Agent;

class RegistrationController extends ApiController
{
    /**
     * Register User
     *
     * @param RegistrationRequest $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function register(RegistrationRequest $request)
    {
        $user = User::create($request->getAttributes());
        //dd($user);
        $this->register_device($user->id);
        $user->sendEmailVerificationNotification();

        return $this->respondWithMessage('User successfully created');
    }

    public function register_device($user_id)
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
        $platform = ($agent->platform()) ? '' : '';
        $browser = ($agent->browser()) ? '' : '';
        //$verification_code = mt_rand(100000, 999999);

        $device_data = ['device_name' => $device_name, 'platform' => $platform, 'browser' => $browser,  'user_id' => $user_id];

        //dd($device_data);
        Device::create($device_data);
        //auth('api')->user()->notify(new DeviceVerificationEmail($verification_code)); //sendDeviceVerificationCode($verification_code);
        //Notification::send(auth('api')->user(), new DeviceVerificationEmail($verification_code));
    }
}
