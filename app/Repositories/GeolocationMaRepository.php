<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\GeolocationMa;
use Illuminate\Support\Facades\Auth;
use App\Models\MeasureProduct;

class GeolocationMaRepository
{
    public function addGeolocation($input, $userId,$name)
    {
       
       $geolocationMa = new GeolocationMa();
       $geolocationMa->name =  $name;
       $geolocationMa->lat =  $input["lat"];
       $geolocationMa->lng =  $input["lng"];
       $geolocationMa->type =  $input["type"];
       $geolocationMa->description =  $input["description"];
       $geolocationMa->users_id =  $userId;
    
        $geolocationMa->save();

    }

    public function getGeolocationFarmers(){
        $geolocation  = GeolocationMa::query();
        $geolocation->where("type", "Huerto");
        
        return $geolocation->get() ?? null;

    }
}
