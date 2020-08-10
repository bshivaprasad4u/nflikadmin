<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller as ApiController;
use Illuminate\Support\Facades\Storage;
use App\Device;
use App\User;
use Illuminate\Support\Facades\Auth;

class UserController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function profile_update()
    {
        $attributes = request()->validate(
            [
                'name' => 'required|string',
                'dob' => 'sometimes|nullable'
            ]
        );
        auth('api')->user()->update($attributes);

        return $this->respondWithMessage("User successfully updated");
    }
    public function password_update()
    {
        $attributes = request()->validate(
            [
                'old_password' => 'required|string',
                'password' => 'required|string',
                'confirm_password' => 'requeired|string'
            ]
        );
        $user = User::findOrFail(auth('api')->id());
        if ($user->password == bcrypt($request->old_password)) {
            //$this->respondWithError('257',);
        }
        auth('api')->user()->update($attributes);

        return $this->respondWithMessage("Password changed.");
    }

    public function devices()
    {
        $devices = Device::where(['user_id' => Auth::id(), 'verfication' => ''])->get();
        return $this->respond($devices);
    }
    public function profile_settings(Request $request)
    {
        $user = User::findOrFail(auth('api')->id());
        //dd($user);
        $user->update(['profile_settings' => json_encode($request->all())]);
        return $this->respondWithMessage('Profile settings updated.');
    }
    public function profile_image(Request $request)
    {
        $validationData = $request->validate(
            [
                'file' => 'sometimes|nullable|mimes:png,PNG,jpg,JPG,jpeg,JPEG|max:' . config('constants.MAX_FILE_UPLOAD_SIZE'),
                //'description' => ['required', 'string'],
            ]
        );
        if ($request->hasfile('file')) {
            $file = $request->file('file');
            $file_name = time() . '_' . $file->getClientOriginalName();
            //$video_path = $request->file('videofile')->storeAs('uploads', $video_name);
            //$duration = Settings::getDuration($video);
            $file_path = 'profile_image/' . $file_name;
            //Storage::disk('s3')->put($video_path, file_get_contents($video));
            Storage::disk('s3')->put($file_path, \fopen($file, 'r+'));
        }
        auth()->user()->update(['profile_image' => $file_path]);
        return $this->respondWithMessage('Profile Picture Changed.');
    }
}
