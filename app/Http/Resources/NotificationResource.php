<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
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
            'position'=> ['lat' => $this->lat,
                'lng' => $this->lng],
            
            'status' => $this->status,
            'type' => $this->type,
            'status' => $this->status,
            'description' => $this->description,
            'name' => $this->user->name
            
        ];
    }
}
