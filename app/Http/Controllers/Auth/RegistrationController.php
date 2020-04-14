<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegistrationRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\User\UserResource;
use App\Model\User;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{

    /**
     * Registration new User
     *
     * @param RegistrationRequest $request
     * @throws $e
     * @return JsonResource
     */
    public function index(RegistrationRequest $request): JsonResource
    {
        try {
            DB::beginTransaction();

            # Create new User
            $user = User::create(
                collect($request->validated())
                    ->merge(['api_token' => Str::random()])
                    ->toArray()
            );

            # Create Auth Token
            $token = $user->createToken('web');

            # Auth login
            auth()->login($user);

            DB::commit();

            return JsonResource::make([
                'token' => $token->plainTextToken,
                'user' => UserResource::make($user),
            ]);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Auth|Registration:index', ['message' => $e->getMessage()]);

            return MessageResource::make(__('validation.error_server.500'), 500);
        }
    }
}
