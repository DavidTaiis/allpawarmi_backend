<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderProductResource extends JsonResource
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
            'client' => $this->userClient->name,
            'phone_client' => $this->userClient->phone_number,
            'position' =>[
                'lat' => $this->userClient->geolocationConsumer[0]->lat,
                'lng' => $this->userClient->geolocationConsumer[0]->lng,
            ],
            'total' => $this->total,
            'place' => $this->place_delivery,
            'images' => $this->userClient->images[0]->url,
            'products' => ProductDetailsOrderResource::collection($this->measureProductos)
        ];
    }
}
