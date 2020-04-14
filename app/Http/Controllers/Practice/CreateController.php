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

class CreateController extends Controller
{
    /**
     * Create Practice
     *
     * @param StoreRequest $request
     * @throws $e
     * @return JsonResource
     */
    public function index(StoreRequest $request): JsonResource
    {
        try {
            DB::beginTransaction();

            # Create new Practice
            $practice = Practice::create(
                $request->validated()
            );

            DB::commit();

            return PracticeResource::make($practice);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Practice|Create:index', ['message' => $e->getMessage()]);

            return MessageResource::make(__('validation.error_server.500'), 500);
        }
    }
}
