<?php

namespace App\Http\Resources\Practice;

use Illuminate\Http\Resources\Json\JsonResource;

class PracticeCategoryShortResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'color' => $this->color,
        ];
    }
}
