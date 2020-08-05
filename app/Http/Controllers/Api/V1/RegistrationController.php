<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\RegistrationRequest;
use App\User;
use App\Http\Controllers\Api\Controller as ApiController;

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
        $user = User::create($request->getAttributes())->sendEmailVerificationNotification();
        //dd($user);
        //$user->sendEmailVerificationNotification();

        return $this->respondWithMessage('User successfully created');
    }
}
