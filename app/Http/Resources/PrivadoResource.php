<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PrivadoResource extends JsonResource
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
            'route' => $this->routes->name,
            'name' => $this->routes->description,
            'car_plate' => $this->routes->cars->car_plate,
            'description' => $this->routes->cars->description,
            'color' => $this->routes->cars->color,
            'user_name' => $this->routes->cars->user->name,
            'identification_card' => $this->routes->cars->user->identification_card,
            'image' => $this->routes->cars->user->image[0]->url ?? "" ,
            'phone_number' => $this->routes->cars->user->phone_number,
           'position' => [
            'lat' => $this->transportGeolocation->lat,
            'lng' => $this->transportGeolocation->lng,
            'type' => $this->transportGeolocation->type
           ]

        ];
    }
}
