<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StopBasicResource extends JsonResource
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
            
            "id" => $this->id,
            "description" => $this->description,
            "name" => $this->name,
            "position" => [
                "lat" => $this->geolocation->lat,
                "lng" => $this->geolocation->lng,
            ]        
        ];
    }
}
