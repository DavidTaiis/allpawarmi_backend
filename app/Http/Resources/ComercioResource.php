<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ComercioResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            "position" => [
                'lat' => $this->lat,
                'lng' => $this->lng,
                'type' => $this->name
            ],
            'description' => $this->description,
        ];
    }
}
