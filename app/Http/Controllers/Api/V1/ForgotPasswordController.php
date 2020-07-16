<?php

namespace App\Http\Controllers\Api\V1;

use App\ApiCode;
use App\Http\Requests\ResetPasswordRequest;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Controllers\Api\Controller as ApiController;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends ApiController
{
    use SendsPasswordResetEmails;
    protected function sendResetLinkResponse(Request $request, $response)
    {
        return response(['message' => $response]);
    }
    protected function sendResetResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            // return new JsonResponse(['message' => trans($response)], 200);
            //return $this->respondWithMessage(trans($response));
            return $this->respondWithMessage('Reset password link sent to your registered email id.');
        }

        return redirect($this->redirectPath())
            ->with('status', trans($response));
    }


    protected function sendResetFailedResponse(Request $request, $response)
    {
        if ($request->wantsJson()) {
            throw ValidationException::withMessages([
                'email' => [trans($response)],
            ]);
        }

        return redirect()->back()
            ->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)]);
    }

    // public function forgot()
    // {
    //     $credentials = request()->validate(['email' => 'required|email']);

    //     Password::sendResetLink($credentials);

    //     return $this->respondWithMessage('Reset password link sent to your registered email id.');
    //     // $data = ['token' => $this->token];
    //     // return $this->respond($data, 'Reset password key.');
    // }





    public function reset(ResetPasswordRequest $request)
    {
        $reset_password_status = Password::reset($request->validated(), function ($user, $password) {
            $user->password = $password;
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return $this->respondBadRequest(ApiCode::INVALID_RESET_PASSWORD_TOKEN);
        }

        return $this->respondWithMessage("Password has been successfully changed.");
    }
}
