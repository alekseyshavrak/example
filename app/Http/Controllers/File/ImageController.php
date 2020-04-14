<?php

namespace App\Http\Controllers\File;

use App\Http\Requests\File\StoreImageRequest;
use App\Http\Resources\File\FileResource;
use App\Http\Resources\MessageResource;
use App\Model\File;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageController extends BaseController {

    /**
     * Upload image
     *
     * @param StoreImageRequest $request
     * @throws $e
     * @return JsonResource
     */
    public function upload(StoreImageRequest $request): JsonResource
    {
        try {
            DB::beginTransaction();

            # Handling Image
            $image = Image::make($request->file('file'))
                ->fit(800, 800)
                ->orientate();

            # Save Image
            $file = File::create([
                'driver' => 'public',
                'type' => $request->get('type'),
                'extra' => [
                    'width'  => $image->width(),
                    'height' => $image->height(),
                    'weight' => $image->filesize(),
                ],
            ]);

            # Upload Image
            Storage::disk($file->driver)
                ->put($file->path(), $image->stream(), 'public');

            DB::commit();

            return FileResource::make($file);

        } catch (\Exception $e) {
            DB::rollback();
            Log::error('File|ImageController:upload', ['message' => $e->getMessage()]);

            return MessageResource::make(__('validation.error_server.500'), 500);
        }
    }

}
