<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\Cars;
use App\Models\Privado;
use App\Models\GeolocationTransport;
use Illuminate\Support\Facades\Auth;
use App\Models\Route;
use App\Models\RouteTransport;
use App\Models\TransportGeolocation;

class CarsRepository
{
   
    public function getCamionetas(){
        $camioneta  = Cars::query();
        $camioneta->with(['user']);
        return $camioneta->get() ?? null;

    }
    public function getRoutesPrivate(){
        $privado  = RouteTransport::query();
        return $privado->get() ?? null;

    }

    public function getCamionetaId($id){
        $camioneta = Cars::query()->find($id);
        return $camioneta ?? null;
    }

    public function addCamioneta($input)
    {
        $userId = Auth::user()->id;
       $camioneta = Cars::query()
       ->where("users_id", $userId)->first() ?? new Cars();
       $camioneta->car_plate =  $input["car_plate"];
       $camioneta->lng =  $input["lng"];
       $camioneta->lat =  $input["lat"];
       $camioneta->description =  $input["description"];
       $camioneta->	type =  $input["type"];
       $camioneta->	color =  $input["color"];
       $camioneta->status =  "ACTIVE";
       $camioneta->users_id =  $userId;
        $camioneta->save();

    }
    public function getCamionetaAuth(){
        $userId = Auth::user()->id;
        $camioneta = Cars::query();
        $camioneta->where("users_id", $userId );
        return $camioneta->get() ?? null;
    }
    public function addCar($input,$userId)
    {
       $privado = Privado::query()
       ->where("users_id", $userId)->first() ?? new Privado();
       $privado->car_plate =  $input["car_plate"] ?? "";
       $privado->description =  $input["description"] ?? "";
       $privado->color =  $input["color"] ?? "";
       $privado->status =  "ACTIVE";
       $privado->users_id =  $userId;
       $privado->save();
       return $privado;
    }
    public function addRoute($input, $carId )
    {
    
      $route = Route::query()
      ->where("cars_id", $carId)->first() ?? new Route();
      $route->name = $input["nameRoute"] ?? "";
      $route->description = $input["descriptionRoute"] ?? "";
      $route->cars_id = $carId;
      $route->status = "ACTIVE";
      $route->save();
      return $route;
    }
    public function addGeolocation($geolocation)
    {
      $geo = TransportGeolocation::query()
      ->where("type", $geolocation["type"])->first() ?? new TransportGeolocation();
      $geo->lat = $geolocation["lat"];
      $geo->lng = $geolocation["lng"];
      $geo->type = $geolocation["type"];
      $geo->status = "ACTIVE";
      $geo->save();
      return $geo;
    }
    public function addRouteTransport($geoId, $routeId){
     $routeTransport = RouteTransport::query()
     ->where('routes_id', $routeId)
     ->where('transport_geolocation_id', $geoId)
     ->first() ?? new RouteTransport();
       $routeTransport->status = "ACTIVE";
     $routeTransport->transport_geolocation_id = $geoId;
     $routeTransport->routes_id = $routeId;
     $routeTransport->save();
    }


}
