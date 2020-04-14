<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\User\UserResource;
use App\Model\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    /**
     * Login User
     *
     * @param LoginRequest $request
     * @return JsonResource
     */
    public function index(LoginRequest $request): JsonResource
    {
        # Find Auth
        $user = User::where('phone', $request->get('phone'))->first();

        # Check
        if ($user && Hash::check($request->get('password'), $user->password)) {
            # Create Auth Token
            $token = $user->createToken('web');

            # Login
            auth()->login($user);

            return JsonResource::make([
                'token' => $token->plainTextToken,
                'user' => UserResource::make($user),
            ]);
        } else {
            return MessageResource::make(__('auth.login.user_not_found'), 401);
        }
    }
}
