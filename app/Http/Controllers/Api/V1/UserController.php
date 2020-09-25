<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller as ApiController;
use Illuminate\Support\Facades\Storage;
use App\ApiCode;
use App\User;
use Exception;
use Illuminate\Support\Facades\Hash;
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
                'mobile' => 'required|digits:10',
                'dob' => 'sometimes|nullable',
                'country' => 'sometimes|nullable',
                'state' => 'sometimes|nullable',
                'city' => 'sometimes|nullable',
                'zip' => 'sometimes|nullable',
                'address' => 'sometimes|nullable',
            ]
        );
        auth('api')->user()->update($attributes);

        return $this->respondWithMessage("Profile updated successfully.");
    }
    public function password_update(Request $request)
    {

        $attributes = request()->validate(
            [
                'current_password' => 'required|string',
                'password' => 'required|string|confirmed',
                // 'confirm_password' => 'requeired|string'
            ]
        );
        try {
            $user = User::findOrFail(auth('api')->id());
            if ((Hash::check(request('current_password'), $user->password)) == false) {
                return $this->respondWithError('257', 401);
            } else
        if ((Hash::check(request('password'), $user->password)) == true) {
                return $this->respondWithError('258', 401);
            } else {
                $password = ['password' => request('password')];
                auth('api')->user()->update($password);
            }
            return $this->respondWithMessage("Password changed successfully.");
        } catch (Exception $e) {
            return $this->respondWithError(ApiCode::DATA_NOT_FOUND, 404);
        }
    }


    public function profile_settings(Request $request)
    {
        try {
            $user = User::findOrFail(auth('api')->id());
            //dd($user);
            $user->update(['profile_settings' => json_encode($request->all())]);
            return $this->respondWithMessage('Profile settings updated successfully.');
        } catch (Exception $e) {
            return $this->respondWithError(ApiCode::DATA_NOT_FOUND, 404);
        }
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
        return $this->respondWithMessage(Storage::disk('s3')->url($file_path));
    }
}
