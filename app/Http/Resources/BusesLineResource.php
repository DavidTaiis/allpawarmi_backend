<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BusesLineResource extends JsonResource
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
            'lat_init' => $this->lat_init,
            'lng_init' => $this->lng_init,
            'lat_finish' => $this->lat_finish,
            'lng_finish' => $this->lng_finish,
            'description' => $this->description,
            'price' => $this->price,
          
        ];
    }
}
