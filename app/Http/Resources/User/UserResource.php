<?php

namespace App\Http\Resources\User;

use App\Http\Resources\File\FileResource;
use App\Http\Resources\Practice\PracticeResource;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            # Main
            'id' => $this->id,
            'name' => $this->name,
            'surname' => $this->surname,
            'avatar' => FileResource::make($this->avatar),
            'offer' => $this->offer,
            'description' => $this->description,
            'hometown' => $this->hometown,
            'location' => $this->location,
            'birthday' => $this->birthday,

            # Expertise and Request
            'expertise' => PracticeResource::collection($this->expertise),
            'request' => PracticeResource::collection($this->request),

            # Intersection Expertise and Request
            'intersection' => $this->when($this->id !== auth()->id(), [
                'expertiseExpertise' => PracticeResource::collection($this->intersectionExpertiseExpertise),
                'requestExpertise'   => PracticeResource::collection($this->intersectionRequestExpertise),
                'expertiseRequest'   => PracticeResource::collection($this->intersectionExpertiseRequest),
            ]),
        ];
    }
}
