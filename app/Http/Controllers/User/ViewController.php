<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Model\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ViewController extends Controller
{
    /**
     * Get User by id
     *
     * @param User $user
     * @return JsonResource
     */
    public function getById(User $user): JsonResource
    {
        return UserResource::make($user);
    }

    /**
     * Get current auth User
     *
     * @return JsonResource
     */
    public function me(): JsonResource
    {
        return UserResource::make(auth()->user());
    }
}
