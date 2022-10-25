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
    public function getAcopioId()
    {
        $userId = Auth::user()->id;
        $acopio = Acopio::query();
        $acopio->where("users_id", $userId );
        return $acopio->get() ?? null;
    }

    public function addAcopio($input)
    {
        $userId = Auth::user()->id;
       $acopio = Acopio::query()
       ->where("users_id", $userId)->first() ?? new Acopio();
       $acopio->name =  $input["name"];
       $acopio->lng =  $input["lng"];
       $acopio->lat =  $input["lat"];
       $acopio->days =  $input["days"];
       $acopio->hours =  $input["hours"];
       $acopio->description =  $input["description"];
       $acopio->status =  "ACTIVE";
       $acopio->users_id =  $userId;
        $acopio->save();

    }
    
}
