<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use App\Model\User;
use Illuminate\Http\Resources\Json\JsonResource;

class ListController extends Controller
{
    /**
     * List Users
     *
     * @return JsonResource
     */
    public function index(): JsonResource
    {
        # Get all users
        $users = User::all();

        return UserResource::collection($users);
    }
}
