<?php

namespace App\Repositories;

use App\Models\Image;
use App\Models\ImageParameter;
use App\Models\Acopio;
use Illuminate\Support\Facades\Auth;
use App\Repositories\LevelRepository;

class AcopioRepository
{
    public function getAcopios(){
        $acopios = Acopio::query();

    return $acopios->get() ?? null;

    }
    public function getAcopioId($id)
    {
        $acopio = Acopio::query()->find($id);
        return $acopio ?? null;
    }

    public function addAcopio($input)
    {
       
       $acopio = new Acopio();
       $acopio->name =  $input["name"];
       $acopio->lng =  $input["lng"];
       $acopio->lat =  $input["lat"];
       $acopio->days =  $input["days"];
       $acopio->hours =  $input["hours"];
       $acopio->description =  $input["description"];
       $acopio->users_id =  $input["users_id"];
        $acopio->save();

    }
    
}
