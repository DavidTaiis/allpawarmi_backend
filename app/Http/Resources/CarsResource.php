<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarsResource extends JsonResource
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
            'car_plate' => $this->car_plate,
            'description' => $this->description,
            'type' => $this->type,
            'color' => $this->color,
            'position'=> ['lat' => $this->lat,
                'lng' => $this->lng],   
            'status' => $this->status,
            'name' => $this->user->name,
            'phone' => $this->user->phone_number,
            'image' => $this->user->images[0]->url ?? ""

        ];
    }
}
