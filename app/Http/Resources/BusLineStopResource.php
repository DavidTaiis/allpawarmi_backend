<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BusLineStopResource extends JsonResource
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
            "name" => $this->name,
            "descripcion" => $this->description,
            "latInit" => $this->lat_init,
            "lngInit" => $this->lng_init,
            "latFinish" => $this->lat_finish,
            "lngFinish" => $this->lng_finish,
            "price" => $this->price,  
            "stops" => StopBasicResource::collection($this->stops)     
        ];
    }
}
