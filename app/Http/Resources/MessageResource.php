<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{

    /**
     * Http Status code.
     */
    public $statusCode = 200;



    /**
     * Create a new resource instance.
     *
     * @param  mixed  $resource
     * @param  integer  $statusCode
     * @return void
     */
    public function __construct($resource, $statusCode = 200)
    {
        parent::__construct($resource);

        $this->statusCode = $statusCode;
    }



    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return ['message' => $this->resource];
    }



    /**
     * Customize the response for a request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Http\JsonResponse  $response
     * @return void
     */
    public function withResponse($request, $response): void
    {
        $response->setStatusCode($this->statusCode);
    }

}
