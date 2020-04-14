<?php

namespace App\Http\Controllers\Practice;

use App\Http\Controllers\Controller;
use App\Http\Requests\Practice\StoreRequest;
use App\Http\Resources\MessageResource;
use App\Http\Resources\Practice\PracticeResource;
use App\Model\Practice;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateController extends Controller
{
    /**
     * Update Practice
     *
     * @param StoreRequest $request
     * @param Practice $practice
     * @throws $e
     * @return JsonResource
     */
    public function index(StoreRequest $request, Practice $practice): JsonResource
    {
        try {
            DB::beginTransaction();

            # Update Practice
            $practice->update(
                $request->validated()
            );

            DB::commit();

            return PracticeResource::make($practice);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Practice|Update:index', ['message' => $e->getMessage()]);

            return MessageResource::make(__('validation.error_server.500'), 500);
        }
    }
}
