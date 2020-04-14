<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateController extends Controller
{
    /**
     * Update User
     *
     * @param StoreRequest $request
     * @throws $e
     * @return JsonResource
     */
    public function index(StoreRequest $request): JsonResource
    {
        try {
            DB::beginTransaction();

            # Get User
            $user = auth()->user();

            # Update user
            $user->update(
                $request->validated()
            );

            DB::commit();

            return UserResource::make($user);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('User|Update:index', ['message' => $e->getMessage()]);

            return MessageResource::make(__('validation.error_server.500'), 500);
        }
    }
}
