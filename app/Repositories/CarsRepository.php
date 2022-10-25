<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\Cars;
use Illuminate\Support\Facades\Auth;
use App\Models\MeasureProduct;

class CarsRepository
{
   
    public function getCamionetas(){
        $camioneta  = Cars::query();
        $camioneta->with(['user']);
        return $camioneta->get() ?? null;

    }
    public function getPrivado(){
        $privado  = Cars::query();
        $privado->where('type','Privado');
        $privado->with(['user']);
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

}
