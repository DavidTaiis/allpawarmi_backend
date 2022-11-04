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
            'seller'=> $this->user->name,
            'seller_phone'=> $this->user->phone_number,
             'imagesSeller' => count($this->user->images) > 0 ? $this->user->images[0]->url : "",

           'position' =>[
                'lat' => $this->userClient->geolocationConsumer[0]->lat,
                'lng' => $this->userClient->geolocationConsumer[0]->lng,
                'type' => "Consumidor",
            ],
            'positionSeller' => [
                'lat'=> count($this->user->geolocationSeller) > 0 ? $this->user->geolocationSeller[0]->lat : '',
                'lng'=> count($this->user->geolocationSeller) > 0 ?  $this->user->geolocationSeller[0]->lng : '',
                'type' => "PuntoVenta",
            ],
            'total' => $this->total,
            'place' => $this->place_delivery,
            'images' => count($this->userClient->images) > 0 ? $this->userClient->images[0]->url : "",
             'products' => ProductDetailsOrderResource::collection($this->measureProductos) 
        ];
    }
}
