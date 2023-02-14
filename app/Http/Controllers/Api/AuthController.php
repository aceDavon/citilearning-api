<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends BaseController
{
    public function login(LoginUserRequest $request)
    {
        if(!Auth::attempt([$request->only('email', 'password')]))
        {
            return $this->sendError('Unauthorised.', 'Invalid Credentials...', 401);
        }
        return 'yay!';
        // $user = User::where('email', $request->email)->first();
        // return $this->sendResponse($user, 'User Logged in successfully!');
    }

}
