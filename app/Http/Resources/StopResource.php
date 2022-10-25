<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StopResource extends JsonResource
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
            "idLineaBus" => $this->lineBus->id,
            "nameLineBus" => $this->lineBus->name,
            "descripcionLineBus" => $this->lineBus->description,
            "latInitLineBus" => $this->lineBus->lat_init,
            "lngInitLineBus" => $this->lineBus->lng_init,
            "latFinishLineBus" => $this->lineBus->lat_finish,
            "lngFinishLineBus" => $this->lineBus->lng_finish,
            "priceLineBus" => $this->lineBus->price,
            "idStop" => $this->id,
            "descriptionStop" => $this->description,
            "nameStop" => $this->name,
            "positionStop" => [
                "lat" => $this->geolocation->lat,
                "lng" => $this->geolocation->lng,
            ]        
        ];
    }
}
