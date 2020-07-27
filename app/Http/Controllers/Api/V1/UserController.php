<?php

namespace App\Http\Controllers\Api\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Api\Controller as ApiController;

class UserController extends ApiController
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function updateProfile()
    {
        $attributes = request()->validate(['name' => 'nullable|string']);

        auth()->user()->update($attributes);

        return $this->respondWithMessage("User successfully updated");
    }
}
