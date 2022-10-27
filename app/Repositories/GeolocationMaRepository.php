<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\GeolocationMa;
use Illuminate\Support\Facades\Auth;
use App\Models\MeasureProduct;

class GeolocationMaRepository
{
    public function addGeolocation($input, $userId, $name)
    {
        $isCreated = false;
        switch ($input["type"]) {
            case 'Consumidor':
                $geolocation  = GeolocationMa::query()
                ->where("users_id", $userId)->first() ?? new GeolocationMa();
                break;
            
            case 'Huerto':
                $geolocation  = GeolocationMa::query()
                ->where("type", "Huerto")
                ->where("users_id", $userId)->first() ?? new GeolocationMa();
                break;

            case 'PuntoVenta':
                $geolocation  = GeolocationMa::query()
                ->where("type", "PuntoVenta")
                ->where("users_id", $userId)->first() ?? new GeolocationMa();
                break;

            case 'Asociacion':
                $geolocation  = GeolocationMa::query()
                ->where("type", "Asociacion")
                ->where("users_id", $userId)->first() ?? new GeolocationMa();
                break;

            case 'Camioneta':
                $geolocation  = GeolocationMa::query()
                ->where("users_id", $userId)->first() ?? new GeolocationMa();
                break;

            case 'Salida':
                $geolocation  = GeolocationMa::query()
                ->where("type", "Llegada")
                ->where("users_id", $userId)->first() ?? new GeolocationMa();
                break;
            
            case 'Llegada':
                $geolocation  = GeolocationMa::query()
                ->where("users_id", $userId)
                ->where("type", "Llegada")
                ->first() ?? new GeolocationMa();
                break;
            
        }

    
       $geolocation->name =  $name;
       $geolocation->lat =  $input["lat"];
       $geolocation->lng =  $input["lng"];
       $geolocation->days =  $input["days"] ?? "";
       $geolocation->hours =  $input["hours"] ?? "";
       $geolocation->type =  $input["type"];
       $geolocation->description =  $input["description"];
       $geolocation->users_id =  $userId;
    
        $geolocation->save();

    }

    public function getGeolocationFarmers(){
        $geolocation  = GeolocationMa::query();
        $geolocation->where("type", "Huerto")->orWhere("type", "PuntoVenta");
        
        return $geolocation->get() ?? null;

    }
    
    public function getSellerPoits(){
        $geolocation  = GeolocationMa::query();
        $geolocation->where("type", "PuntoVenta");
        
        return $geolocation->get() ?? null;

    }

    public function getGeolocationFarmerId($id){
        $geolocation  = GeolocationMa::query();
        $geolocation->where("users_id",$id)
        ->whereIn("type", ["Huerto", "PuntoVenta"]);
        
        return $geolocation->get() ?? null;

    }
    public function getGeolocationConsumer($id){
        $geolocation  = GeolocationMa::query();
        $geolocation->where("users_id",$id)
        ->where("type", "Consumidor");
        
        return $geolocation->first() ?? null;

    }

}
